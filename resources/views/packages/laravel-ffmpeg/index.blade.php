@extends('packages.layouts.master')

@section('page-title', 'Laravel FFMPEG')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed">
                            <thead>
                                <th>#</th>
                                <th>Original</th>
                                <th>Access URL</th>
                                <th>Link</th>
                            </thead>
                            <tbody>
                                @foreach ($media as $key=>$item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->original_name }}</td>
                                    <td>{{ $item->access_url }}</td>
                                    <td>
                                        <a href="{{ route('package.laravel-ffmpeg.show', ['id' => $item->id]) }}">Look Up</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-4">
            <div class="card">
                <div class="card-header">{{ __('Upload File') }}</div>
                <div class="card-body">
                    <form method="post" action="{{ route('package.laravel-ffmpeg.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="video_file">{{ __('Select File') }}</label>
                            <div class="col-12">
                                <input type="file" name="video_file" id="video_file" class="form-control" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success btn-sm float-right">{{ __('Submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
