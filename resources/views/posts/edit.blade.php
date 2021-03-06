@extends('layouts.app')

@section('content')
    <h1>Create post</h1>
    

    {{ Form::open(array('action' => ['PostController@update', $post->id],'enctype'=>'multipart/form-data')) }}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title',$post->title,['class'=>'form-control', 'placeholder'=>'Title'])}}
        </div>

        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body',$post->body,['class'=>'form-control ', 'id'=>'article-ckeditor', 'placeholder'=>'Enter your text here'])}}
        </div>
        <div class="form-group">
                {{Form::label('cover_image','Cover image')}}
                {{Form::file('cover_image')}}
        </div>
        
        
            
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
   
    {{ Form::close() }}

@endsection

