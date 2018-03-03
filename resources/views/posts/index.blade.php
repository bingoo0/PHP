@extends('layouts.master')

@section('content')
	@foreach($posts as $p)
	<div>
	{{$p->title}}
	</div>
	<div>
		<img src="{{$p->imagePath ? $p->imagePath : url('images/defaultImage.png')}}" class="img-thumbnail" alt="image not found"/>
	</div>	
	@endforeach
	<div class="col-md-4">
	{{$posts->render()}}
	</div>
@endsection