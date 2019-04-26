@extends('layouts.app')

@section('content')




<div class="col-8 offset-2 blog-main">
        <a href="/post" class="btn btn-primary margin-bottom"><span class="glyphicon  glyphicon-triangle-left"></span>Go back</a>

        <div class="blog-post">
          <h2 class="blog-post-title">{{$post->title}}</h2>
          <p class="blog-post-meta">Written on {{$post->created_at}} by {{$post->user->name}}</p>

         
        </div>

        {!! $post->body !!}

        

         <!-- Authentication Links -->
        @guest
        @else
            @if(Auth::user()->id == $post->user_id)
                <hr>
                <a href="/post/{{$post->id}}/edit" class="btn btn-primary">Edit</a>

                {!!Form::open(array('action'=>['PostController@destroy', $post->id], 'method'=>'POST', 'class'=>'float-right'))!!}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                {!!Form::close()!!}
            @endif
        @endguest


      </div>



    

  
@endsection
