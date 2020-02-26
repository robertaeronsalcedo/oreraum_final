@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Change Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" id="change-pass-form" role="form" method="POST" >
                        {{ csrf_field() }}

                      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Enter Old Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="old_password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                           <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" class="btn btn-primary" id="change-pass-btn">
                                    Change Password
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

@section('js')
<script>
        $(document).on('click','#change-pass-btn',async function() {
                var arr = $('#change-pass-form').serializeArray().map(function(data) {
                    this[data.name] = data.value;
                    return this;
                }.bind({}))[0];

                var opt = {
                headers:{
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                method : 'POST',
                body : JSON.stringify(arr)
            };

            try {
                    let response = await fetch('/change-password',opt);
                    const statusCode = response.status;
                    let responseJsonData = await response.json();   
                    if(responseJsonData[0].success) {
                      Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Successfully Change Password',
                        showConfirmButton: false,
                        timer: 1500
                      })
                      document.getElementById("change-pass-form").reset();
                      return;
                    }

                      Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: responseJsonData[0].message,
                        showConfirmButton: false,
                        timer: 1500
                      })

                }
            catch(e) {
                console.log({error : true, description : e});

            }


        });
</script>
@endsection