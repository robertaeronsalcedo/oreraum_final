
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ORERAUM</title>
   <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">
  @yield('css')

</head>

<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper" id="app">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{'home'}}" class="logo ">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini" src=""><b>U</b>M</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">ORERAUM</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-bell-o fa-2x"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-light-blue"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar" id="chat-list-toggle"><i class="fa fa-comments fa-2x"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('images/defaultpic.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <!-- Status -->
          
          <h6><i class="fa fa-circle text-success"></i> {{Auth::user()->user_type}} </h6>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Dashboard</li>
        <!-- FOR ALL -->
        <li><a href="{{url('home')}}"><i class="fa fa-home "></i> <span>Home</span></a></li>
        <li><a href="{{'/bulletin'}}"><i class="fa fa-feed "></i> <span>Bulletin Board</span></a></li>
        <!--  -->
        <!-- Compose announcement -->
        @can('isAdmin') 
        <li><a href="{{'/compose'}}"><i class="fa fa-bell"></i> <span>Compose</span></a></li>
        @endcan
        @can('isCoordinator') 
        <li><a href="{{'/compose'}}"><i class="fa fa-bell"></i> <span>Compose</span></a></li>
        @endcan
        @can('isCommittee') 
        <li><a href="{{'/compose'}}"><i class="fa fa-bell"></i> <span>Compose</span></a></li>
        @endcan
        @can('isAdviser') 
        <li><a href="{{'/compose'}}"><i class="fa fa-bell"></i> <span>Compose</span></a></li>
        @endcan
        <!--  -->
        <!-- for users -->
          @can('isUser')
         <li><a href="{{'submission'}}"><i class="fa fa-file-pdf-o"></i> <span>Submit Manuscript</span></a></li>
         @endcan
         <!--  -->
         <!-- to assign manuscripts by admin -->
         @can('isAdmin')
         <li><a href="{{'/admin_manuscript_list'}}"><i class="fa fa-file-pdf-o"></i> <span>Submitted Manuscripts</span></a></li>
         @endcan
         <!-- for coordinator -->
         @can('isCoordinator')
         <li><a href="{{'/submitted'}}"><i class="fa fa-file-pdf-o"></i> <span>Assigned to check</span></a></li>
         @endcan
         <!--  -->
         <!-- for committee -->
         @can('isCommittee')
         <li><a href="{{'/submitted'}}"><i class="fa fa-file-pdf-o"></i> <span>Assigned to check</span></a></li>
         @endcan
         <!--  -->
         <!-- for advisers -->
         @can('isAdviser')
         <li><a href="{{'/manuscript_list'}}"><i class="fa fa-file-pdf-o"></i> <span>Submitted Manuscripts  </span></a></li>
          @endcan
         <!--  -->
         <!-- for all  -->
         <li><a href="{{'/Chat_Message'}}"><i class="fa fa-book "></i> <span>Messenger</span></a></li>
        <!--  -->
        <!-- Manage users for admin  -->
        @can('isAdmin') 
        <li><a href="{{'/users'}}"><i class="fa fa-users"></i> <span>Manage User</span></a></li>
        @endcan 
        <!--  -->

        <li><a href="#"><i class="fa fa-gears"></i> <span>Settings</span></a></li>
        

        <li class="">

           <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
             <i class="fa fa-power-off text-red"></i>   <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   

    <!-- Main content -->
    <section class="content container-fluid">
        @include('layouts.chat')
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
    --------------------
    </div>
    <!-- Default to the left -->
    <strong>University Of Mindanao &copy; 2019<a href="#">ORERAUM</a>.</strong> All rights reserved.
  </footer>
  <!-- requestcode -->


<!-- ASSIGN CHECKER MODAL -->
<div class="modal fade" id="checker" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
        <h4 class="modal-title" id="myModalLabel">Available Checker</h4>
      </div>
      
      	
	      <div class="modal-body">
        <div class="media border p-5">  
    
            <div class="col-md-12 ">
            <table class="table">
                <thead class="thead-dark">
						<tr>            
						              	<th>Name</th>
                            <th><center>Number Paper Assign </center></th>
                            <th>Action</th>
						</tr>
						
			  		</thead>

					      <tbody>
						      	<tr> 
                         <td>Barbosa</td>
                         <td><center>2</center></td>
					        			<td>
								      	<button class="btn btn-info" id="" >Assign</button>
		
							      	</td>
		    	  	</tbody>
  			  	</table>				
	     
	      </div>
    
    </div>
  </div>
</div>

    <audio id="notifalert">
        <source src="" type="audio/mpeg">
    </audio>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/moment.js')}}"></script>
<script src="{{asset('js/chat.js')}}"></script>
<script src="{{asset('js/socket.io.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script> -->
<!-- <script src="https://cdnjs.com/libraries/pdf.js"></script> -->
@yield('js')
</body>

<script>
  
  $('#edit').on('show.bs.modal', function (event) {
   
      var button = $(event.relatedTarget) 
      var name = button.data('name') 
      var email = button.data('email') 
      var access_id = button.data('access_id') 
      var id_number = button.data('id_number') 
      var id = button.data('id') 
      var modal = $(this)
       
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #email').val(email);
      modal.find('.modal-body #access_id').val(access_id);
      modal.find('.modal-body #id_number').val(id_number);
      modal.find('.modal-body #id').val(button.data('id') );
      
})

  $('#submitedit').on('click',function(event){
    event.preventDefault();
    console.log($('#updateform').serialize());
    $.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url:"{{'user_update'}}",
					method: 'POST',
					dataType:'text',
					data: $('#updateform').serialize(),
					success:function(data){
            var obj = JSON.parse(data);
            console.log(obj);
            $('#edit').modal('toggle');
            alert("Success!");
            location.reload();
					},
					error: function(data){
					
					}
				})
  })
  

  $('#delete').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget) 

      var id = button.data('id') 
      var modal = $(this)
      console.log(id);  
      modal.find('.modal-body #user_id').val(id);
    
})

$('#deleteuser').on('click',function(event){
    event.preventDefault();
    console.log($('#deleteform').serialize());
    $.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url:"{{'delete_user'}}",
					method: 'POST',
					dataType:'text',
					data: $('#deleteform').serialize(),
					success:function(data){
            $('#delete').modal('toggle');
            location.reload();
					},
					error: function(data){
					
					}
				})
  })

    $('form').submit(function(event) {
      
    event.preventDefault();
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
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Manuscript has been submitted!',
            showConfirmButton: false,
            timer: 2000
})
          location.reload();
        }
      }
    });
  });





  $('#submit_compose').on('click',function(event){
    event.preventDefault();
   var message= $('#message').val();
    $.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url:"{{'compose_message'}}",
					method: 'POST',
					dataType:'text',
					data: {message:message},
					success:function(data){
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Message successfully posted!',
            showConfirmButton: false,
            timer: 2000
           
})
           window.location="/bulletin"
          
          
					},
					error: function(data){
					
					}
				});
  });
  $('#submit_request').on('click',function(event){
    event.preventDefault();
   var code= $('#code').val();
    $.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url:"{{'coderequest'}}",
					method: 'POST',
					dataType:'text',
					data: {code},
					success:function(data){
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Request Code sent!',
            showConfirmButton: false,
            timer: 2000
})
          window.location="/coderequest"
          
					},
					error: function(data){
					
					}
          
				});
  });

 



 
</script>
</html>