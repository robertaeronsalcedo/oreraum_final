@extends('layouts.master')

@section('content')

<style>
.wizard {
    background: #f1f1f1;
    padding: 30px;
}
.wizard .nav-tabs {
    position: relative;
    border: 0px;
}
.wizard > div.wizard-inner {
    position: relative;
}
.connecting-line{
    height:15px;
    background: #e0e0e0;
    position: absolute;
    width: 99.5%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top:44%;
    z-index: 1;
    border-radius: 15px;
}
.active-line{
    height:15px;
    background: #e0e0e0;
    position: absolute;
    width: 99.5%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top:44%;
    z-index: 1;
    border-radius: 15px !important;
}
.active .connecting-line{
    background-color: #2ED4E0;
}
.border-right{
    border-radius: 15px 0 0 15px;
}
.border-left{
    border-radius: 0;
}
.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    cursor: default;
    border: 0;
    color:#2ED4E0;
    border-bottom-color: transparent;
}
.nav-tabs li p{
    padding-top:70px;
    font-size: 16px;
    text-align: center;
}
.list-inline{
    text-align: center;
}
span.round-tab {
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background:#DFE3E4;
    border: 2px solid #fff;
    z-index:1;
    position:absolute;
    text-align: center;
    font-size: 25px;
}
.wizard li.active span.round-tab{
    background:#2ED4E0;
    color:white;
    border: 2px solid #fff;
}
span.round-tab:hover{
    color: white;
    border: 2px solid #fff;
    background-color:#2ED4E0; 
}
.wizard .nav-tabs > li {
    width: 25%;
}
.wizard .nav-tabs > li a{
    width: 70px;
    height: 70px;
    margin: 20px auto;
    border-radius: 100%;
    padding: 0;
    color: #777;
}
.wizard .tab-pane {
    position: relative;
    padding-top: 15px;
    border-top: 1px solid #fff;
    margin-top: 50px;
}
.next-step:hover, .next-step, .prev-step:hover, .prev-step{
    position: relative;
    background-color: #2ED4E0;
    font-size: 16px;
    color: #FFFFFF;
}
@media( min-width : 320px ) and ( max-width : 360px ){
    .wizard {
        width: 90%;
        height: auto !important;
    }
    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }
    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
    }
    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
	.next-step{
		margin-top:10px; 
	}
    .nav-tabs li p{
        padding-top:60px;
        font-size: 16px;
        text-align: center;
    }
    .connecting-line , .active-line{
        top:43%;
    }
}
.circle-tile {
    margin-bottom: 15px;
    text-align: center;
}
.circle-tile-heading {
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-radius: 100%;
    color: #FFFFFF;
    height: 80px;
    margin: 0 auto -40px;
    position: relative;
    transition: all 0.3s ease-in-out 0s;
    width: 80px;
}
.circle-tile-heading .fa {
    line-height: 80px;
}
.circle-tile-content {
    padding-top: 50px;
}
.circle-tile-number {
    font-size: 26px;
    font-weight: 700;
    line-height: 1;
    padding: 5px 0 15px;
}
.circle-tile-description {
    text-transform: uppercase;
}
.circle-tile-footer {
    background-color: rgba(0, 0, 0, 0.1);
    color: rgba(255, 255, 255, 0.5);
    display: block;
    padding: 5px;
    transition: all 0.3s ease-in-out 0s;
}
.circle-tile-footer:hover {
    background-color: rgba(0, 0, 0, 0.2);
    color: rgba(255, 255, 255, 0.5);
    text-decoration: none;
}
.circle-tile-heading.dark-blue:hover {
    background-color: #2E4154;
}
.circle-tile-heading.green:hover {
    background-color: #138F77;
}
.circle-tile-heading.orange:hover {
    background-color: #DA8C10;
}
.circle-tile-heading.blue:hover {
    background-color: #2473A6;
}
.circle-tile-heading.red:hover {
    background-color: #CF4435;
}
.circle-tile-heading.purple:hover {
    background-color: #7F3D9B;
}
.tile-img {
    text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.9);
}

.dark-blue {
    background-color: #34495E;
}
.green {
    background-color: #16A085;
}
.blue {
    background-color: #2980B9;
}
.orange {
    background-color: #F39C12;
}
.red {
    background-color: #E74C3C;
}
.purple {
    background-color: #8E44AD;
}
.dark-gray {
    background-color: #7F8C8D;
}
.gray {
    background-color: #95A5A6;
}
.light-gray {
    background-color: #BDC3C7;
}
.yellow {
    background-color: #F1C40F;
}
.text-dark-blue {
    color: #34495E;
}
.text-green {
    color: #16A085;
}
.text-blue {
    color: #2980B9;
}
.text-orange {
    color: #F39C12;
}
.text-red {
    color: #E74C3C;
}
.text-purple {
    color: #8E44AD;
}
.text-faded {
    color: rgba(255, 255, 255, 0.7);
}
</style>
            
            
     
                
<!------For admin------>

