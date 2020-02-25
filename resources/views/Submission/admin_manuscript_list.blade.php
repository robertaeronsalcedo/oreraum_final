@extends('layouts.master')

@section('content')
     
		<div class="box"style="box-shadow: 8px 5px 5px rgba(0,0,0,0.5)">
			<div class="box-header">
				<h3 class="box-title"><strong> Pending </strong></h3>
			</div>

			<div class="box-body">
				<table class="table table-responsive">
					<thead>
						<tr>
							<th>Title</th>
                            <th>Author</th>
                            <th>Date</th>
							<th>Assign Checker</th>
							<th>Action</th>
						</tr>
						
					</thead>

					<tbody>

						@foreach($manuscripts as $cat)
							<tr>
								<td>{{$cat->name}}</td>
                                <td>{{$cat->username}}</td>
								<td>{{date('d-m-Y',strtotime($cat->created_at))}}</td>
						
								<td>
                                <select type="text" class="form-control" name="user_id" required autofocus>
	                                <option value=""></option>
	                                @foreach($committee as $committeeVal)
	                                <option value="{{$committeeVal->email}}">{{$committeeVal->name}}</option>
	                                @endforeach
								</select>
								</td>
                                
								<td>
					                <button class="btn btn-success send-btn" data-id="{{$cat->id}}" type="button">Send</button>
              					</td>
	                		</tr>
						@endforeach
					</tbody>


				</table>				
			</div>
		</div>
	</div>
@endsection

@section('js')
<script>
	$(document).on('click','.send-btn',async function() {
	      arr = {};
	      arr['email']      = $(this).parent().parent().find("select").val();
	      arr['id'] 		= $(this).attr('data-id');

	        var opt = {
	            headers:{
	                'Accept': 'application/json',
	                'Content-Type': 'application/json',
	            },
	            method : 'POST',
	            body : JSON.stringify(arr)
	        };

	        try {
	                let response = await fetch('/admin_manuscript_list/assign-checker',opt);
	                const statusCode = response.status;
	                let responseJsonData = await response.json();   
	                if(responseJsonData[0].success) {
	                  Swal.fire({
	                    position: 'center',
	                    icon: 'success',
	                    title: 'Successfully assigned checker',
	                    showConfirmButton: false,
	                    timer: 1500
	                  })

	                  var socket = io("http://192.168.1.75:9000");
	                  socket.emit('notification',
	                    {'notification':true,
	                    data:{
	                      user_id        : responseJsonData[0].user_id,
	                    }
	                  });

	                  setTimeout(function(){
	                  	window.location="/admin_manuscript_list"
	                  },2000);
	                }
	            }
	        catch(e) {
	            console.log({error : true, description : e});

	        }
	});
</script>
@endsection