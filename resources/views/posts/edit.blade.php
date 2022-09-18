@extends('layouts.main')

@section('title', '| Edit Blog Post')

@section('content')
@section('stylesheets')
    {!! Html::style('css/select2.min.css') !!}
    <script src="https://cdn.tiny.cloud/1/672tpanoeejrjgrdy5f01loju3z8uve4rluinmihfva68orn/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({
        selector:'textarea',
        plugins: 'link code'
        });</script>
@endsection
{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) !!}
    <div class="row">
        
        <div class="col-md-8">
			{{ Form::label('title', 'Title:') }}
            {{ Form::text('title', null, ["class" => 'form-control input-lg']) }}
            
            {{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
            {{ Form::text('slug', null, ["class" => 'form-control input-lg']) }}
            
            {{ Form::label('category_id', 'Category:', ['class' => 'form-spacing-top']) }}
            {{ Form::select('category_id', $categories, $post->category_id, ['class' => 'form-control input-lg']) }}
            
            {{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
            {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}
            
            {{ Form::label('featured_image', 'Uploat Featured Image:', ['class' => 'form-spacing-top']) }}
            {{ Form::file('featured_image') }}

			{{ Form::label('body', "Body:", ['class' => 'form-spacing-top']) }}
			{{ Form::textarea('body', null, ['class' => 'form-control']) }}
        </div>
        
        <div class="col-md-4">
			<div class="well">
                <dl class="dl-horizontal">
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
                        {{ Form::submit('Save Changes', ['class' => 'btn btn-outline-success btn-block']) }}
                    </div> 
                    <div class="col-sm-6">
                        {!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' =>'btn btn-outline-danger btn-block')) !!}
					</div>
				</div>
			</div>
		</div>
    </div>
    {!! Form::close() !!}

@stop
@section('scripts')

{!! Html::script('js/select2.min.js') !!}

<script>
        $('.select2-multi').select2();
		$('.select2-multi').select2().val({!! json_encode($post->tags()->allRelatedIds()) !!}).trigger('change');
</script>

@endsection 