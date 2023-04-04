@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New User') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('people.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Insert Name">
                            @error('name')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Insert email">
                            @error('email')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="text" class="form-control" id="password" name="password" value="{{old('password')}}" placeholder="Insert Password">
                            @error('password')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="languages" class="form-label">Roles:</label>
                            @foreach($roles as $role)
                                <div class="form-check">
                                    <input {{ is_array(old('role_ids')) && in_array($role->id, old('role_ids')) ? 'checked' : ''}}
                                           class="form-check-input"
                                           type="checkbox"
                                           value="{{$role->id}}"
                                           name="role_ids[]"
                                           id="role">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{$role->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-primary" href="{{ route('people') }}"> Cancel </a>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
