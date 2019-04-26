@extends('layouts.app')

@section('content')
<a href="/projects" class="btn btn-primary margin-bottom"><span class="glyphicon  glyphicon-triangle-left"></span>Go back</a>
    <h1>{{$projects->title}}</h1>


    <br>
    <div>
        {!! $projects->text !!}
    </div>
    <hr>
   
 <!-- Authentication Links -->
@guest
@else
    @if(Auth::user()->id == $projects->user_id)
        <hr>
        <a href="/projects/{{$projects->id}}/edit" class="btn btn-primary">Edit</a>

        {!!Form::open(array('action'=>['ProjectsController@destroy', $projects->id], 'method'=>'POST', 'class'=>'float-right'))!!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif
@endguest

  
@endsection
