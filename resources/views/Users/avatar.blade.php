@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Compose a message</div>


                <form id="manupload" method="post" enctype="multipart/form-data">
                      <div class="row">
                            <div class="col-md-1" ><h4>Select File</h4></div>
                            <div class="col-md-6">
                              <input type="file" name="file" id="file">
                           
                              <div class="col-md-12">
                                
                                <input type="submit" id="upload" name="upload" value="Upload" class="btn btn-success">
                                <div class="pull-right">
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection