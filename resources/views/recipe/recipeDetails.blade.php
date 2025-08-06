@extends('layouts.default')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h4>Recipe Details</h4>
    <br />
    <table class="table">
        <tr>
            <td><b>Rcipe:</b></td>
            <td>{{$recipe->title ?? '-'}}</td>
            <td><b>Description:</b></td>
            <td>{{$recipe->description ?? '-'}}</td>
            <td><b>Cooking time:</b></td>
            <td>{{$recipe->cooking_time ?? '-' }} Mins</td>
        </tr>
        <tr>
            <td><b>Steps:</b></td>
            <td colspan="5">
                @if(is_array($recipe->steps ?? null))
                @foreach($recipe->steps as $step)
                {{ $step.', ' }}
                @endforeach
                @else
                {{ $recipe->steps ?? '-' }}
                @endif

            </td>
        </tr>
    </table>
    <br>
    <h4>Reviews</h4>
    <table class="table">
        @foreach($reviews as $review)
        <tr>
            <td><b>User Name:</b></td>
            <td>{{ $review->user_name }}</td>
        </tr>
        <tr>
            <td><b>Rating:</b></td>
            <td>{{ $review->rating }}</td>
        </tr>
        <tr>
            <td><b>Comment:</b></td>
            <td>{{ $review->comment }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection