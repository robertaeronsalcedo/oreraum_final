@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11 ">
            <div class="panel panel-default">
                <div class="panel-heading"><center><H2>DEFENSE SCHEDULE</H2></center></div>
                  	
					    <table class="table table-bordered">
					  <thead>
					    <tr>
					      <th scope="col">Month</th>
					      <th scope="col">Date</th>
					      <th scope="col">Time Start</th>
					      <th scope="col">Time End</th>
					      <th scope="col">Full Name</th>
					      <th scope="col">Venue</th>

					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($viewsched as $view)
					    <tr>
					      <th scope="row">{{$view->month}}</th>
					      <td>{{$view->date}}</td>
					      <td>{{$view->timestart}}</td>
					      <td>{{$view->timeend}}</td>
					      <td>{{$view->fullname}}</td>
					      <td>{{$view->venue}}</td>
					    </tr>
					    @endforeach
					  </tbody>
					</table>
            </div>  
        </div>
    </div>
</div>
@endsection
