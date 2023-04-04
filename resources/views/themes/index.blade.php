@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Themes List') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="btn btn-primary" href="{{ route('themes.create') }}"> Create New Theme </a>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col" colspan="3">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($themes as $theme)
                            <tr>
                                <td>{{$theme->name}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{route('themes.show', $theme->id)}}">Details</a>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{route('themes.edit', $theme->id)}}" {{$theme->name=='Default'?'hidden':'show'}}>Edit</a>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('themes.destroy', $theme->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit" {{$theme->name=='Default'?'hidden':'show'}}>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
