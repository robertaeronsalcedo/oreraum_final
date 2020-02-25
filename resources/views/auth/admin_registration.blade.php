@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="box-shadow: 8px 5px 5px rgba(0,0,0,0.5)">
                <div class="panel-heading ">Register new Member</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/admin-create">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('id_number') ? ' has-error' : '' }}">
                            <label for="idnumber" class="col-md-4 control-label">ID Number</label>

                            <div class="col-md-6">
                                <input id="id_number" type="text" class="form-control" name="id_number" value="{{ old('id_number') }}" required autofocus>

                                @if ($errors->has('id_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Status</label>

                            <div class="col-md-6">
                                <select id="user_type" type="text" class="form-control" name="user_type" value="{{ old('name') }}" required autofocus>
                                <option value="Adviser"> Adviser </option>
                                <option value="Committee"> Committee </option>
                                <option value="Coordinator"> Coordinator </option>
                            </select>
                            </div> 
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         
                            <div class="col-md-6">
                                <input id="password" type="hidden" value="123456" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                   
                       

                            <div class="col-md-6">
                                <input id="password-confirm" value="123456" type="hidden" class="form-control" name="password_confirmation" required>
                            </div>
                        <div class="form-group ">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Member
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
