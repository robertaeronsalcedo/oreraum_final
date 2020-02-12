@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
    
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('images/umlogo.png')}}" class="img-circle" alt="User Image">
          PS BULLETIN
          
        </div>
      </div>
    </div>
                @foreach($compose as $comp)
               

<div class="panel">
    <div class="panel-body">
    <!-- Newsfeed Content -->
    <!--===================================================-->
    <div class="media-block">
      <a class="media-left" href="#"><img class="img-sm" alt="Profile Picture" src="{{asset('images/defaultpic.jpg')}}"></a>
      <div class="media-body">
      <form id="delete_message">
        <div class="mar-btm">
          <a href="#" class="btn-link text-semibold media-heading box-inline">{{$comp->name}}</a>
          <p class="text-muted text-sm"><i class="fa fa-globe"></i> Posted {{date('d-m-Y', strtotime($comp->created_at))}} - {{$comp->user_type}}</p>
        </div>
        <p>{{$comp->message}}</p>
        <div class="pad-ver">
          <div class="btn-group">
            <a class="btn btn-sm btn-default btn-hover-success" href="#"><i class="fa fa-thumbs-up"></i></a>
            <a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa fa-thumbs-down"></i></a>
          </div>@can ('isAdmin')
          <div class="pull-right btn btn-sm btn-default btn-hover-primary" id-toggle="{{$comp->message_id}}">Delete</button>
         
          </div>
          @endcan 
          </div>

         
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
<script>



$('#delete_message').on('click',function(event){
    event.preventDefault();
    console.log($('#deleteform').serialize());
    $.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url:"{{'avatar'}}",
					method: 'POST',
					dataType:'text',
					data: $('#delete_message').serialize(),
					success:function(data){
            $('#delete').modal('toggle');
            location.reload();
					},
					error: function(data){
					
					}
				})
  })
</script>
