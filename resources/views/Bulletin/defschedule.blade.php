@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="box-shadow: 8px 5px 5px rgba(0,0,0,0.5)">
                <div class="panel-heading">Set a Schedule</div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="/create-schedule">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="Month" class="col-md-4 control-label">Month</label>

                              <div class="col-md-4">
                                <select id="month" type="text" class="form-control" name="month" required autofocus>
                                <option value="January"> January </option>
                                <option value="February"> February </option>
                                <option value="March"> March </option>
                                <option value="April"> April </option>
                                <option value="May"> May </option>
                                <option value="June"> June </option>
                                <option value="July"> July </option>
                                <option value="August"> August </option>
                                <option value="September"> September </option>
                                <option value="October"> October </option>
                                <option value="November"> November </option>
                                <option value="December"> December </option>

                            </select>
                            </div> 
                        </div>
                          <div class="form-group">
                            <label for="date" class="col-md-4 control-label">Date</label>

                              <div class="col-md-2">
                                <select id="date" type="text" class="form-control" name="date" required autofocus>
                                <option value="1"> 1 </option>
                                <option value="2"> 2 </option>
                                <option value="3"> 3 </option>
                                <option value="4"> 4 </option>
                                <option value="5"> 5 </option>
                                <option value="6"> 6 </option>
                                <option value="7"> 7 </option>
                                <option value="8"> 8 </option>
                                <option value="9"> 9 </option>
                                <option value="10"> 10 </option>
                                <option value="11"> 11 </option>
                                <option value="12"> 12 </option>
                                <option value="13"> 13 </option>
                                <option value="14"> 14 </option>
                                <option value="15"> 15 </option>
                                <option value="16"> 16 </option>
                                <option value="17"> 17 </option>
                                <option value="18"> 18 </option>
                                <option value="19"> 19 </option>
                                <option value="20"> 20 </option>
                                <option value="21"> 21 </option>
                                <option value="22"> 22 </option>
                                <option value="23"> 23 </option>
                                <option value="24"> 24 </option>
                                <option value="25"> 25 </option>
                                <option value="26"> 26 </option>
                                <option value="27"> 27 </option>
                                <option value="28"> 28 </option>
                                <option value="29"> 29 </option>
                                <option value="30"> 30 </option>
                                <option value="31"> 31 </option>


                            </select>
                            </div> 
                        </div>
                          
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Time</label>

                            <div class="col-md-2">
                                <input id="timestart" type="text" class="form-control" name="timestart" placeholder="Start" required autofocus>
                                -
                                 <input id="timeend" type="text" class="form-control" name="timeend" placeholder="End" required autofocus>

                            </div>
                        </div>
                          <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Full Name</label>

                            <div class="col-md-6">
                                <input id="fullname" type="text" class="form-control" name="fullname" placeholder="Enter Full Name" required autofocus>
                            </div>
                        </div>
                             <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Venue</label>

                            <div class="col-md-6">
                                <input id="venue" type="text" class="form-control" name="venue" placeholder="Enter Full Name" required autofocus>
                            </div>
                        </div>




                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Set up schedule
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
