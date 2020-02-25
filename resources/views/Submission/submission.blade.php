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
        <div class="col-md-8 col-md-offset-2" >

            <div class="panel panel-default " style="box-shadow: 8px 5px 5px rgba(0,0,0,0.5)">
                <div class="panel-heading">Submit Thesis file</div>
                <form id="manupload" method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <div class="form-group">
                          

                            <div class="col-md-8 col-md-offset-2">
                                <input type="file" id="file" name="file">
                         
                            </div>
                        </div>
                        </br>

                        <!-- <div class="form-group">
                 
                            <div class="col-md-8 col-md-offset-2">
                                <select class="form-control" name="email" required>
                                    <option value=""></option>
                                    @foreach($adviser as $adviserVal)
                                    <option value="{{$adviserVal->email}}" data-id="{{$adviserVal->id}}">{{$adviserVal->email}}</option>
                                    @endforeach
                                </select>
                         
                            </div>
                        </div> -->
                        <div class="form-group">
                           
                            <div class="col-md-8 col-md-offset-2">
                                <input id="email" type="text" class="form-control" name="email" placeholder="Send to.." required>
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
                                <button type="button" name="upload" value="Upload" id="uploadbtn" class="btn btn-success">
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
               <div class="" style="box-shadow: 8px 5px 5px rgba(0,0,0,0.5)">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title"><strong> Submitted Manuscripts </strong></h3>
                  </div>
                  <div class="box-body">
                        <table class="table">
                            <thead class="thead-dark">
            						<tr>
            							              <th>Title</th>
                                       @if(Auth::user()->user_type != "Student")
                                        <th>Author</th>
                                        @endif
                                        <th>Sent to</th>
                                        @if(Auth::user()->user_type == "Student")
                                        <th>Evaluation</th>
                                        @endif
                                        <th>Date</th>
                                        <th>Action</th>
            						</tr>
            						
            					</thead>

            					<tbody>

        					              	@foreach($manuscripts as $cat)
        							<tr>
                                        <td>{{$cat->name}}</td>
                                        @if(Auth::user()->user_type != "Student")
                                        <td>{{$cat->username}}</td>
                                        @endif
                                        <td>{{$cat->code}}</td>
                                        @if(Auth::user()->user_type == "Student")
                                        <td><label class="{{$cat->evaluation != null ? 
                                          ($cat->evaluation == 'Approved' ? 'label label-success' : ($cat->evaluation == 'Revision' ? 'label label-warning' :
                                           'label label-danger') ) : 'label label-default'}}">{{$cat->evaluation != null ? $cat->evaluation : "Pending"}}</label></td>
                                        @endif
                                        <td>{{date('d-m-Y', strtotime($cat->created_at))}}</td>
                                       

                                
								<td>
                  @can ('isUser')
									
                  <button class="btn btn-info openPdf" id="{{$cat->id}}">View</button>
        
                @endcan 
                @if(Auth::user()->user_type=="Committee")
                <button class="btn btn-info openPdf" id="{{$cat->id}}">Check</button>
                @endif
                @can('isAdviser')
                <button class="btn btn-info openPdf" id="{{$cat->id}}">Evaluate</button>
                @endcan
                   @can('isCoordinator')
                <button class="btn btn-info openPdf" id="{{$cat->id}}">Evaluate</button>
                @endcan
                @can ('isAdmin')
                <button   class="btn btn-info" data-toggle="modal" data-target="#checker"> Assign Checker</button>
                @endcan
                </td>
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

    $(document).on("click","#uploadbtn", function() {
        var formData = new FormData($("#manupload")[0]);

        $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
              processData: false,
              contentType: false,
              url:"{{'upload'}}",
                        method: 'POST',
                        data: formData, 
          beforeSend:function(){
            $('#success').empty();
          },
          uploadProgress:function(event, position, total, percentComplete)
          {
            $('.progress-bar').text(percentComplete + '%');
            $('.progress-bar').css('width', percentComplete + '%');
            
          },
          
          success:function(data)
          {
            if(data.errors)
            {
              $('.progress-bar').text('0%');
              $('.progress-bar').css('width', '0%');
              $('#success').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
            }
            if(data.success)
            {
              $('.progress-bar').text('Uploaded');
              $('.progress-bar').css('width', '100%');
              $('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
                  user_id = $("select[name=email]").find('option[value="'+$("select[name=email]").val()+'"]').attr('data-id');
                  var socket = io(_HOST);
                  socket.emit('notification',
                    {'notification':true,
                    data:{
                      user_id : user_id
                    }
                  });
              location.reload();
            }
          }
        });
    });

</script>
@endsection

