<?php

namespace App\Http\Controllers\Package;

use App\Http\Controllers\BaseWebController as Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class LaravelFfmpegController extends Controller
{
    public function index()
    {
        $media = Media::where('type', MEDIA_TYPE_VIDEO)->get();

        return view('packages.laravel-ffmpeg.index', compact('media'));
    }

    public function store(Request $request)
    {
        dd($request);
    }
}
