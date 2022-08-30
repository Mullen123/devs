@extends('layouts.app')


@section('content')
<div class="container ">


	<div class="row "style="align-items:center;  padding-top:30px ;box-shadow: 0 30px 50px -6px black; border-radius: 0.5rem; ">

		<h3 style="color:#6c757d;  text-align: center; "><strong>Editar perfil: {{Auth::user()->name}}</strong></h3>



		<div class="col-md-6" style="padding-right:50px; background: #fff !important; margin-bottom: 25px !important; margin:0 auto; margin-top: 25px !important" > 

			<form method="POST" action="{{route('profile.store')}}" enctype="multipart/form-data"><br>

				@csrf
				<!--  username -->
				<div class="form-outline">
					<label class="form-label" for="name" style="color:#A9A9A9">Username</label>
					<input  class="form-control  @error('name') is-invalid @enderror"  id="name" type="" name="name" value="{{Auth::user()->name}}"  autocomplete="name" autofocus placeholder="Tu nombre de usuario"  />


					@error('name')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
					<br>

					<label class="form-label" for="username" style="color:#A9A9A9">Imagen de perfil</label><br>

					<input type="file"
					id="image" name="image"
					accept="image/png, image/jpeg">



				</div><br>
					<!-- Submit button -->
			<button type="submit" class="btn btn-primary btn-block mb-6" id="btnEdit">Guardar cambios</button>
			</form>
			<br>
		</div>



	</div>
	@endsection
