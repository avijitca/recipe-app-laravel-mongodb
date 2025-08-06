<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipes;
use Illuminate\Support\Facades\DB;
// use MongoDB\Laravel\Eloquent\Casts\ObjectId;
use PhpParser\Node\Expr\Cast\Object_;
use MongoDB\BSON\ObjectId;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;



class RecipeController extends Controller{
    public function index(){
        // $recipes=Recipes::All();
        // echo '<pre>'; 
        $recipes = DB::connection('mongodb')->table('allrecipe')->get();    
        // dd($recipes);    
        return view('recipe.index',compact('recipes'));
    }
    public function create(){
        return view('recipe.create');
    }
    public function store(Request $request){
        $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'ingredients'   => 'required|string',
            'steps'         => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:50480',
            'cooking_time'  => 'required|numeric',
        ]);
        // Convert comma-separated ingredients/steps to arrays
        $ingredients = array_map('trim', explode(',', $request->input('ingredients')));
        $steps = array_map('trim', explode(',', $request->input('steps')));

        // Handle file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->move(public_path('uploads'), $filename);
            $imagePath = 'uploads/' . $filename;
        } else {
            $imagePath = null;
        }

        // Insert into MongoDB
        DB::connection('mongodb')
            ->table('allrecipe')
            ->insert([
                'title'         => $request->input('title'),
                'description'   => $request->input('description'),
                'ingredients'   => $ingredients,
                'steps'         => $steps,
                'cooking_time'  => (int) $request->input('cooking_time'),
                'image'         =>$imagePath,
                'created_at'    => now()
            ]);
        return redirect('/recipe')->with('success', 'Recipe inserted successfully!');
    }
    public function edit($id){
        $recipe=DB::connection('mongodb')
                ->table('allrecipe')
                ->where('_id', new ObjectId($id))
                ->first();
                // dd($recipe);
                // exit;
        if(!$recipe){
            return redirect('/recipe')->with('error','Recipe not found!');
        }
        return view('recipe.edit',compact('recipe'));
    }
    public function update(Request $request,$id){
         $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'ingredients'   => 'required|string',
            'steps'         => 'required|string',
            'cooking_time'  => 'required|numeric',
        ]);
        $ingredients = array_map('trim', explode(',', $request->input('ingredients')));
        $steps = array_map('trim', explode(',', $request->input('steps')));

        DB::connection('mongodb')
            ->table('allrecipe')
            ->where('_id', new ObjectId($id))
            ->update([
                'title'        => $request->input('title'),
                'description'  => $request->input('description'),
                'ingredients'  => $ingredients,
                'steps'        => $steps,
                'cooking_time' => (int) $request->input('cooking_time'),
            ]);

        return redirect('/recipe')->with('success', 'Recipe updated successfully!');
    }
    public function delete($id){
        $objectId= new ObjectId($id);
        DB::connection('mongodb')
            ->table('allrecipe')
            ->where('_id', $objectId)
            ->delete();
        return redirect('/recipe')->with('success', 'Recipe deleted successfully!');

    }
    public function recipeDetails($id){
        $recipe=DB::connection('mongodb')
                ->table('allrecipe')
                ->where('_id', new ObjectId($id))
                ->first();
        $reviews=DB::connection('mongodb')
                ->table('reviews')
                ->where('recipe_id', $id)
                ->get();
            //  dd(auth_user()['id']);
            // dd($reviews);
        return view('recipe.recipeDetails',compact('recipe','reviews'));
    }
    public function createUser(){
        return view('recipe.createUser');
    }
    public function storeUser(Request $request){
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string',
        ]);
        // Insert into MongoDB
        DB::connection('mongodb')
            ->table('users')
            ->insert([
                'name'         => $request->input('name'),
                'email'   => $request->input('email'),
                'password'   => bcrypt($request->input('password')),
            ]);
        return redirect('/recipe')->with('success','User created successfully!');
    }
    public function allUsers(){
        $users = DB::connection('mongodb')->table('users')->get();    
        return view('recipe.users',compact('users'));
    }
    public function editUser($id){
        $user=DB::connection('mongodb')
                ->table('users')
                ->where('_id', new ObjectId($id))
                ->first();
        if(!$user){
            return redirect('/recipe/allUser')->with('error','User not found!');
        }
        return view('recipe.editUser',compact('user'));
    }
    public function updateUser(Request $request, $id){
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|',
        ]);

        DB::connection('mongodb')
            ->table('users')
            ->where('_id', new ObjectId($id))
            ->update([
            'name'        => $request->input('name'),
            'email'   => $request->input('email'),
            ]);
        return redirect('/recipe/allUsers')->with('success','User has been updated successfully!');
    }
    public function deleteUser($id){
        $objectId= new ObjectId($id);
        DB::connection('mongodb')
            ->table('users')
            ->where('_id', $objectId)
            ->delete();
        return redirect('/recipe/allUsers')->with('success', 'User deleted successfully!');
    }
    public function changePassword(){
        return view('recipe.changePassword');
    }
    public function updatePassword(Request $request){   
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'retype_new_password' => 'required|same:new_password',
        ]);
        $user = Session::get('user');
        // dd($user);
        if(!$user){
            return redirect('/login')->with('error','You must be logged in!');
        }
        // $dbUser = DB::table('users')->where('_id', new \MongoDB\BSON\ObjectId($user['id']))->first();
        $dbuser=DB::connection('mongodb')
            ->table('users')
            ->where('_id',$user['id'])
            ->first();


        if (!Hash::check($request->old_password, $dbuser->password)) {
            return back()->with('error', 'Old password does not match.');
        }

        DB::connection('mongodb')
            ->table('users')
            ->where('_id', new ObjectId($user['id']))
            ->update([
            'password'  => Hash::make($request->new_password),
            ]);

        // DB::table('users')
        // ->where('_id', new \MongoDB\BSON\ObjectId($user['id']))
        // ->update([
        //     'password' => Hash::make($request->new_password),
        // ]);
        return back()->with('success', 'Password changed successfully.');
    }
}
