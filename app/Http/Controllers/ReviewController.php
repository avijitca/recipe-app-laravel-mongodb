<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;
use MongoDB\BSON\ObjectId;
use MongoDB\Laravel\Eloquent\Casts\ObjectId as CastsObjectId;

class ReviewController extends Controller{
    public function addReview($id){
        $recipe=DB::connection('mongodb')
        ->table('allrecipe')
        ->where('_id', new ObjectId($id))
        ->first();
        // dd($recipe);
        if(!$recipe){
            return redirect('/recipe',)->with('error','Something went wrong!');
        }
        return view('review.addReview',compact('recipe'));
    }
    public function store(Request $request){
        // dd($request);
        $request->validate([
            'rating'=>'required',
            'comment'=>'required'
        ]);
        DB::connection('mongodb')
            ->table('reviews')
            ->insert([
                'recipe_id'=>$request->input('recipe_id'),
                'user_name'=>auth_user()['name'],
                'rating'=>$request->input('rating'),
                'comment'=>$request->input('comment')
            ]);
        return redirect('/recipe')->with('success','Thank you for your feedback!');
    }
    public function reviews(){
        $reviews=DB::connection('mongodb')->table('reviews')->get();
        return view('review.reviews',compact('reviews'));
    }
}
