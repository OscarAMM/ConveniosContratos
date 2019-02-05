@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                    <table>
        <thead>
        <th>Name</th>
        <th>E-Mail</th>
        <th>User</th>
        <th>Admin</th>

        <th></th>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <form action="{{ action('RegisterAdminController@postAdminAssignRoles') }}" method="post">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }} <input type="hidden" name="email" value="{{ $user->email }}"></td>
                    <td><input type="checkbox" name="role_user" {{ $user->hasRole('user') ? 'checked' : '' }} ></td>
                    <td><input type="checkbox" name="role_admin" {{ $user->hasRole('admin') ? 'checked' : '' }} ></td>
                    {{ csrf_field() }}
                    <td><button type="submit">Assign Roles</button></td>
                </form>
            </tr>
        @endforeach
        </tbody>
    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection