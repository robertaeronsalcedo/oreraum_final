
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>ORERAUM</title>
   <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <link rel="stylesheet" href="{{asset('css/animate.css')}}">
  @yield('css')
   <style>
     
     @media only screen and (min-device-width: 320px) {
      #chatModal {
        width: 75% !important;
      }
     }

    @media only screen and (min-device-width: 768px){
      #chatModal {
        width: 50% !important;
      }
    }

    @media only screen and (min-device-width: 1024px){
      #chatModal {
        width: 25% !important;
      }
    }
   </style>

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
          @include('layouts.notification')
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar" id="chat-list-toggle"><i class="fa fa-comments"></i></a>
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
         <li><a href="{{'/committee-manuscripts'}}"><i class="fa fa-file-pdf-o"></i> <span>Assigned to check</span></a></li>
         @endcan
         <!--  -->
         <!-- for advisers -->
         @can('isAdviser')
         <li><a href="{{'/manuscript_list'}}"><i class="fa fa-file-pdf-o"></i> <span>Submitted Manuscripts  </span></a></li>
          @endcan
         <!--  -->
         <!-- for all  -->
        <li><a href="{{'/view-schedule'}}"><i class="fa fa-list"></i> <span>Defense Schedule</span></a></li>
        @can('isAdmin')
        <li><a href="{{'/make-schedule'}}"><i class="fa fa-shield"></i> <span>Make a Schedule</span></a></li>
        @endcan
        <!--  -->
        <!-- Manage users for admin  -->
        <!--  -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Setup</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @can('isAdmin') 
            <li><a href="{{'/admin_register'}}"><i class="fa fa-user-plus"></i> <span>Add Member</span></a></li>
            <li><a href="{{'/users'}}"><i class="fa fa-users"></i> <span>Manage User</span></a></li>
            @endcan 
            <li><a href="{{'/password'}}"><i class="fa fa-key"></i> <span>Change Password</span></a></li>
          </ul>
        </li>

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
<script>
  // var _HOST = location.origin.replace(/^http/, 'ws').replace("8000","3000");
  var _HOST = ":4000";
  console.log(_HOST);
</script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/moment.js')}}"></script>
<script src="{{asset('js/chat.js')}}"></script>
<script src="{{asset('js/notification.js')}}"></script>
<script src="{{asset('js/socket.io.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script> -->
<!-- <script src="https://cdnjs.com/libraries/pdf.js"></script> -->
@yield('js')
</body>

<script>
  




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
            var socket = io(_HOST);
            socket.emit('notification',
              {'notification':true,
              data:{
                announcement : true,
                user_id : my_id
              }
            });
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