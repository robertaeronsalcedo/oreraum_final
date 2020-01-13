@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"style="background:white-red">Home</div>
                   
                </div>
            </div>
           
            <div class="col-md-3 col-md-offset-1">
            <div class="panel panel-default">
                @can('isAdmin') 
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-red"><i class="fa fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pending Papers</span>
                        <span class="info-box-number">93,139</span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>

                   @endcan
                @can('isUser')
                 <div class="panel-heading"align="center"><h5>for students1 </h5></div>
                 @endcan
                </div>
            </div>
            
            <div class="col-md-3 col-md-offset-0">
            <div class="panel panel-default">
            @can('isAdmin') 
            <div class="info-box">
                            <!-- Apply any bg-* class to to the icon to color it -->
                            <span class="info-box-icon bg-blue"><i class="fa fa-file"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Manuscripts</span>
                                <span class="info-box-number">93,139</span>
                            </div>
                            <!-- /.info-box-content -->
                            <span class="info-box-text">Completed</span>
                            </div>

                @endcan

                @can('isUser')
                <div class="panel-heading" align="center"><h5>Students2</h5></div>
                @endcan
                </div>
            </div>
            
            <div class="col-md-3 col-md-offset-0">
            <div class="panel panel-default">
            @can('isAdmin') 
            <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-red"><i class="fa fa-group"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Students</span>
                        <span class="info-box-number">93,139</span>
                    </div>
                    <!-- /.info-box-content --> 
                    </div>

                   @endcan
                   @can('isUser')
                   <div class="panel-heading" align="center"><h5>Students3</h5></div>
                   @endcan
                </div>
            </div>
            <div class="col-md-9 col-md-offset-1"
                            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-load"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Progress</span>
                    <span class="info-box-number">41,410</span>
                    
                    <!-- The progress section is optional -->
                    <div class="progress">
                    <div class="progress-bar" style="width: 70%; background-color:green;">Research Committee</div>
                    </div>
                    <span class="progress-description">
                    70% Increase in 30 Days
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                </div>
                </div>
                        
        <div class="col-md-3 col-md-offset-1">
            <div class="panel panel-default">
            <div class="panel-heading"align="center"><h5>Advisers<h5></div>
            </div>
            </div>
        
        <div class="col-md-3 col-md-offset-0">
            <div class="panel panel-default">
            <div class="panel-heading"align="center"><h5>Research Coordinator<h5></div>
            </div>
            </div>
        
        <div class="col-md-3 col-md-offset-0">
            <div class="panel panel-default">
            <div class="panel-heading"align="center"><h5>Review Committee<h5></div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>



@endsection
