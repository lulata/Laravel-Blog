@extends('layouts.main')
@section('title','All Categories')
@section('content')
   <div class="row">
       <div class="col-md-8">
           <h1>Categories</h1>

           <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th>Name</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                    <th scope="row">{{ $category->id }}</th> 
                    <td>{{ $category->name }}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
       </div>
       <div class="col-md-4">
               {!! Form::open(['route' => 'categories.store']) !!}
                    <h2>New Category</h2>
                    {{ Form::label('name', 'Name:')}} 
                    {{ Form::text('name', null, array('class' => 'form-control','required'  => '', 'maxlength' => '250')) }}

                    {{Form::submit('Create New Category',array('class' => 'btn btn-outline-dark btn-lg btn-block mt-2') )}}
               {!! Form::close() !!}
       </div>
   </div>
 @endsection

