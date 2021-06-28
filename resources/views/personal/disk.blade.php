@extends('layouts.app')

@section('content')
    <div class="row justify-content-end mb-3">
        <form class="file-upload" action="{{ route('upload-file', [$user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input id="input__file" class="form-control-file" type="file" name="file">
            <label for="input__file" class="input__file-button btn btn-success">
                <span class="input__file-button-text">Upload file</span>
            </label>
        </form>
    </div>
    <div class="row">
        @if(count($files) == 0)
            <h2 class="text-center">Files not found</h2>
        @else
        @foreach($files as $file)
        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17a105c4c75%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17a105c4c75%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                <div class="card-body">
                    <p class="card-text">{{ $file->name }}</p>
                    <p class="card-text">link: {{ $file->link }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="#" class="btn btn-sm btn-outline-secondary">Share</a>
                            <a href="{{ route('download-file', $file->link) }}" class="btn btn-sm btn-outline-secondary">Download</a>
                            <a href="#" class="btn btn-sm btn-outline-secondary">Delete</a>
                        </div>
                        <small class="text-muted">Downloads: {{ $file->downloads }}</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
@endsection
