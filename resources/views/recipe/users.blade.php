@extends('layouts.default')

@section('content')
<div class="container">
    <h3>All Users</h3>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@if(auth_user())
    Hello, {{ auth_user()['name'] }}
@endif
    <table class="table">
        <thead>
            <tr>
                <th style="text-align:left;">User Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="{{ route('edit.user', (string) $user->id ) }}" class="btn btn-default btn-sm">
                    <button class="bi bi-pencil"></button>
                </a>
                <a href="{{ route('delete.user', (string) $user->id) }}" class="btn btn-default btn-sm"  onClick="return confirm('Are you sure you want to delete this record?');">
                    <button class="bi bi-trash"></button>
                </a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection