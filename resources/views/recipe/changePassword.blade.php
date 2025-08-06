@extends('layouts.default')

@section('content')
<div class="container">
    <h3>Change Password</h3>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    @if ($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('update.password') }}" method="POST">
        @csrf
        <table class="table">
        <tr>
            <td><b>Old Password</b></td>
            <td><input type="password" name="old_password" id="old_password" class="form-control" value="{{ old('old_password') }}" required></td>
        </tr>
        <tr>
            <td><b>New Password</b></td>
            <td><input type="password" name="new_password" id="new_password" class="form-control" value="{{ old('new_password') }}" required></td>
        </tr>
        <tr>
            <td><b>Retype New Password</b></td>
            <td><input type="password" name="retype_new_password" id="retype_new_password" class="form-control" value="{{ old('retype_new_password') }}" required></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" class="btn btn-dark form-control">Change Password</button></td>
        </tr>
        </table>
    </form>
</div>
@endsection