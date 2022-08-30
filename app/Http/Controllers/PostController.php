<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class PostController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.post-create');
    }

    
    public function store(Request $request)
    {
     /*validaciones*/

     $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'image'=>'required'
    ]);


/*
       Post::create([

        'title' => $data["title"],


        'description' => $data["description"],

        'image' => $data["image"],
        'user_id' => auth()->user()->id
    ]);

*/

    $post = new Post;
    $post->title = $request->title;
    $post->description = $request->description;
    $post->image = $request->image;
    $post->user_id = auth()->user()->id;
    $post->save();


    return redirect()->route('home',Auth::user()->name);

}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(User $user,Post $post)
    {

        return view('post.post-show',
            ['post' => $post,
            'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        /*se trae la informacion del id*/
        $id_post = Post::find($id);


        $id_post->delete();

        /*se elimina la imagen asociada a ese id*/

        $imagePath = public_path('image/uploads'). '/' .$id_post->image;

        if(file_exists($imagePath)){
            unlink($imagePath);
        }

        return redirect()->route('home',Auth::user()->name);

    }

}
