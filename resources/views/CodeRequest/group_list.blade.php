@extends('layouts.master')

@section('content')

   <div class="">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><strong>Advisers</strong></h3>
			</div>

			<div class="box-body">
				<table class="table table-responsive">
					<thead>
						<tr>
							<th>Group Name</th>
                            <th>Group Code</th>
                            <th>Group Schedule </th>
                            @can('isAdviser')
                            <th>Created</th>
                            @endcan
                           
							<!-- <th>Date</th> -->
                            @can('isAdviser')
							<th>Action</th>
                            @endcan
						</tr>
						
					</thead>

					<tbody>

						@foreach($Committee as $committee)
							<tr>
								<td>{{$committee->name}}</td>
                            
                         

                                @can('isAdviser')
								<td>
									<button class="btn btn-info">View</button>
					
                                  
								</td>
                                @endcan
                                @endforeach
							</tr>

						
					</tbody>


				</table>				
			</div>
	

@endsection

