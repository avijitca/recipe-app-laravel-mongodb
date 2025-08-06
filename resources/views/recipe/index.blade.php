
@extends('layouts.default')

@section('content')
<div class="container">
    <h3>All Recipe</h3>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@if(auth_user())
    Hello, {{ auth_user()['name'] }}
@endif
<!-- <pre>
    {{ print_r($recipes, true) }}
</pre>     -->
    <table class="table">
        <thead>
            <tr>
                <th style="text-align:left;">Title</th>
                <th>Description</th>
                <th>Ingredients</th>
                <th>Steps</th>
                <th>Cooking Time</th>
                <th>Created At</th>
                <th>Add reviews</th>
                <th>Actions</th>
            </tr>
            @foreach($recipes as $recipe)
            <tr>
                <td>
                    <a href="{{route('recipe.details', (string)$recipe->id)}}">
                    {{ $recipe->title ?? '-' }}
                    </a>
                </td>
                <td><a href="{{route('recipe.details', (string)$recipe->id)}}">{{ $recipe->description ?? '-' }}</a></td>
                <td>
                    @if(is_array($recipe->ingredients ?? null))
                        <ul>
                            @foreach($recipe->ingredients as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @else
                        {{ $recipe->ingredients ?? '-' }}
                    @endif
                </td>
                <td>
                    @if(is_array($recipe->steps ?? null))
                        <ol>
                            @foreach($recipe->steps as $step)
                                <li>{{ $step }}</li>
                            @endforeach
                        </ol>
                    @else
                        {{ $recipe->steps ?? '-' }}
                    @endif
                </td>
                <td>{{ $recipe->cooking_time ?? '-' }}</td>
                @php
                    
                @endphp
                
                <td></td>
                <td>
                    <a href="{{ route('review.add', (string) $recipe->id) }}" class="btn btn-default btn-sm">
                        <button class="bi bi-highlights"></button>
                    </a>
                </td>
                <td>
                    <a href="{{ route('recipe.edit', (string) $recipe->id) }}" class="btn btn-default btn-sm">
                        <button class="bi bi-pencil"></button>
                    </a>
                    <a href="{{ route('recipe.delete', (string) $recipe->id) }}" class="btn btn-default btn-sm"  onClick="return confirm('Are you sure you want to delete this record?');">
                        <button class="bi bi-trash"></button>
                    </a>
                </td>
            </tr>
        @endforeach
        </thead>
        <tbody>
           
        </tbody>
    </table>
    
</div>
@endsection
