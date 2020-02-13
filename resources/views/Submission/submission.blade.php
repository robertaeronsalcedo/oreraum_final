@extends('layouts.master')

@section('content')
<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Submit Thesis</div>
                   -->
             
  
            
                @can('isUser')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Submit Thesis</div>
                <form id="manupload" method="post" enctype="multipart/form-data">
                <div class="panel-body">
              
       

                    <div class="form-group">
                          

                            <div class="col-md-8 col-md-offset-2">
                                <input type="file" id="file" name="file">
                         
                            </div>
                        </div>
                        </br>

                        <div class="form-group">
                 
                            <div class="col-md-8 col-md-offset-2">
                                <input id="email" type="email" class="form-control" name="email" placeholder="Send E-mail" required autofocus>

                               
                                    <span class="help-block">
                                        <strong></strong>
                                    </span>
                         
                            </div>
                        </div>

                        <div class="form-group">
                           
                            <div class="col-md-8 col-md-offset-2">
                                <input id="name" type="text" class="form-control" name="name" placeholder="Enter Title of your thesis" required>
                                  <span class="help-block">
                                        <strong></strong>
                                    </span>
                            
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 pull-right">
                                <button type="submit" name="upload" value="Upload" id="upload" class="btn btn-success">
                                    Upload PDF
                                </button>
                                <span class="help-block">
                                        <strong></strong>
                                    </span>
                            
                                
                            </div>
                        </div>
                        
                        
                        <div class="col-md-8 col-md-offset-2">  
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

         
        @endcan
        <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                
                  
        <div class="panel-heading"><h4>Thesis submitted</h4></div>
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">
						<tr>
							              <th>Title</th>
                            <th>Date </th>
                            <th>Action</th>
						</tr>
						
					</thead>

					<tbody>

					              	@foreach($manuscripts as $cat)
							<tr>
                                <td>{{$cat->name}}</td>
                                <td>{{date('d-m-Y', strtotime($cat->created_at))}}</td>

                                
								<td>
                  @can ('isUser')
									
                  <button class="btn btn-info openPdf" id="{{$cat->id}}">View</button>
        
                </td>
                @endcan 
              
                @can('isAdviser')
                <button class="btn btn-info openPdf" id="{{$cat->id}}">Check</button>
                @endcan
                @can ('isAdmin')
                <button   class="btn btn-info" data-toggle="modal" data-target="#checker"> Assign Checker</button>
                @endcan
							</tr>

					
					</tbody>

          @endforeach
				</table>	
					

			</div> 
	 </div>
  </div>



@endsection

@section('js')
<script>
    
    $('.openPdf').on('click',function(event){
        event.preventDefault();
        window.location.href = "open-pdf?id="+this.id;

    });
</script>
@endsection