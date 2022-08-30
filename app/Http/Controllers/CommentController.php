<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request,User $user,Post $post){

    	/*validacion del campo*/
    	$this->validate($request,[
    		'comment' => 'required|max:255'
    	]);

    	$comment = new Comment();
    	$comment->comment = $request->comment;
    	$comment->user_id = auth()->user()->id;
    	$comment->post_id = $post->id;

    	$comment->save();

    	/*imprimimos un mensaje*/
    	return back()->with('message','Comentario realizado de forma exitosa');

    }
}
