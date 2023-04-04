@extends('layouts.app')
@php ($isModerator = null)
@section('content')
    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-danger text-center">
                {{ session('message') }}
            </div>
        @endif
        <div class="d-flex justify-content-center flex-column align-items-center">
            <h1 class="text-center">Feed</h1>
            @if(Auth::check())
                <a href="{{ route('posts.create') }}" class="btn btn-primary my-1">Create new post</a> {{--         Only for logged users           --}}
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- Checking if the logged user is moderator --}}
                @isset(Auth::user()->id)
                    @foreach($roles as $role)
                        @if($role->name=='Moderator')
                            @foreach($role->users as $user)
                                @if(Auth::user()->id == $user->id)
                                    <div hidden>{{$isModerator=true}}</div>
                                @endif
                            @endforeach
                        @endif
                        @if($role->name=='User Administrator')
                            @foreach($role->users as $user)
                                @if(Auth::user()->id == $user->id)
                                    <div hidden>{{session(['isAdmin' => true])}}</div>
                                @endif
                            @endforeach
                        @endif
                            @if($role->name=='Theme Manager')
                                @foreach($role->users as $user)
                                    @if(Auth::user()->id == $user->id)
                                        <div hidden>{{session(['isThemeManager' => true])}}</div>
                                    @endif
                                @endforeach
                            @endif
                    @endforeach
                @endisset
                {{--Populating my feed--}}
                @foreach($posts as $post)
                    <div class="card">
                        <div class="card-body border">
                            <h4 class="card-title">{{$post->title}}</h4>
                            <h2 class="card-text">{{$post->content}}</h2>
                            <img class="card-img-top img-fluid" src="{{$post->picture}}" alt="Card image cap">
                            <p class="card-text my-2"><small class="text-muted">
                                    {{$post->updated_at ?? $post->created_at}}
                                </small></p>
                                @isset(Auth::user()->id)
                                    @if(Auth::user()->id == $post->users['id'] || $isModerator)
                                        <form class="float-end" method="post" action="{{ route('posts.destroy', $post->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    @endif
                                    @if(Auth::user()->id == $post->users['id'])
                                        <a href="{{route('posts.edit', $post->id)}}" class="btn btn-primary card-link float-end">Edit</a>
                                    @endif
                                @endisset
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection
