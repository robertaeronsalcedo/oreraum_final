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

						@foreach($groups as $groups)
							<tr>
								<td>{{$groups->group_name}}</td>
                                <td>{{$groups->group_code}}</td>
                                <td>{{$groups->group_schedule}}</td>
                                
                                @can('isAdviser')
                                <td>{{date('d-m-Y', strtotime($groups->created_at))}}</td>
                                @endcan
                         

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

