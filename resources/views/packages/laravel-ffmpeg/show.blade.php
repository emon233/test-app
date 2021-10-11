@extends('packages.layouts.master')

@section('page-title', 'Laravel FFMPEG')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="player">
                <video
                    controls
                    crossorigin
                    playsinline
                    class="video-player"
                    data-poster="{{ $media->access_url }}"
                    id="player"
                >
                    <!-- Video files -->
                    <source
                        src="{{ URL::to('/') . '/storage/' . $media->file_name }}"
                        type="{{ $media->file_mime_type }}"
                        size="{{ str_replace('p', '', $media->file_resolution) }}"
                    />
                    @foreach ($videos as $key=>$video)
                    <source
                        src="{{ URL::to('/') . '/storage/' . $video->file_name }}"
                        type="{{ $video->file_mime_type }}"
                        size="{{ str_replace('p', '', $video->file_resolution) }}"
                    />
                    @endforeach
                </video>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>

@endsection


@section('content-scripts')

<script>
    $(document).ready(function(){
        const player = new Plyr('#player');
    })
</script>

@append
