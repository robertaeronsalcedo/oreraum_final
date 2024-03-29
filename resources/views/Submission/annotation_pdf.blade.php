@extends('layouts.master')

@section('content')
  <meta charset="utf-8"/>
  <title>PDFJSAnnotate</title>
  <link rel="stylesheet" type="text/css" href="shared/toolbar.css"/>
  <link rel="stylesheet" type="text/css" href="shared/pdf_viewer.css"/>
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
      top: 35px;
      left: 0;
      right: 250px;
      bottom: 0;
      overflow: auto;
    }

    #comment-wrapper {
      position: absolute;
      top: 35px;
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
</head>
<body>
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
  <script src="shared/pdf.js"></script>
  <script src="shared/pdf_viewer.js"></script>
  <script src="index.js"></script>
@endsection
<!-- <script>
import __pdfjs from 'pdfjs-dist/build/pdf';
import PDFJSAnnotate from 'pdfjs-annotate';
import MyStoreAdapter from './myStoreAdapter';

const { UI } = PDFJSAnnotate;
const VIEWER = document.getElementById('viewer');
const RENDER_OPTIONS = {
  documentId: 'example.pdf',
  pdfDocument: null,
  scale: 1,
  rotate: 0
};

PDFJS.workerSrc = 'pdf.worker.js';
PDFJSAnnotate.setStoreAdapter(MyStoreAdapter);

PDFJS.getDocument(RENDER_OPTIONS.documentId).then((pdf) => {
  RENDER_OPTIONS.pdfDocument = pdf;
  VIEWER.appendChild(UI.createPage(1));
  UI.renderPage(1, RENDER_OPTIONS);
});

let MyStoreAdapter = new PDFJSAnnotate.StoreAdapter({
  getAnnotations(documentId, pageNumber) {
    PDFJSAnnotate.getStoreAdapter().getAnnotations('example.pdf', 1)
  .then((data) => {
    console.log(data.1); // "example.pdf"
    console.log(data.pageNumber); // 1
    console.log(data.annotations); // Array
  }, (error) => {
    console.log(error.message);
  });
  },

  getAnnotation(documentId, annotationId) {
    'example.pdf',
    'ef158e68-c54c-4c4d-b10c-7bc8c0c7fe7c'
  ).then((annotation) => {
    console.log(annotation); // Object
  }, (error) => {
    console.log(error.message);
  });},

  addAnnotation(documentId, pageNumber, annotation) {    'example.pdf',
    1,
    {
      type: 'area',
      width: 100,
      height: 50,
      x: 75,
      y: 75
    }
  ).then((annotation) => {
    console.log(annotation); // Object
  }, (error) => {
    console.log(error.message);
  });
},

  editAnnotation(documentId, pageNumber, annotation) {
    'example.pdf',
    1,
    {
      uuid: 'ef158e68-c54c-4c4d-b10c-7bc8c0c7fe7c',
      type: 'area',
      width: 100,
      height: 50,
      x: 250,
      y: 100
    }
  ).then((annotation) => {
    console.log(annotation); // Object
  }, (error) => {
    console.log(error.message);
  });
  },

  deleteAnnotation(documentId, annotationId) {PDFJSAnnotate.getStoreAdapter().deleteAnnotation(
    'example.pdf',
    'ef158e68-c54c-4c4d-b10c-7bc8c0c7fe7c'
  ).then(() => {
    console.log('deleted');
  }, (error) => {
    console.log(error.message);
  });,
  
  addComment(documentId, annotationId, content) {  
      'example.pdf',
    'ef158e68-c54c-4c4d-b10c-7bc8c0c7fe7c',
    'Hello world!'
  ).then((comment) => {
    console.log(comment); // Object
  }, (error) => {
    console.log(error.message);
  });
},

  deleteComment(documentId, commentId) {
    'example.pdf',
    '8ce957c4-90fa-475b-bd5c-ae9d5ab7c0ae'
  ).then(() => {
    console.log('deleted');
  }, (error) => {
    console.log(error.message);
  }
});

</script> -->