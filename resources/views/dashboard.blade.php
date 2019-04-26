@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Articles</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  
                    <a  class="btn btn-primary" href="/post/create"> Create post</a>

                    <hr>
                    <h5>Your blog posts</h5>
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        @foreach($posts as $post)
                            <tr>
                                <td><a href="/post/{{$post->id}}">{{$post->title}}</a></td>
                                <td><a href="/post/{{$post->id}}/edit" class="btn btn-primary">Edit</a></td>
                                <td> {!!Form::open(array('action'=>['PostController@destroy', $post->id], 'method'=>'POST', 'class'=>'float-right'))!!}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                    {!!Form::close()!!}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <!-- seconda card riguardo il testo della home -->
        <div style="margin-top:20px;" class="col-md-8">
            <div class="card">
                <div class="card-header">Homepage text</div>
                <div class="card-body">
                    <p>Click below to edit the text on your homepage.</p>
                    <a  class="btn btn-primary" href="/home_edit">Edit text</a>
                </div>
            </div>
        </div>


        <!-- gestione progetti -->
        <div style="margin-top:20px;" class="col-md-8">
                <div class="card">
                    <div class="card-header">Projects</div>
                    <div class="card-body">
                        <p>Add a new project to your list</p>
                        <a href="/projects/create" class="btn btn-primary">Add project</a>
                        <hr>
                        <h5>Your projects</h5>
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            @foreach($projects as $project)
                                <tr>
                                    <td><a href="/projects/{{$project->id}}">{{$project->title}}</a></td>
                                    <td><a href="/projects/{{$project->id}}/edit" class="btn btn-primary">Edit</a></td>
                                    <td> {!!Form::open(array('action'=>['ProjectsController@destroy', $project->id], 'method'=>'POST', 'class'=>'float-right'))!!}
                                            {{Form::hidden('_method','DELETE')}}
                                            {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                        {!!Form::close()!!}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
    

    </div>
</div>
@endsection
