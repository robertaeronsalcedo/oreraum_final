@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endsection

@section('content')


	<div class="">
		<div class="box" style="box-shadow: 8px 5px 5px rgba(0,0,0,0.5)"	>
			<div class="box-header">
				<h3 class="box-title"><strong> Users </strong></h3>
			</div>

			<div class="box-body">
				<table class="table table-responsive" id="tbl-users">
					<thead>
						<tr>
							<th>Name</th>
                            <th>Email</th>
                            <th>Access ID </th>
                            <th>ID Number </th>
							<th>Action</th>
						</tr>
						
					</thead>

					<tbody>


					</tbody>


				</table>				
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
	      		{!! csrf_field() !!}
	      		<input type="hidden" name="user_id" id="id" value="">
                  <div class="form-group">
		        	<label for="title">Name</label>
		        	<input type="text" class="form-control" name="name" id="name">
	        	</div>

	        	<div class="form-group">
	        		<label for="des">Email</label>
	        		<input type="email" name="email" id="email" cols="20" rows="5" class="form-control"></input>
                </div>
             
                <div class="form-group">
	        		<label for="des">ID Number</label>
	        		<input name="id_number" id="id_number" cols="20" rows="5" class="form-control"></input>
	        	</div>
	        	<div class="form-group">
		        	<button type="button" id="resetBtn" class="btn btn-danger form-control">Reset Password</button>
	        	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" id="submitedit" class="btn btn-primary">Save Changes</button>
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
	        <button type="button" id="deleteuser" class="btn btn-warning">Yes, Delete</button>
	      </div>
      </form>
    </div>
  </div>
</div>

  
@endsection


@section('js')
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

	<script>
	$(document).ready(function() {
			 tblusers = $('#tbl-users').DataTable({
					        ajax : {
					        	url : '/users/user-list',
					        	dataSrc:""
					        },
							columns: [
			                    {
			                        data : function(data) {
			                            return data.name;
			                        }            
			                    },
			                    {
			                        data : function(data) {
			                            return data.email;
			                        }            
			                    },
			                    {
			                        data : function(data) {
			                            return data.user_type;
			                        }            
			                    },
			                    {
			                        data : function(data) {
			                            return data.id_number;
			                        }            
			                    },
			                    { 
			                        defaultContent: '', createdCell: function (td, cellData, rowData, row, col) {
			                        $(td).html('<button class="btn btn-info" id="'+rowData.id+'" data-id="'+rowData.id+'" \ data-name="'+rowData.name+'"  data-email="'+rowData.email+'" data-access_id="'+rowData.user_type+'" data-id_number="'+rowData.id_number+'" data-toggle="modal" data-target="#edit">Edit</button> \
									 \
									<button class="btn btn-danger" data-id="'+rowData.id+'" data-toggle="modal" data-target="#delete">Delete</button>');
			                        }
			                    }
			                ]
							});


	    $(document).on('click','#submitedit',async function() {
	    		var arr = $('#updateform').serializeArray().map(function(data) {
	    			this[data.name] = data.value;
	    			return this;
	    		}.bind({}))[0];

                var opt = {
	            headers:{
	                'Accept': 'application/json',
	                'Content-Type': 'application/json',
	            },
	            method : 'POST',
	            body : JSON.stringify(arr)
	        };

	        try {
	                let response = await fetch('/user_update',opt);
	                const statusCode = response.status;
	                let responseJsonData = await response.json();   
	                if(responseJsonData[0].success) {
	                  Swal.fire({
	                    position: 'center',
	                    icon: 'success',
	                    title: 'Your work has been sent',
	                    showConfirmButton: false,
	                    timer: 1500
	                  })
	                  tblusers.ajax.reload();
	                  $('.modal').modal('hide');

	                }
	            }
	        catch(e) {
	            console.log({error : true, description : e});

	        }


	    });

		$('#edit').on('show.bs.modal', function (event) {

		  var button = $(event.relatedTarget) 
		  var name = button.data('name') 
		  var email = button.data('email') 
		  var access_id = button.data('access_id') 
		  var id_number = button.data('id_number') 
		  var id = button.data('id') 
		  var modal = $(this)
		   
		  modal.find('.modal-body #name').val(name);
		  modal.find('.modal-body #email').val(email);
		  modal.find('.modal-body #access_id').val(access_id);
		  modal.find('.modal-body #id_number').val(id_number);
		  modal.find('.modal-body #id').val(button.data('id') );
		  
		})

		$('#resetBtn').on('click', async function() {
	    		var arr = $('#updateform').serializeArray().map(function(data) {
	    			this[data.name] = data.value;
	    			return this;
	    		}.bind({}))[0];

                var opt = {
	            headers:{
	                'Accept': 'application/json',
	                'Content-Type': 'application/json',
	            },
	            method : 'POST',
	            body : JSON.stringify(arr)
	        };

	        try {
	                let response = await fetch('/users/reset-password',opt);
	                const statusCode = response.status;
	                let responseJsonData = await response.json();   
	                if(responseJsonData[0].success) {
	                  Swal.fire({
	                    position: 'center',
	                    icon: 'success',
	                    title: 'User Successfully reset password.',
	                    showConfirmButton: false,
	                    timer: 1500
	                  })
	                  tblusers.ajax.reload();
	                  $('.modal').modal('hide');

	                }
	            }
	        catch(e) {
	            console.log({error : true, description : e});

	        }
		});


		$('#delete').on('show.bs.modal', function (event) {

		  var button = $(event.relatedTarget) 

		  var id = button.data('id') 
		  var modal = $(this)
		  console.log(id);  
		  modal.find('.modal-body #user_id').val(id);

		})

		$('#deleteuser').on('click',async function(event){
	    		var arr = $('#deleteform').serializeArray().map(function(data) {
	    			this[data.name] = data.value;
	    			return this;
	    		}.bind({}))[0];

                var opt = {
	            headers:{
	                'Accept': 'application/json',
	                'Content-Type': 'application/json',
	            },
	            method : 'POST',
	            body : JSON.stringify(arr)
	        };

	        try {
	                let response = await fetch('/delete_user',opt);
	                const statusCode = response.status;
	                let responseJsonData = await response.json();   
	                if(responseJsonData[0].success) {
	                  Swal.fire({
	                    position: 'center',
	                    icon: 'success',
	                    title: 'User Successfully deleted.',
	                    showConfirmButton: false,
	                    timer: 1500
	                  })
	                  tblusers.ajax.reload();
	                  $('.modal').modal('hide');

	                }
	            }
	        catch(e) {
	            console.log({error : true, description : e});

	        }
		})

	});
	</script>
@endsection