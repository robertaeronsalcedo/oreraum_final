@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
<div class="col-md-5 col-md-offset-2">
<div class="panel panel">
            
                  
<div class="media1">
<a class="pull-center" href="{{'/home'}}">
 <center> <img class="media-object img-circle" width="150px" src="{{asset('images/umlogo.png')}}" alt="Generic placeholder image"></center> </a>
  <div class="media-body">       
<form class="col-md-12" method="post" action="{{url('/create')}}">
		{{csrf_field()}}	

                  <div class="form-group">
                  <label for="des">Group Code</label>
	        		<input type="text"id="code"  class="form-control"placeholder="XXXXXX must be 6 or above" required></input>
                </div>
                
                    <div class="pull-right">
	                 <button type="submit"  id="submit_request"class="btn btn-primary">Submit code</button>

         
        </div>
    </div>
</div>

<!-- MAKE A SECTION ADVISERS ONLY -->

@endsection
