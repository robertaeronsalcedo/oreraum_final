@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Submission page</h3></div>
                
                <div class="container"> 
                <br>
            
                @can('isUser')
                <form id="manupload" method="post" enctype="multipart/form-data">
                      <div class="row">
                            <div class="col-md-1" ><h4>Select File</h4></div>
                            <div class="col-md-6">
                              <input type="file" name="file" id="file">
                              <div class="form-group">
                              <div class="col-md-12">
                                <label for="title">Title</label>
                              
                                <input type="text" class="form-control" name="name" id="name">
                                <div class="col-md-9">
                            </div>
                              
                            </div>
                            <div class="form-group">
                              <div class="col-md-12">
                                
                                <input type="submit" id="upload" name="upload" value="Upload" class="btn btn-success">
                                <div class="col-md-12">
                            </div>
                            <br>
                            <br>
                            
                        </div>
                    </form>
                    <br />
                    <div class="col-md-12">  
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow=""
                      aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        0%
                      </div>
                    </div>
                    </div>
                    <br />
                    <div id="success">

                    </div>
                    <br />
                    <br />
                </div>
            </div>
            
   
            </div>
        </div>
        @endcan
        <div class="panel-heading"><h3>Thesis submitted</h3></div>
        <div class="col-md-9 ">
            <table class="table">
                <thead class="thead-dark">
						<tr>
							<th>Title</th>
                            <th>Author</th>
                            <th>Date </th>
                            <th>Action</th>
						</tr>
						
					</thead>

					<tbody>

						@foreach($manuscripts as $cat)
							<tr>
                                <td>{{$cat->name}}</td>
                                <td>{{Auth::user()->name}}</td>
                                <td>{{$cat->created_at}}</td>

                                
								<td>
                  @can ('isUser')
									<button   class="btn btn-info openPdf" id={{$cat->id}} >Open</button>
									/
									<button class="btn btn-danger" data-id="{{$cat->id}}" data-toggle="modal" data-target="#delete">Delete</button>
								</td>
                @endcan 
                @can ('isAdmin')
                <button   class="btn btn-info" data-toggle="modal" data-target="#checker"> Assign Checker</button>
                @endcan
							</tr>

						@endforeach
					</tbody>


				</table>				
			</div> 
	 
  </div>
@endsection
