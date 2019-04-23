@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>

    @if(count($services) > 0)
        <ul class="list-groups">
            @foreach($services as $service)
                <li class="list-groups">{{$service}}</li>
            @endforeach
        </ul>
    @endif

@endsection



