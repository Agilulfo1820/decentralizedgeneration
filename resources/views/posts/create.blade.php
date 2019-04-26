@extends('layouts.app')

@section('content')
    <h1>Create post</h1>
    

    {{ Form::open(array('action' => 'PostController@store','enctype'=>'multipart/form-data')) }}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','',['class'=>'form-control', 'placeholder'=>'Title'])}}
        </div>

        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body','',['class'=>'form-control ', 'id'=>'article-ckeditor', 'placeholder'=>'Enter your text here'])}}
        </div>

        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        
       
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
   
    {{ Form::close() }}

@endsection
