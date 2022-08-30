<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Post;
class MainController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}


	public function index(){


		$followers = auth::user()->following->pluck('id')->toArray();

		$posts = Post::whereIn('user_id',$followers)->get();

		return view('main',compact('posts'));	
	}
	
}
