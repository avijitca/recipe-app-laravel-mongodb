<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\CheckUserSession;

Route::get('/login',[AuthController::class,'showLoginForm'])->name('auth.login');
Route::post('login',[AuthController::class,'login'])->name('login.submit');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware([CheckUserSession::class])->group(function () {
Route::get('/recipe',[RecipeController::class,'index'])->name('recipe.index');
Route::get('/recipe/create', [RecipeController::class, 'create'])->name('recipe.create');
Route::post('/recipe', [RecipeController::class, 'store'])->name('recipe.store');
Route::get('/recipe/edit/{id}', [RecipeController::class,'edit'])->name('recipe.edit');
Route::post('recipe/{id}/update',[RecipeController::class,'update'])->name('recipe.update');
Route::get('/recipe/delete/{id}',[RecipeController::class, 'delete'])->name('recipe.delete');
Route::get('/recipe/recipeDetails/{id}',[RecipeController::class,'recipeDetails'])->name('recipe.details');
Route::get('/recipe/createUser',[RecipeController::class,'createUser'])->name('new.user');
Route::post('/recipe/storeUser',[RecipeController::class,'storeUser'])->name('store.user');
Route::get('/recipe/allUsers',[RecipeController::class,'allUsers'])->name('show.users');
Route::get('recipe/editUser/{id}', [RecipeController::class,'editUser'])->name('edit.user');
Route::post('recipe/{id}/updateUser', [RecipeController::class, 'updateUser'])->name('update.user');
Route::get('recipe/deleteUser/{id}',[RecipeController::class,'deleteUser'])->name('delete.user');
Route::get('recipe/changePassword',[RecipeController::class,'changePassword'])->name('change.password');
Route::post('recipe/updatePassword',[RecipeController::class,'updatePassword'])->name('update.password');


Route::get('review/addReview/{id}',[ReviewController::class,'addReview'])->name('review.add');
Route::post('review/{id}/store',[ReviewController::class,'store'])->name('review.store');
Route::get('review/reviews',[ReviewController::class,'reviews'])->name('review.reviews');
});

// Testing the model
use App\Models\Recipes;
Route::get('/model-test', function () {
    $recipes = Recipes::all();
    return response()->json($recipes);
});

// Testing to get data from the database
use Illuminate\Support\Facades\DB;
Route::get('/test-db', function () {
     $docs = DB::connection('mongodb')
              ->table('allrecipe')
              ->get();

    return response()->json($docs);
});