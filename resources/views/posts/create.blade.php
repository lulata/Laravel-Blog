@extends('layouts.main')
@section('title','| Create New Post')
@section('content')
@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
    {!! Html::style('css/select2.min.css') !!}
    <script src="https://cdn.tiny.cloud/1/672tpanoeejrjgrdy5f01loju3z8uve4rluinmihfva68orn/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({
          selector: "textarea"
        });</script>

@endsection
    <div class="row">
        <div class="container">
            <h1 class="text-center">Create New Post</h1>
            <hr>
            {!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true)) !!}
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title', null, array('class' => 'form-control', 'required'  => '', 'maxlength' => '250')) }}

            {{ Form::label('slug', 'Slug:') }}
            {{ Form::text('slug', null, array('class' => 'form-control', 'required'  => '', 'minlenght' => '5', 'maxlength' => '250')) }}

            {{ Form::label('category_id', 'Category:') }}
            <select class="form-control" name="category_id">
                @foreach ($categories as $category)
                    <option value=" {{ $category->id }} ">{{ $category->name }}</option>
                @endforeach
            </select>

            {{ Form::label('tags', 'Tags:') }}
				<select class="form-control select2-multi" name="tags[]" multiple="multiple">
					@foreach($tags as $tag)
						<option value='{{ $tag->id }}'>{{ $tag->name }}</option>
					@endforeach

                </select>

            {{ Form::label('featured_image', 'Uploat Featured Image:') }}
            {{ Form::file('featured_image') }}
    
                
            {{ Form::label('body', 'Post Body:') }}
            {{ Form::textarea('body', null, array('class' => 'form-control',  )) }}
            

            {{Form::submit('Create Post',array('class' => 'btn btn-outline-dark btn-lg btn-block mt-2') )}}
            {!! Form::close() !!}
        </div>
    </div>
 @endsection

 @section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
    {!! Html::script('js/select2.min.js') !!}
    <script>    
        $('.select2-multi').select2();
    </script>
    
@endsection