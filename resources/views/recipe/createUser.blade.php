@extends('layouts.default')

@section('content')
<div class="container">
    <h3>Add User</h3>
    @if ($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('store.user') }}" method="POST">
        @csrf
        <table class="table">
        <tr>
            <td><b>User Name</b></td>
            <td><input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required></td>
        </tr>
        <tr>
            <td><b>User Email</b></td>
            <td><input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" required></td>
        </tr>
        <tr>
            <td><b>Password</b></td>
            <td><input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" required></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" class="btn btn-dark form-control">Create User</button></td>
        </tr>
        </table>
    </form>
</div>
@endsection