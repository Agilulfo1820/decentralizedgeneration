@extends('layouts.app')

@section('content')
    <h1>Create project</h1>
    

    {{ Form::open(array('action' => 'ProjectsController@store','enctype'=>'multipart/form-data')) }}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','',['class'=>'form-control', 'placeholder'=>'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('role','Role')}}
            {{Form::text('role','',['class'=>'form-control', 'placeholder'=>'Your role in the project'])}}
        </div>

        <div class="form-group">
            {{Form::label('text','Text')}}
            {{Form::textarea('text','',['class'=>'form-control ', 'id'=>'article-ckeditor', 'placeholder'=>'Enter your text here'])}}
        </div>

        <div class="form-group">
            {{Form::label('skills','Skills')}}
            {{Form::text('skills','',['class'=>'form-control ', 'placeholder'=>'Enter your skills here'])}}
        </div>

        <div class="form-group">
            {{Form::label('link','Link')}}
            {{Form::text('link','',['class'=>'form-control ', 'placeholder'=>'Enter the link of the project, if any.'])}}
        </div>

        <div class="form-group">
            {{Form::label('project_image','Project image')}}
            {{Form::file('project_image')}}
        </div>
        <div class="form-group">
                {{Form::label('project_bg','Project background')}}
                {{Form::file('project_bg')}}
            </div>
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
   
    {{ Form::close() }}

@endsection
