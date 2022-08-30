
	

<div  style="display: flex">

	@if($isLiked)
	<button wire:click="like" type="submit"id="btn_like"> <p><i class="fa fa-heart"  style="color:red;"></i></p></button>
	@else
	<button wire:click="like" type="submit"id="btn_like"><p><i class="fa fa-heart-o"></i></p></button>

	@endif
	<p >{{$likes}} likes</p>


</div>
