@extends('layouts.app')
@section('content')
<div id="intro" class="class-section site-section">
@if(!empty($home))
    <div class="section-column column-first">
            <div class="intro-headline">
                    {!!$home->testo!!}
            </div>
            <a target="_blank" href="/storage/curriculum/{{$home->curriculum}}" class="button experience-button">  VIEW RESUME
                <span class="unbold">(.pdf)</span>
            </a>

            <!-- Authentication Links -->
            @guest
            @else
                @if(Auth::user()->id == $home->user_id)
                    <hr>
                    <a  class="btn btn-primary home-edit-button" href="/home_edit">Edit text</a>
                @endif
            @endguest

        </div>  
        <div class="section-column column-second hide-md">
                
                <img src="/storage/home_image/{{$home->my_image}}" class="intro-image" alt="dan rusnac portrait">
        </div>
    
    </div>
    
    <main>
            
        <section id="about" class="site-section">
                <div class="container">
                    <div class="section-column column-first">
                    <div class="about-heading">
                        <h6 class="pre-heading sans-font" id="about-title">
                        About me
                        </h6>
                        <h2>{{$home->about1_title}}</h2>
                    </div>
                    <img src="/storage/home_image/{{$home->about1_image}}" class="about-image hide-md" alt="design studio">
                    </div>
                    <div class="section-column column-second">
                    <p class="about-blurb column-content">
                        {!!$home->about1_text!!}
                    
                    </p>
                    </div>
                </div>
        </section>

        <section class="site-section site-section-blockchain">
            <div class="container">
                <div class="section-column column-first mobile-only">
                <div class="about-heading ">
        
                    <h2>{{$home->about2_title}}</h2>
                </div>
        
                </div>
                <div class="section-column column-first">
                <p class="about-blurb column-content">
                        {!!$home->about2_text!!}
                </p>
        
                </div>
                <div class="section-column column-second desktop-only">
                <div class="about-heading2">
                    <h2>{{$home->about2_title}}</h2>
                </div>
                <img src="/storage/home_image/{{$home->about2_image}}" class="about-image hide-md" alt="design studio">
                </div>
        
            </div>
        </section>

    </main>
@else
    <h3>Home hasn't been initialized</h3>
    <hr>
    <a class="btn btn-primary" href="/home_create">Initialize</a>
@endif

@endsection