@extends('layouts.app')


@section('css')

    <!-- bootsrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

<style type="text/css">
 .card {
  margin: 20px;
  position: relative;
  max-width: 400px;
  max-height: 400px;
  box-shadow: 0 15px 30px -6px black;



}



.card img {
  width: 100%;
  height: 98%;
  object-fit: cover;
  display: block;
  position: relative;
  border-radius: 10px;

}


.inf-post{
  background: #fff;
  text-align: left;
  border-radius: 10px;
  max-width: 95%;

}
.inf-post p{
 margin-left: 10px;
}
#comments{
  border-style: dotted;

}

#btn_delete{
  padding: 0; border: none; background: none;
  margin-left:10px; 


}
#btn_like{
  padding: 0; border: none; background: none;

}

.likes{

  display: flex;


}
.likes > p {
  margin: 0;
}
}
</style>
@endsection
@section('content')

<div class="container text-center">


 <div class="row "style="align-items:center;  padding-top:30px ;box-shadow: 0 30px 50px -6px black; border-radius: 0.5rem; ">

  <h3><strong style="color:#6c757d">{{$post->title}}</strong></h3>


  <div class="col-md-6" >

    <div class="cards">
      <div class="card">

        <img src="{{asset('image/uploads'.'/'.$post->image)}}" >  

      </div>
      <!--verificamos si hay un usuario autenticado-->
      @auth  
      <div  class="inf-post">
        <!--apartado de likes-->
        <div class="likes">

          <livewire:like-post :post=$post>

   

        </div>






        <p>  <i class="fa fa-child"></i>  {{ $post->user->name }}</p>

        <p> <i class="fa fa-clock-o"></i>  {{$post->created_at->diffForHumans()}}</p>

        <p>{{$post->description}}</p>

        @if($post->user_id == Auth::user()->id)
        <form action="{{ route('post.destroy', $post->id) }}" method="POST">
          @csrf
          @method('delete')
          <button type="submit" id="btn_delete" ><i class="fa fa-trash-o" style="font-size:20px;color:red"></i>Eliminar Publicación</button>
        </form><br>
        @endif


      </div>

    </div>

  </div>

  <div class="col-md-6" id = "form-comment"> 



    <form method="POST" action="{{route('comment.store',['post'=>$post,'user'=>$user])}}">

      <!--mensaje de comentario almacenado-->
      @if(Session::has('message'))
      <br>
      <div class="alert alert-info" role="alert" id="alert">
       {{ Session::get('message') }}
     </div>
     @endif

     @csrf
     <!--  nombre del post -->
     <div class="form-outline mb-4">

      <h5 style="padding-top: 50px;">Agregar comentario</h5><br>

      <textarea

      class="form-control  @error('comment') is-invalid @enderror"  id="comment" type="" name="comment" value="{{ old('comment') }}" autocomplete="description" autofocus placeholder="Ingrese un comentario para la publicación"
      >{{old('comment')}}</textarea>
      <label class="form-label" for="comment" style="color:#A9A9A9; text-align:left;">Añade un comentario</label>



      @error('comment')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror

    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4" >Comentar</button>

  </form>



  <!--comentarios-->
  @if($post->comments->count()> 0)
  <h5 style="padding-top: 50px;"><i class='fa fa-commenting'></i>Comentarios</h5>
  @foreach($post->comments as $comment)
  <div  id= "comments">
    <a href="{{route('home',$comment->user)}}"><p class="font-bold">{{$comment->user->name}}</p></a>

    <p class="font-bold">{{$comment->comment}}</p> 
    <p style="font-size:15px" class="font-bold">{{$comment->created_at->diffForHumans()}}</p> 


  </div>

  @endforeach
  <br>
  @else
  <p>No hay comentarios</p>
  @endif
</div> 

@endauth



<!--si no esta autenticado-->
@guest

<p> <i class="fa fa-clock-o"></i>  {{$post->created_at->diffForHumans()}}</p>

<p>{{$post->description}}</p>

</div>
@endguest

</div>

</div>

@endsection

@section('js')
<script type="text/javascript"  src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script type="text/javascript">
 $(document).ready(function() {        
  setTimeout(function() {
    $("#alert").fadeOut(2000);
  },1500);
});
</script>

</script>

@endsection
