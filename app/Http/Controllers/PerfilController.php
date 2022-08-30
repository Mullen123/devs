<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\User;


class PerfilController extends Controller
{


	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(){
		return view('perfil.index');
	}

	public function store(Request $request){

		/*validacion del campo*/
		$this->validate($request,[
			'name' => 'required|unique:users|min:3| max:20',

		]);

		if( $request->image ){
			$image = $request->file('image');
			/*generamos un id unico a la imagen*/
			$imageName = Str::uuid(). ".". $image->extension();
			$imageServer = Image::make($image);
			$imageServer->fit(500,500);
			$imagePath = public_path('image/perfiles'). '/' .$imageName;
			$imageServer->save($imagePath);	

		}
		
		$user = User::find(Auth()->user()->id);
		$user->name = $request->name;
		$user->image = $imageName ?? Auth()->user()->image ?? NULL;
		$user->save();
		return redirect()->route('home',$user->name);
	}





}
