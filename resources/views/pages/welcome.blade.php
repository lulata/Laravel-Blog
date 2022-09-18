@extends('layouts.main')
@section('title','| Home')
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron mt-3">
                    <h1 class="display-4">Welcome To My BLog</h1>
                    <p class="lead">Thank You For Visiting. This is my test website build with laravel. Plase read my popular post</p>
                    <hr class="my-4">
                    <a class="btn btn-outline-dark btn-lg" href="#" role="button">Popular Post</a>
                  </div>
            </div>
        </div>
        <div class="row">
        <div class="row col-md-8">
            @foreach ($posts as $post)
                
            <div class="post">
                <h3>{{ $post->title }}</h3>
                <p>{{ substr(strip_tags($post->body), 0, 300) }}{{strlen(strip_tags($post->body)) > 300 ? "..." : ""}}</p>
            <a href="{{url('blog/'.$post->slug)}}" class="btn btn-outline-dark">Read More</a>
                <hr>
                @endforeach
            </div>

        </div>
        <div class="col-md-3 col-md-offset-1">
            <h2>Sidebar</h2>
        </div>
    </div>
@endsection