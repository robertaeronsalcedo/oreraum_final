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
							<!-- <th>Date</th> -->
							<th>Action</th>
						</tr>
						
					</thead>

					<tbody>

						@foreach($manuscripts as $cat)
							<tr>
								<td>{{$cat->name}}</td>
                                <td>{{$cat->email}}</td>
                                <td>{{date('d-m-Y', strtotime($cat->created_at))}}</td>
                                

                                
								<td>
                <button class="btn btn-primary data-toggle="modal" data-target="#checker"> Assign Checker</button>
              

						@endforeach
					</tbody>


				</table>				
			</div>
		</div>
	</div>
@endsection