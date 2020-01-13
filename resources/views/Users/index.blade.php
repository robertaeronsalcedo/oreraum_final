@extends('layouts.master')

@section('content')


	<div class="">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><strong> Users </strong></h3>
			</div>

			<div class="box-body">
				<table class="table table-responsive">
					<thead>
						<tr>
							<th>Name</th>
                            <th>Email</th>
                            <th>Access ID </th>
                            <th>ID Number </th>
							<!-- <th>Date</th> -->
							<th>Action</th>
						</tr>
						
					</thead>

					<tbody>

						@foreach($users as $cat)
							<tr>
								<td>{{$cat->name}}</td>
                                <td>{{$cat->email}}</td>
                                <td>{{$cat->user_type}}</td>
                                <td>{{$cat->id_number}}</td>

                                
								<td>
									<button class="btn btn-info" id={{$cat->id}} data-id="{{$cat->id}}"  data-name="{{$cat->name}}"  data-email="{{$cat->email}}" data-access_id="{{$cat->user_type}}" data-id_number="{{$cat->id_number}}" data-toggle="modal" data-target="#edit">Edit</button>
									/
									<button class="btn btn-danger" data-id="{{$cat->id}}" data-toggle="modal" data-target="#delete">Delete</button>
								</td>
							</tr>

						@endforeach
					</tbody>


				</table>				
			</div>
		</div>
	</div>

	<div class="modal fade" id="checker" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
        <h4 class="modal-title" id="myModalLabel">Assign Checker</h4>
      </div>
      <form action="{{route('category.store')}}" method="post">
      	
	      <div class="modal-body">
        <div class="media border p-5">
    
            <div class="col-md-12 ">
            <table class="table">
                <thead class="thead-dark">
						<tr>            
						              	<th>Name</th>
                            <th><center>Number Paper Assign </center></th>
                            <th>Action</th>
						</tr>
						
			  		</thead>

					      <tbody>
						      	<tr> 
                         <td>{{$cat->name}}</td>
                         <td><center>2</center></td>
					        			<td>
								      	<button class="btn btn-info" id="" >Assign</button>
                   
							      	</td>
		    	  	</tbody>
  			  	</table>				
	     
	      </div>
      </form>
    </div>
  </div>
</div>

	<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
 	Add New
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Category</h4>
      </div>
      <form id="edituser">
      	
	      <div class="modal-body">
				@include('category.form')
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit User</h4>
      </div>
      <form id="updateform">
	      <div class="modal-body">
	      		<input type="hidden" name="user_id" id="id" value="">
                  <div class="form-group">
		        	<label for="title">Name</label>
		        	<input type="text" class="form-control" name="name" id="name">
	        	</div>

	        	<div class="form-group">
	        		<label for="des">Email</label>
	        		<input name="email" id="email" cols="20" rows="5" id='email' class="form-control"></input>
                </div>
             
                <div class="form-group">
	        		<label for="des">ID Number</label>
	        		<input name="id_number" id="id_number" cols="20" rows="5" id='id_number' class="form-control"></input>
	        	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" id="submitedit" class="btn btn-primary">Save Changes</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
      </div>
      <form id="deleteform">
	      <div class="modal-body">
				<p class="text-center">
					Are you sure you want to delete this?
				</p>
	      		<input type="hidden" name="user_id" id="user_id" value="">

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
	        <button type="submit" id="deleteuser" class="btn btn-warning">Yes, Delete</button>
	      </div>
      </form>
    </div>
  </div>
</div>


@endsection

