@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="btn btn-primary" href="{{ route('people.create') }}"> Create New Admin User </a>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Roles</th>
                            <th scope="col" colspan="2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($people as $person)
                            <tr>
                                <td>{{$person->name}}</td>
                                <td>
                                    <ul>
                                        @foreach($person->roles as $role)
                                            <li>{{$role->name}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{route('people.edit', $person->id)}}">Edit</a>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('people.destroy', $person->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
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
