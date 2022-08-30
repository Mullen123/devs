@extends('layouts.app')


@section('css')
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<style type="text/css">


  .card {
    margin: 20px;
    position: relative;
    max-width: 400px;
    max-height: 400px;
    box-shadow: 0 30px 50px -6px black;

  }


  .card-title {

    color: #878686;
    background-color: #fff;
    padding: 2%;
    font-size: 25px!important;
    border-top-right-radius: 4px;
    border-top-left-radius: 4px;
  }

  .card img {
    width: 100%;
    height: 98%;
    object-fit: cover;
    display: block;
    position: relative;
  }

  .card-desc {
    display: block;
    font-size: 1.2rem;
    position: absolute;
    height: 0;
    top: 0;
    opacity: 0;
    padding: 18px 8%;
    background-color: white;
    overflow-y: scroll;
    transition: 0.8s ease;
  }

  .card:hover .card-desc {
    opacity: 1;
    height: 100%;
  }

  h1 {
    font-size: 2.8rem;
    color: #fff;
    margin: 40px 0 20px 0;
    text-align: center;
  }



</style>
@endsection
@section('content')


<div class="container text-center" id="container-perfil">


 <div class="row "style="align-items:center; padding-top:50px">


  <div class="col-md-6" style="padding-left:200px" id="foto-perfil">
    <img src="{{$user->image ? asset('image/perfiles').'/'.$user->image : asset ('image/usuario.png')}}"></div>
    <div class="col-md-6" style="padding-right:350px; color:#878686" id="datos-user"> 

      <p>{{ $user->name }}</p><br>

      @if ($user->id === Auth::user()->id)
      <p><span class="font-normal"><a href="{{route('profile.index')}}" style="text-decoration:none; color:#878686;"><i class="fa fa-pencil">Editar Perfil</i></a></span></p>
      
      @endif

      <p><span class="font-normal">{{$user->followers->count()}} 
        <!--dependiendo del numero toma una decicion u otra-->
        @choice('Seguidor|Seguidores', $user->followers->count())</span></p>

        <p><span class="font-normal">{{$user->following->count()}} 
        <!--dependiendo del numero toma una decicion u otra-->
        Siguiendo</span></p>

        <p><span class="font-normal">{{$user->post->count()}} Post</span></p>
        @if ($user->id !== Auth::user()->id)

        @if(!$user->siguiendo(Auth::user()))

        <form action="{{route('users.follow',$user)}}" method="post">
          @csrf

          <button  class="btn btn-outline-secondary">Seguir</button>

        </form>

        <br>
        @else
        <form action="{{route('follow.destroy',$user)}}" method="post">
          @csrf
          @method('DELETE')
          
          <button class="btn btn-outline-secondary">Dejar de seguir</button>

        </form>

        @endif
        @endif
        <br>

      </div>


    </div>


  </div><br>



  <div class="container text-center">


   <div class="row "style="align-items:center;  padding-top:30px ;box-shadow: 0 30px 50px -6px black; border-radius: 0.5rem; ">

    <h3><strong style="color:#6c757d">Publicaciones</strong></h3>

    @if($posts->count())

    @foreach($posts as $post)


    <div class="container-post col-md-4">

     <div class="cards">
      <div class="card">
        <h2 class="card-title">{{$post->title}}</h2>

        <img src="{{asset('image/uploads'.'/'.$post->image)}}" >  


        <p class="card-desc">{{$post->description}}
          <a href="{{route('post.show',['post'=>$post,'user'=>$user])}}">ir al post</a>

        </p>

      </div>

    </div>
  </div>



  @endforeach

  @else
  <div class="text-center" style="padding-top: 10px;">
   <p>No hay post para mostrar</p>
 </div>
 @endif
</div>


</div>

@endsection
