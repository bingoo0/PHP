@extends('layouts.master')


@section('content')
	@include('messages')
	<form method="POST" enctype="multipart/form-data" class="create-post">
		{{csrf_field()}}
		@if($post->id > 0)
		{{method_field('PUT')}}
		@endif
		<input type="text" name="title" placeholder="Title" value="{{old('title', $post->title)}}"/><br/>
		<textarea name="text">{{old('text',$post->text)}}</textarea><br/>
		@if($post->imagePath)
		<div class="col-md-3">
		<img src="{{url($post->imagePath)}}" class="img-fluid">
		</div>
		@endif
		<input type="file" name="photo" /><br/>
		<input type="submit" value="Save" />
	</form>
@endsection	