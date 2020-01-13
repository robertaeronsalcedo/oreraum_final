@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Bulletin</div>
               
                <div class="panel-body">
                @foreach($compose as $comp)    
                 <div class="media border p-3">
                <img src="{{asset('images/397340650.jpg')}}" alt="User Image" class="img-circle" style="width:80px;">
                
                <div class="media-body">
                
                    <h4>{{Auth::user()->name}}<small> <i>{{$comp->created_at}}</i></small></h4>
                    <p>{{$comp->message}}</p>
                    <hr>
                    @endforeach
                </div>
                 
                </div>
                
                <hr>
                </div>
                </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
