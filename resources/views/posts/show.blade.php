@extends('layouts.app')

@section('content')
<a href="/post" class="btn btn-primary margin-bottom"><span class="glyphicon  glyphicon-triangle-left"></span>Go back</a>
    <h1>{{$post->title}}</h1>
    <div>
        {!! $post->body !!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}}</small>
 <!-- Authentication Links -->
 @guest


@else
    <hr>
    <a href="/post/{{$post->id}}/edit" class="btn btn-primary">Edit</a>

    {!!Form::open(array('action'=>['PostController@destroy', $post->id], 'method'=>'POST', 'class'=>'float-right'))!!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
    {!!Form::close()!!}
@endguest

  
@endsection
