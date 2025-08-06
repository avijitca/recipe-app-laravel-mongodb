@extends('layouts.default')

@section('content')
<div class="container">
    <h3>Add Recipe</h3>
    @if ($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('recipe.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <table class="table">
        <tr>
            <td><b>Title</b></td>
            <td><input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required></td>
        </tr>
        <tr>
            <td><b>Description</b></td>
            <td><textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea></td>
        </tr>
        <tr>
            <td><b>Ingredients</b></td>
            <td><input type="text" name="ingredients" id="ingredients" class="form-control" value="{{ old('ingredients') }}" required></td>
        </tr>
        <tr>
            <td><b>Steps (comma separated)</b></td>
            <td><input type="text" name="steps" id="steps" class="form-control" value="{{ old('steps') }}" required></td>
        </tr>
        <tr>
            <td><b>Cooking Time (minutes)</b></td>
            <td><input type="text" name="cooking_time" id="cooking_time" class="form-control" value="{{ old('cooking_time') }}" required></td>
        </tr>
        <tr>
            <td><b>Upload Image</b></td>
            <td><input type="file" name="image" class="form-control" required></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" class="btn btn-dark form-control">Create Recipe</button></td>
        </tr>
        </table>
    </form>


</div>
@endsection