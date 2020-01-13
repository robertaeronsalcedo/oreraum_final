@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Compose a message</div>
                    <br>
                    <textarea id="message" row="4" cols="100">
                    </textarea> 
                                <button type="submit" id="submit_compose"class="btn btn-primary" align="center">
                                    Post
                                </button>
                               
                    </div>
              
            </div>
        </div>
    </div>
</div>
@endsection
