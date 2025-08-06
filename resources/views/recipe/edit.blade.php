@extends('layouts.default')

@section('content')
<div class="container">
    <h3>Update Recipe</h3>
    @if ($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('recipe.update',(string) $recipe->id) }}" method="POST">
        @csrf
        <table class="table">
        <tr>
            <td><b>Title</b></td>
            <td><input type="text" name="title" id="title" class="form-control" value="{{ $recipe->title }}" required></td>
        </tr>
        <tr>
            <td><b>Description</b></td>
            <td><textarea name="description" id="description" class="form-control">{{ $recipe->description }}</textarea></td>
        </tr>
        <tr>
            <td><b>Ingredients</b></td>
            <td><input type="text" name="ingredients" id="ingredients" class="form-control" value="{{ implode(', ', $recipe->ingredients ?? []) }}" required></td>
        </tr>
        <tr>
            <td><b>Steps (comma separated)</b></td>
            <td><input type="text" name="steps" id="steps" class="form-control" value="{{ implode(', ', $recipe->steps ?? []) }}" required></td>
        </tr>
        <tr>
            <td><b>Cooking Time (minutes)</b></td>
            <td><input type="text" name="cooking_time" id="cooking_time" class="form-control" value="{{ $recipe->cooking_time }}" required></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" class="btn btn-dark form-control">Update Recipe</button></td>
        </tr>
        </table>
    </form>


</div>
@endsection