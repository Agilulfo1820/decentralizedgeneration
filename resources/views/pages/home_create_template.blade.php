@extends('layouts.app')

@section('content')
    <h1>Initialize homepage</h1>

{{ Form::open(array('action' => 'HomeController@store','enctype'=>'multipart/form-data')) }}

<div class="form-group">
        {{Form::label('testo','Testo')}}
        {{Form::textarea('testo','',['class'=>'form-control ', 'id'=>'article-ckeditor', 'placeholder'=>'Enter your text here'])}}
</div>
        
<div class="form-group">
        {{Form::label('my_image','Aggiorna immagine')}}
        <br>
        {{Form::file('my_image')}}
</div>
<div class="form-group">
        {{Form::label('curriculum','Aggiorna curriculum')}}
        <br>
        {{Form::file('curriculum')}}
</div>
<div>
    <hr>
<h3>Edit "About me" first block</h3>
<div class="form-group">
        {{Form::label('about1_title','Title')}}
        {{Form::text('about1_title','',['class'=>'form-control ', 'id'=>'article-ckeditor', 'placeholder'=>'Enter your text here'])}}
</div>
<div class="form-group">
        {{Form::label('about1_text','Testo')}}
        {{Form::textarea('about1_text','',['class'=>'form-control ', 'id'=>'article-ckeditor', 'placeholder'=>'Enter your text here'])}}
</div>
<div class="form-group">
        {{Form::label('about1_image','Aggiorna immagine')}}
        <br>
        {{Form::file('about1_image')}}
</div>

<hr>
<h3>Edit "About me" second block</h3>
<div class="form-group">
        {{Form::label('about2_title','Title')}}
        {{Form::text('about2_title','',['class'=>'form-control ', 'id'=>'article-ckeditor', 'placeholder'=>'Enter your text here'])}}
</div>
<div class="form-group">
        {{Form::label('about2_text','Testo')}}
        {{Form::textarea('about2_text','',['class'=>'form-control ', 'id'=>'article-ckeditor', 'placeholder'=>'Enter your text here'])}}
</div>
<div class="form-group">
        {{Form::label('about2_image','Aggiorna immagine')}}
        <br>
        {{Form::file('about2_image')}}
</div>
        

</div>

{{Form::hidden('_method','PUT')}}
{{Form::submit('Submit',['class'=>'btn btn-primary'])}}

{{ Form::close() }}

@endsection
