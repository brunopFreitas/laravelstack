@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Post') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('posts.update', $post->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{old('title') ?? $post->title}}" placeholder="Insert Title">
                            @error('title')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="content1" class="form-label">Content:</label>
                            <input type="text" class="form-control" id="content1" name="content1" value="{{old('content1') ?? $post->content}}" placeholder="Insert content">
                            @error('content')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="picture" class="form-label">Picture:</label>
                            <input type="text" class="form-control" id="picture" name="picture" value="{{old('picture') ?? $post->picture}}" placeholder="Insert Picture URL">
                            @error('picture')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-primary" href="{{ route('posts') }}"> Cancel </a>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
