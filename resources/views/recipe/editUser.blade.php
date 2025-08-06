@extends('layouts.default')

@section('content')
<div class="container">
    <h3>Update User</h3>
    @if ($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('update.user',(string) $user->id) }}" method="POST">
        @csrf
        <table class="table">
        <tr>
            <td><b>User Name</b></td>
            <td><input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required></td>
        </tr>
        <tr>
            <td><b>Email</b></td>
            <td><input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" required></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" class="btn btn-dark form-control">Update User</button></td>
        </tr>
        </table>
    </form>

</div>
@endsection


