@extends('layouts.main')
@section('title','| Contact')
@section('content')
       <div class="row mt-3">
           <div class="col-md-12">
               <h1>Contact  Me</h1>
               <hr>
           <form action="{{ url('contact') }}" method="POST">
              @csrf
                <div class="form-group">
                  <label name="email">Email address</label>
                  <input name="email" class="form-control" id="email" >
                  <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label name="subject">Subject</label>
                    <input  class="form-control" id="subject" >
                  </div>
                  <div class="form-group">
                    <label name="message">Body</label>
                    <textarea name="message" class="form-control" id="message"rows="3" > Type Text Here... </textarea>
                  </div>
                  <input type="submit" value="Send Message" class="btn btn-outline-dark">
              </form>
           </div>
       </div>
   @endsection