@extends('layouts.app')

@section('content')

    @if(count($posts)>0)
    <div class="row posts-row">
        @foreach ($posts as $post)

        <div class="col-md-4">
            <div class="card mb-4 post-card"> 
                <span onclick="location.href='/post/{{$post->id}}';" style="background-image:url(/storage/cover_images/{{$post->cover_image}});" class="post-preview-image"></span>
                <div class="card-body">
                <p class="card-text"><a href="/post/{{$post->id}}" >{{$post->title}}</a></p>
                <div class="d-flex justify-content-between align-items-center" >
                   
                    <small class="text-muted">Written on {{$post->created_at}} by {{$post->user->name}}</small>
                </div>
                </div>
            </div>
        </div>





          
        @endforeach
    </div>
        {{$posts->links()}}
    @else
        <p>No posts found.</p>
    @endif
@endsection
