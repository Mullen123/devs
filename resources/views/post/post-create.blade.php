@extends('layouts.app')


@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
@endsection


@section('content')


<div class="container" id="container-perfil">


	<div class="row "style="align-items:center; padding-top:50px">



		<div class="col-md-6" >
			<!-- Dropzone -->

			<form action="{{route('image.store')}}"
			method="POST"
			class="dropzone"
			id="my-awesome-dropzone"
			enctype="multipart/form-data">

		</form>


	</div>




	<div class="col-md-6" style="padding-right:50px; color:#878686" id="datos-user"> 

		<form method="POST" action="{{route('post.store')}}">
			@csrf
			<!--  nombre del post -->
			<div class="form-outline mb-4">
				<input  class="form-control  @error('title') is-invalid @enderror"  id="title" type="" name="title" value="{{ old('title') }}"  autocomplete="title" autofocus placeholder="Ingrese tiítulo de la publicación" />
				<label class="form-label" for="title" style="color:#A9A9A9">Título</label>

				@error('title')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror

				<textarea

				class="form-control  @error('description') is-invalid @enderror"  id="description" type="" name="description" value="{{ old('description') }}" autocomplete="description" autofocus placeholder="Ingrese la descripción de la Publicación"
				>{{old('description')}}</textarea>
				<label class="form-label" for="description" style="color:#A9A9A9">Descripción</label>


				@error('description')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror

			</div>


			<div class="form-outline mb-4">
				<input type="hidden" name="image" value="{{old('image')}}">
				@error('image')

				<strong style="font-size: .875em; color: #dc3545;">{{ $message }}</strong>

				@enderror

			</div>

			<!-- Submit button -->
			<button type="submit" class="btn btn-primary btn-block mb-4" id="btnCrear">Crear Publicación</button>

		</form>
	</div>

</div>

</div>
@endsection


@section('js')
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
<script type="text/javascript">


</script>




<script type="text/javascript">


	Dropzone.options.myAwesomeDropzone = {
		headers:{
			'X-CSRF-TOKEN' : "{{csrf_token()}}"
		},
		dictDefaultMessage: "Sube aquí tu imagen",
		acceptedFiles: "image/jpeg,image/png,image/gif,image/jpg",
		maxFiles: 1,
		addRemoveLinks: true,
		dictRemoveFile: 'Borrar Archivo',


		init: function() {
			if(document.querySelector('input[name="image"]').value.trim()){
				const imageShared = {};
				imageShared.size = 5555;
				imageShared.name = document.querySelector('input[name="image"]').value;


				this.options.addedfile.call(this,imageShared);



				this.options.thumbnail.call(
					this,
					imageShared,
					"image/uploads/"+imageShared.name);


				imageShared.previewElement.classList.add(
					"dz-success",
					"dz-complete"
					);

			}

		},


		/*si se cargo correctamente la imagen*/
		success: function(file, response){document.querySelector('input[name="image"]').value = response.image;

	},
		//si remomevos el archivo el valor lo dejamos limpio y limpiamos el dropzone
		removedfile: function(file){
			file.previewElement.remove();
			document.querySelector('input[name="image"]').value = '';

		},


		/*si se borra la imagen entonces limpiamos el valor de la misma*/



	};



</script>










@endsection