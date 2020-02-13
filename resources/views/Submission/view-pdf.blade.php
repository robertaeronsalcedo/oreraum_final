@extends('layouts.master')
@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('annotate/shared/toolbar.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('annotate/shared/pdf_viewer.css') }}"/>
  <style type="text/css">
    body {
      background-color: #eee;
      font-family: sans-serif;
      margin: 0;
    }

    .pdfViewer .canvasWrapper {
      box-shadow: 0 0 3px #bbb;
    }
    .pdfViewer .page {
      margin-bottom: 10px;
    }

    .annotationLayer {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
    }

    #content-wrapper {
      position: absolute;
      top: 110px;
      width: 100%;
      left: 60px;
      bottom: 60px;
      overflow: auto;
    }

    #hidecommentbtn {
      position: absolute;
      top: 110px;
      right: 0;
      z-index: 5;
    }

    #savebtn {
      z-index: 5;
      top:110px;
      position: absolute;
    }

    #comment-wrapper {
      position: absolute;
      top: 110px;
      right: 0;
      bottom: 0;
      overflow: auto;
      width: 250px;
      background: #eaeaea;
      border-left: 1px solid #d0d0d0;
    }
    #comment-wrapper h4 {
      margin: 10px;
    }
    #comment-wrapper .comment-list {
      font-size: 12px;
      position: absolute;
      top: 38px;
      left: 0;
      right: 0;
      bottom: 0;
    }
    #comment-wrapper .comment-list-item {
      border-bottom: 1px solid #d0d0d0;
      padding: 10px;
    }
    #comment-wrapper .comment-list-container {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 47px;
      overflow: auto;
    }
    #comment-wrapper .comment-list-form {
      position: absolute;
      left: 0;
      right: 0;
      bottom: 0;
      padding: 10px;
    }
    #comment-wrapper .comment-list-form input {
      padding: 5px;
      width: 100%;
    }
    .pdfViewer .page {
      border-image: none;
    }
  </style>
@endsection

@section('content')

<div class="container">
      <button type="button" class="btn btn-primary btn-sm" id="savebtn"><span class="fa fa-save"></span> SAVE</button>
    <button type="button" class="btn btn-default btn-sm" id="hidecommentbtn"><span class="fa fa-angle-left fa-2x"></span></button>
    <div class="toolbar">
    <button class="cursor" type="button" title="Cursor" data-tooltype="cursor">➚</button>

    <div class="spacer"></div>

    <button class="rectangle" type="button" title="Rectangle" data-tooltype="area">&nbsp;</button>
    <button class="highlight" type="button" title="Highlight" data-tooltype="highlight">&nbsp;</button>
    <button class="strikeout" type="button" title="Strikeout" data-tooltype="strikeout">&nbsp;</button>

    <div class="spacer"></div>

    <button class="text" type="button" title="Text Tool" data-tooltype="text"></button>
    <select class="text-size"></select>
    <div class="text-color"></div>

    <div class="spacer"></div>

    <button class="pen" type="button" title="Pen Tool" data-tooltype="draw">✎</button>
    <select class="pen-size"></select>
    <div class="pen-color"></div>

    <div class="spacer"></div>

    <button class="comment" type="button" title="Comment" data-tooltype="point">🗨</button>

    <div class="spacer"></div>

    <select class="scale">
      <option value=".5">50%</option>
      <option value="1">100%</option>
      <option value="1.33">133%</option>
      <option value="1.5">150%</option>
      <option value="2">200%</option>
    </select>

    <a href="javascript://" class="rotate-ccw" title="Rotate Counter Clockwise">⟲</a>
    <a href="javascript://" class="rotate-cw" title="Rotate Clockwise">⟳</a>

    <div class="spacer"></div>

    <a href="javascript://" class="clear" title="Clear">×</a>
  </div>
  <div id="content-wrapper">
    <div id="viewer" class="pdfViewer"></div>
  </div>
  <div id="comment-wrapper">
    <h4>Comments</h4>
    <div class="comment-list">
      <div class="comment-list-container">
        <div class="comment-list-item">No comments</div>
      </div>
      <form class="comment-list-form" style="display:none;">
        <input type="text" placeholder="Add a Comment"/>
      </form>
    </div>
  </div>
</div>



@endsection

@section('js')
  <script>

    var documentId = '{{$title->path}}';
    var overridedocumentId = documentId;
    $('#comment-wrapper').hide();

    $(document).on('click','#hidecommentbtn', function() {

      if($(this).find('span').hasClass('fa-angle-left')) {
        $(this).find('span').removeClass('fa-angle-left').addClass('fa-angle-right');
        $('#comment-wrapper').show();
      }else {
        $(this).find('span').removeClass('fa-angle-right').addClass('fa-angle-left');
        $('#comment-wrapper').hide();
      }

    });


  const getannotation = async() => {

    var opt = {
        headers:{
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        method : 'GET'
    };

    try {
        let response = await fetch('/open-pdf/get-annotation/{{$title->id}}',opt);
        const statusCode = response.status;
        let responseJsonData = await response.json();
        var annotation = JSON.parse(responseJsonData[0].annotation);

        for(x in annotation){
        localStorage.setItem(annotation[x][0],annotation[x][1]);
        }

    }
    catch(e) {
      console.log({error : true, description : e});
    }

        
  }

  getannotation();

    $(document).on('click','#savebtn',async function() {
      newdata = Object.entries(localStorage).filter(function(data){
      return data[0].indexOf(documentId) > -1;
      });


      arr = {};
      arr['id']         = '{{$title->id}}';
      arr['annotation'] = JSON.stringify(newdata);

        var opt = {
            headers:{
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            method : 'POST',
            body : JSON.stringify(arr)
        };

        try {
                let response = await fetch('/open-pdf/store',opt);
                const statusCode = response.status;
                let responseJsonData = await response.json();   
                if(responseJsonData[0].success) {
                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                  })
                }
            }
        catch(e) {
            console.log({error : true, description : e});

        }


    });
  </script>
  <script src="{{ asset('annotate/shared/pdf.js') }}"></script>
  <script src="{{ asset('annotate/shared/pdf_viewer.js') }}"></script>
  <script src="{{ asset('annotate/index.js') }}"></script>


@endsection
