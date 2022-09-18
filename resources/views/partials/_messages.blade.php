@if (Session::has('success'))
    <div class="alert alert-success">
        <strong>Success: </strong> {{Session::get('success')}}
    </div>
@endif

@if (count($errors) >0)
    <div class="alert alert-danger m-3">
        <strong>Errors: </strong> 
        @foreach ($errors as $error)
           <li>{{ $error }}</li> 
        @endforeach
    </div>
@endif