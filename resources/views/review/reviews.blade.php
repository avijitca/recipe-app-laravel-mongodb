@extends('layouts.default')

@section('content')
<div class="container">
    <h3>Reviews</h3>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th style="text-align:left;">Rating</th>
            </tr>
        </thead>
    </table>

</div>
@endsection