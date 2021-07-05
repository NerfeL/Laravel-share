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
        @if(count($filesArray) == 0)
            <h2 class="text-center">Files not found</h2>
        @else
        @foreach($filesArray as $file)
        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <div class="m-auto">{!!  $file['qr']->getHtmlDiv() !!}</div>
                <div class="card-body">
                    <p class="card-text">{{ $file['name'] }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-secondary btn-share" data-url="{{ $file['full_url'] }}">Share</button>
                            <a href="{{ route('download-file', $file['link']) }}" class="btn btn-sm btn-outline-secondary">Download</a>
                            <a href="#" class="btn btn-sm btn-outline-secondary">Delete</a>
                        </div>
                        <small class="text-muted">Downloads: {{ $file['downloads'] }}</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
@endsection
