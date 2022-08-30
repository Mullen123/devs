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
        <a href="{{route('post.show',['post'=>$post,'user'=>$post->user])}}">ir al post</a>

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
