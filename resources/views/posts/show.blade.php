@extends('layouts.main')
@section('title','| View Post')
@section('content')
<div class="row">
  <div class="col-md-8">

    <h1> {{ $post->title }} </h1>
    <p class="lead"> {!! $post->body !!}</p>
    <hr>
    <img src="{{ asset('images/'.$post->image) }}" heigth="400" width="800" >
    <hr>
    <div class="tags">
      @foreach ($post->tags as $tag)
        <span class="badge badge-pill badge-dark">{{ $tag->name }}</span>
      @endforeach
    </div>

    <div class="backend-comments mt-5">
    <h3> Comments <small>{{ $post->comments()->count() }}</small></h3>
    <table class="table">
      <thead class="thead">
          <th>Name</th>
          <th>Email</th>
          <th>Comment</th>
          <th></th>
      </thead>

      <tbody>

@foreach ($post->comments as $comment)
              <tr>
                  <th> {{ $comment->name }} </th> 
                  <td> {{ $comment->email }} </td>
                  <td>{{ $comment->comment}}</td>
              <td>
              <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-outline-dark btn-block btn-sm" ><i class="fas fa-pencil-alt"></i></a>
                  <a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-outline-dark btn-block btn-sm" ><i class="fas fa-trash"></i></a>
              </td>
              </tr>
          @endforeach
      </tbody>
    </table>
    </div>

  </div>
  <div class="col-md-4">
    <div class="well">
      <dl class="dl-horizotal">
        <dt>Url:</dt>
        <dd><a href="{{ route('blog.single', $post->slug) }}">{{url('blog/'.$post->slug)}}</a></dd>
      </dl>

      <dl class="dl-horizotal">
        <dt>Category:</dt>
        <dd>{{ $post->category->name }}</dd>
      </dl>

      <dl class="dl-horizotal">
        <dt>Created At:</dt>
        <dd>{{ date('M j, Y H:i',strtotime($post->created_at)) }}</dd>
      </dl>

      <dl class="dl-horizotal">
        <dt>Last Updated At:</dt>
        <dd>{{ date('M j, Y H:i',strtotime($post->updated_at)) }}</dd>
      </dl>
        <hr>
        <div class="row">
          <div class="col-sm-6">
            {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' =>'btn btn-outline-primary btn-block')) !!}
          </div> 
          <div class="col-sm-6">
            {!! Form::open(['route' => ['posts.destroy', $post->id],'method' => 'DELETE']) !!}

            {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-block'])!!}

            {!! Form::close() !!}
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            {{ Html::linkRoute('posts.index', 'See All Posts ', [], array('class' =>'btn btn-outline-dark btn-block mt-3')) }}
          </div>
        </div>
     
    </div>
  </div>
</div>
 @endsection

