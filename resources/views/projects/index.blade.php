@extends('layouts.app')

@section('content')
    @guest
    @else
        <div class="admin_buttons">
            <a href="/projects/create" class="btn btn-primary">Add project</a>
        </div>
    @endguest
    @if(count($projects)>0)
    <div id="projects" class="site-section no-bottom-border">
        @foreach ($projects as $project)
            @if(($project->id % 2) === 0)
                <div class="container project-container">
                    <div class="section-column column-first">
                    <img src="/storage/project_images/{{$project->project_image}}" class="project-image" alt="interactive stories login page">
                    <div class="project-image-container hide-md">
                        <img src="/storage/project_images/{{$project->project_bg}}" class="project-image-bg" aria-hidden="true">
            
                        <img src="/storage/project_images/{{$project->project_image}}" class="project-image-abs left" alt="interactive stories login page">
            
                    </div>
                    </div>
                    <div class="section-column column-second">
                    <div class="column-content">
                        <h6 class="pre-heading sans-font">
                                {{$project->role}}
                        </h6>
                        <h4 class="project-title">{{$project->title}}</h4>
                        <p class="project-description">
                                {!!$project->text!!}
                        </p>
                        <div class="project-details">
                        Skills used: {{$project->skills}}
                        </div>
                        <a target="_blank" href="/projects/{{$project->id}}" class="button" role="button">
                        View more
                        </a>
                        @guest
                        @else
                            @if(Auth::user()->id == $project->user_id)
                                <div class="admin_buttons">
                                    <a href="/projects/{{$project->id}}/edit" class="btn btn-primary">Edit</a>

                                    {!!Form::open(array('action'=>['ProjectsController@destroy', $project->id], 'method'=>'POST', 'class'=>'float-right'))!!}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </div>
                            @endif
                        @endguest
                    </div>
                    </div>
                </div>
            @else
            <div class="container project-container col-reverse-md">
                <div class="section-column column-first">
                    <div class="column-content">
                    <h6 class="pre-heading sans-font">
                            {{$project->role}}
                    </h6>
                    <h4 class="project-title">{{$project->title}}</h4>
                    <p class="project-description">
                            {!!$project->text!!}
                    </p>
                    <div class="project-details">
                    Skills used: {{$project->skills}}
                    </div>
                    <a href="/projects/{{$project->id}}" class="button" role="button">
                        View more
                    </a>
                    @guest
                    @else
                        @if(Auth::user()->id == $project->user_id)
                            <div class="admin_buttons">
                                <a href="/projects/{{$project->id}}/edit" class="btn btn-primary">Edit</a>

                                {!!Form::open(array('action'=>['ProjectsController@destroy', $project->id], 'method'=>'POST', 'class'=>'float-right'))!!}
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                {!!Form::close()!!}
                            </div>
                        @endif
                    @endguest
                    </div>
                </div>
                <div class="section-column column-second">
                    <img src="/storage/project_images/{{$project->project_image}}" class="project-image" alt="narratives for qlik settings modal">
                    <div class="project-image-container hide-md">
                    <img src="/storage/project_images/{{$project->project_bg}}" class="project-image-bg" aria-hidden="true">
        
                        <img src="/storage/project_images/{{$project->project_image}}" class="project-image-abs right" alt="narratives for qlik settings modal">
        
                    </div>
                </div>
                </div>
            @endif

        @endforeach
    </div>
        {{$projects->links()}}
    @else
        <p>No projects found.</p>
    @endif
@endsection
