@extends('layouts.default')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    .star-rating {
        direction: rtl;
        display: inline-block;
        cursor: pointer;
    }

    .star-rating input {
        display: none;
    }

    .star-rating label {
        color: #ddd;
        font-size: 24px;
        padding: 0 2px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .star-rating label:hover,
    .star-rating label:hover~label,
    .star-rating input:checked~label {
        color: #ffc107;
    }
</style>
@section('content')
<div class="container">
    <h3>Add Review</h3>
    @if ($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @php
    // dd($recipe);
    @endphp
    <form action="{{ route('review.store',(string) $recipe->id) }}" method="POST">
        @csrf
        <label>Please give us your valuable review for the following Recipe item</label>
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
        <table class="table">
            <tr>
                <td><b>Rate Recipe</b></td>
                <td>
                    <div class="star-rating animated-stars">
                        <input type="radio" id="star5" name="rating" value="5">
                        <label for="star5" class="bi bi-star-fill"></label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4" class="bi bi-star-fill"></label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3" class="bi bi-star-fill"></label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2" class="bi bi-star-fill"></label>
                        <input type="radio" id="star1" name="rating" value="1">
                        <label for="star1" class="bi bi-star-fill"></label>
                    </div>
                    <p class="text-muted mt-2">Click to rate</p>
</div>
</td>
</tr>
<tr>
    <td><b>Comment</b></td>
    <td>
        <textarea name="comment" rows="3" class="form-control" required></textarea>
        <input type="hidden" name="recipe_id" value="{{ (string) $recipe->id }}">
    </td>
</tr>
<tr>
    <td></td>
    <td><button type="submit" class="btn btn-dark form-control">Add Review</button></td>
</tr>
</table>
</form>

</div>
<script>
    document.querySelectorAll('.star-rating:not(.readonly) label').forEach(star => {
        star.addEventListener('click', function() {
            this.style.transform = 'scale(1.2)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 200);
        });
    });
</script>
@endsection