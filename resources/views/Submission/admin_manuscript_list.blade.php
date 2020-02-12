@extends('layouts.master')

@section('content')
     
		<div class="box">
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
                                <td>{{$cat->name}}</td>
								<td>{{date('d-m-Y',strtotime($cat->created_at))}}</td>
						
								<td>
								 <div class="col-md-10">
                                <select id="user_id" type="text" class="form-control" name="user_id"  required autofocus>
                                <option value="">Unfinish</option>
							</select>
                            </div> 
						</div></td>
					
                                

                                
								<td>
                <button class="btn btn-success data-toggle=" data-toggle="modal"id="#checker"data-target="#checker">Send</button>
              

						@endforeach
					</tbody>


				</table>				
			</div>
		</div>
	</div>
@endsection
