@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default"style=" box-shadow: 8px 5px 5px rgba(0,0,0,0.5)">
                <div class="panel-heading">Compose a message</div>
           
                </div>
                </div>
                </div>
                
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="well well-lg" style=" box-shadow: 8px 5px 5px rgba(0,0,0,0.5)">
                            <div class="media1">
                            <a class="pull-left" href="{{'/bulletin'}}">
                            <img class="media-object img-circle" width="80px" src="{{asset('images/umlogo.png')}}" alt="Generic placeholder image">
                            </a>
                            <div class="media-body">                  
                           <div class="form-group" style="padding:12px;">
                            <textarea class="form-control animated" id="message" placeholder="Create your announcement here.."></textarea>
                           <button class="btn btn-info pull-right" style="margin-top:10px" id="submit_compose">Post Announcement</button>
                           </div>
                </div>
            </div>  
</div>
@endsection

@section('js')

@endsection