<?php

namespace App\Http\Controllers\Package;

ini_set('max_execution_time', 2400);

use FFMpeg;
use App\Http\Controllers\BaseWebController as Controller;
use App\Models\Media;
use Exception;
use FFMpeg\FFMpeg as FFMpegFFMpeg;
use Illuminate\Http\Request;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg as SupportFFMpeg;

class LaravelFfmpegController extends Controller
{
    private $ratios = [1080, 720, 360];
    private $width = [1920, 1280, 480];
    private $height = [1080, 720, 360];

    public function index()
    {
        $media = Media::where('type', MEDIA_TYPE_VIDEO)->get();

        return view('packages.laravel-ffmpeg.index', compact('media'));
    }

    public function store(Request $request)
    {
        if ($request->has('video_file')) {
            try {
                $originalFileName = $request->file('video_file')->getClientOriginalName();
                $extension = $request->file('video_file')->getClientOriginalExtension();
                $mimeType = $request->file('video_file')->getMimeType();

                $file_name = time() . '-' . rand(10, 99) . '-' . rand(10, 99) . '-' . rand(100, 999);
                $upload = $this->uploadOriginalVideo($request->file('video_file'), $file_name . '.' . $extension, 'public');

                $temporaryFileName = str_replace('public/', '', $upload);
                $convertedFileNames = [];
                \Log::info("Original File Uploaded");
                foreach ($this->ratios as $key => $ratio) {
                    \Log::info("Uploading Modified File: " . $key);
                    $convert = $this->convertVideo($temporaryFileName, $extension, $key);
                    if ($convert['status']) {
                        $convertedFileNames[] = $convert['fileName'];
                    }
                }

                foreach ($convertedFileNames as $key => $file_name) {
                    Media::create([
                        'type' => MEDIA_TYPE_VIDEO,
                        'original_name' => $temporaryFileName,
                        'original_extension' => $extension,
                        'original_mime_type' => $mimeType,
                        'access_url' => 'public/' . $file_name,
                        'file_name' => $file_name,
                        'file_extension' => '.mp4',
                        'file_mime_type' => 'video/mp4',
                    ]);
                }
                $this->generalSuccess("Success");
                return redirect()->back();
            } catch (\Exception $ex) {
                dd($ex->getMessage());
                $this->generalError($ex->getMessage());
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    protected function uploadOriginalVideo($file, $file_name, $disk = 'local')
    {
        return $file->storeAs($disk, $file_name);
    }

    protected function convertVideo($originalFileName, $origianlFileExtension, $key)
    {
        $fileName = str_replace($origianlFileExtension, '', $originalFileName) . '-' . $this->ratios[$key] . 'p.mp4';

        try {
            $converted = FFMpeg::fromDisk('public')
                ->open($originalFileName)
                ->export()
                ->toDisk('public')
                ->inFormat(new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))
                ->resize($this->width[$key], $this->height[$key])
                ->save($fileName);

            return ['status' => true, 'fileName' => $fileName];
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return ['status' => false];
        }
    }
}
