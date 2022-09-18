@extends('layouts.main')
@section('title','All Tags')
@section('content')
   <div class="row">
       <div class="col-md-8">
           <h1>Tags</h1>

           <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th>Name</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                    <th scope="row">{{ $tag->id }}</th> 
                    <td><a href="{{ route('tags.show', $tag->id)}}">{{ $tag->name }}</a> </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
       </div>
       <div class="col-md-4">
               {!! Form::open(['route' => 'tags.store']) !!}
                    <h2>New Tag</h2>
                    {{ Form::label('name', 'Name:')}} 
                    {{ Form::text('name', null, array('class' => 'form-control','required'  => '', 'maxlength' => '250')) }}

                    {{Form::submit('Create New Tag',array('class' => 'btn btn-outline-dark btn-lg btn-block mt-2') )}}
               {!! Form::close() !!}
       </div>
   </div>
 @endsection

