<link rel="stylesheet" href="{{asset('css/app.css')}}">
<!-- MAKE A SECTION ADVISERS ONLY -->

<div class="container">
    <div class="row">
<div class="col-md-8 col-md-offset-2">

<div class="media1">
<a class="pull-center" href="{{'/home'}}">
 <center> <img class="media-object img-circle" width="150px" src="{{asset('images/umlogo.png')}}" alt="Generic placeholder image"></center> </a>
  <div class="media-body">       

<form class method="post" action="{{url('/create')}}">
		{{csrf_field()}}	

                  <div class="form-group">
		        	<label for="title">Group Name </label>
		        	<input type="text" class="form-control" name ="group_name" placeholder="Section Name/Code"required>
	        	</div>

	        	<div class="form-group">
	        		<label for="des">Group Code</label>
	        		<input type="text"  name="group_code" cols="20" rows="5" class="form-control"placeholder="XXXXXX must be 6 or above"required></input>
                </div>
             
                <div class="form-group">
	        		<label for="des">Group Schedule</label>
	        		<input type="text"  name="group_schedule"  cols="20" rows="5"  class="form-control" placeholder="Subject Schedule"required></input>
	        	</div>
	      
            <div class="pull-right">
	        <button type="submit" class="btn btn-primary">Submit Group</button>
			<a class="pull-right" href="{{'/home'}}">
			<button type="button" class="btn btn-danger">Back</button>
			</div>
            </div>
			</div>
			</div>
	   
        
          
      </form>
	  