@can('isAdmin')
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<div class="container">
  <div class="row">
    <div class="col-lg-3 col-sm-6 col-sm-offset-1">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-paperclip fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content dark-blue">
          <div class="circle-tile-description text-faded">Completed Manuscripts</div>
          <div class="circle-tile-number text-faded ">265</div>
          <a class="circle-tile-footer" href="#">More Info<i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div>
     
    <div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-file-pdf-o fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content dark-blue">
          <div class="circle-tile-description text-faded"> Pending </div>
          <div class="circle-tile-number text-faded ">10</div>
          <a class="circle-tile-footer" href="/submitted">More Info<i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-check fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content dark-blue">
          <div class="circle-tile-description text-faded">Available Checker</div>
          <div class="circle-tile-number text-faded ">10</div>
          <a class="circle-tile-footer" href="#">More Info<i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div> 
    <div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-user-o fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content dark-blue">
          <div class="circle-tile-description text-faded"> Students </div>
          <div class="circle-tile-number text-faded ">10</div>
          <a class="circle-tile-footer" href="#">More Info<i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div> 
  </div> 
</div>  

  @endcan
  <!-- FOR USER -->
  @can('isUser')
  <div class="container bootstrap snippet">
  <div class="row">
    <div class="col-md-3 col-sm-6 col-sm-offset-1">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-user-o fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content dark-blue">
          <div class="circle-tile-description text-faded">Panel Online</div>
          <div class="circle-tile-number text-faded ">265</div>
          <a class="circle-tile-footer" href="#">More Info<i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div>
     
    <div class="col-md-3 col-sm-6">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-file-pdf-o fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content dark-blue">
          <div class="circle-tile-description text-faded"> PDF Submitted </div>
          <div class="circle-tile-number text-faded ">10</div>
          <a class="circle-tile-footer" href="/submitted">More Info<i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-check fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content dark-blue">
          <div class="circle-tile-description text-faded">Revised PDF</div>
          <div class="circle-tile-number text-faded ">10</div>
          <a class="circle-tile-footer" href="#">More Info<i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div>

     <div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default ">
              
                <section>
	        <div class="wizard">
	            <div class="wizard-inner">
	                <div class="active-line"></div>
	                <ul class="nav nav-tabs" role="tablist">
	                    <li role="presentation" class="active stepactive1">
	                		<div class="connecting-line border-right"></div>
	                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
	                            <span class="round-tab">
	                            	1
	                            </span>
	                            <p>Adviser</p>
	                        </a>
	                    </li>
	                    <li role="presentation" class="disabled stepactive2">
	                		<div class="connecting-line border-right border-left"></div>
	                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
	                            <span class="round-tab">
	                            	2
	                            </span>
	                            <p>	Research Coordinator</p>
	                        </a>
	                    </li>
	                    <li role="presentation" class="disabled stepactive3">
	                		<div class="connecting-line border-right border-left"></div>
	                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
	                            <span class="round-tab">
	                            	3
	                            </span>
	                            <p>Review Committee</p>
	                        </a>
	                    </li>
	                    <li role="presentation" class="disabled stepactive4">
	                		<div class="connecting-line"></div>
	                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
	                            <span class="round-tab fa fa-check">
	                            	
	                            </span>
	                            <p>Defense Schedule</p>
	                        </a>
	                    </li>
	                </ul>
	            </div>
	
            </div>
        </div>
	</div>
</div>
    @endcan
    <!-- for advisers  -->
    @can('isAdviser')
    <div class="container bootstrap snippet">
  <div class="row">
    <div class="col-md-2 col-sm-6 col-sm-offset-1">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-user-o fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content dark-blue">
          <div class="circle-tile-description text-faded">Under Students</div>
          <div class="circle-tile-number text-faded ">265</div>
          <a class="circle-tile-footer" href="#">More Info<i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div>
     
    <div class="col-md-2 col-sm-6">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-file-pdf-o fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content dark-blue">
          <div class="circle-tile-description text-faded"> PDF Checked </div>
          <div class="circle-tile-number text-faded ">10</div>
          <a class="circle-tile-footer" href="/submitted">More Info<i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-6">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-paperclip fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content dark-blue">
          <div class="circle-tile-description text-faded">Pending PDF</div>
          <div class="circle-tile-number text-faded ">10</div>
          <a class="circle-tile-footer" href="#">More Info<i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-6">
      <div class="circle-tile ">
        <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-users fa-fw fa-3x"></i></div></a>
        <div class="circle-tile-content dark-blue">
          <div class="circle-tile-description text-faded">Groups</div>
          <div class="circle-tile-number text-faded ">10</div>
          <a class="circle-tile-footer" href="#">More Info<i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
    </div>
   
 

    @endcan

    
		

       </div> 
     </div>  
   </div>
</div>






@endsection
