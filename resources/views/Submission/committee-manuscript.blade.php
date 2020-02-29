@extends('layouts.master')

@section('content')

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
                                        <th>Author</th>
                                        <th>Evaluation</th>
                                        <th>Date</th>
                                        <th>Action</th>
            						</tr>
            						
            					</thead>

            					<tbody>

          	@foreach($manuscripts as $cat)
							<tr>
                <td>{{$cat->getManuscripts->name}}</td>
                <td>{{$cat->getManuscripts->getAuthor->name}}</td>
                <td><label class="{{$cat->evaluation != null ? 
                  ($cat->evaluation == 'Approved' ? 'label label-success' : ($cat->evaluation == 'Revision' ? 'label label-warning' :
                   'label label-danger') ) : 'label label-default'}}">{{$cat->evaluation != null ? $cat->evaluation : "Pending"}}</label></td>
                <td>{{date('d-m-Y', strtotime($cat->created_at))}}</td>        
								<td>
                <button class="btn btn-info openPdf" committee-id="{{$cat->id}}" id="{{$cat->manuscripts_id}}">Check</button>
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
    
    $('.openPdf').on('click',function(event){
        event.preventDefault();
        window.location.href = "/open-pdf-committee?id="+this.id+"&committee_id="+$(this).attr('committee-id');


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

