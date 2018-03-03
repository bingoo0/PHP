@extends('layouts.master')


@section('content')
	@foreach($posts as $p)
	<div>
		<div>
		{{$p->title}}
		</div>
		@if(Auth::check() && Auth::user()->isAdmin)
		<a href="{{route('posts.edit', $p->id)}}" class="btn btn-info">Edit</a>
		<form method="POST" action="{{route('posts.delete', $p->id)}}">
		{{csrf_field()}}
		{{method_field('DELETE')}}
			<button
				 type="submit" 
				 onclick="return confirm('Confirm');"
				 class="btn btn-danger"
				 >X</button>
		</form>
		@endif
		<div class="col-4">
			<img src="{{$p->imagePath ? $p->imagePath : url('images/defaultImage.png')}}" class="img-fluid" alt="image not found"/>
		</div>
		<hr/>
		@endforeach
	
	<div>
		{{$posts->render()}}
		</div>
	</div>
@endsection