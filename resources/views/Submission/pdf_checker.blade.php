<script>
import __pdfjs from 'pdfjs-dist/build/pdf';
import PDFJSAnnotate from 'pdfjs-annotate';
import MyStoreAdapter from './myStoreAdapter';

const { UI } = PDFJSAnnotate;
const VIEWER = document.getElementById('viewer');
const RENDER_OPTIONS = {
  documentId: 'Examples.pdf',
  pdfDocument: null,
  scale: 1,
  rotate: 0
};
let promise = adapter.getAnnotations(documentId, pageNumber)

PDFJS.workerSrc = 'pdf.worker.js';
PDFJSAnnotate.setStoreAdapter(MyStoreAdapter);

PDFJS.getDocument(RENDER_OPTIONS.documentId).then((pdf) => {
  RENDER_OPTIONS.pdfDocument = pdf;
  VIEWER.appendChild(UI.createPage(1));
  UI.renderPage(1, RENDER_OPTIONS);
});
const { UI } = PDFJSAnnotate;
const RENDER_OPTIONS = {
  documentId: 'Example.pdf',
  pdfDocument: null,
  scale: 1,
  rotate: 0
};

PDFJS.getDocument(RENDER_OPTIONS.documentId).then(pdf => {
  RENDER_OPTIONS.pdfDocument = pdf;

  // Create a page in the DOM for every page in the PDF
  let viewer = document.getElementById('viewer');
  viewer.innerHTML = '';
  let numPages = pdf.pdfInfo.numPages;
  for (let i=0; i<numPages; i++) {
    let page = UI.createPage(i+1);
    viewer.appendChild(page);
  }

  // Automatically render the first page
  // This assumes that page has already been created and appended
  UI.renderPage(1, RENDER_OPTIONS).then([pdfPage, annotations] => {
    // Useful if you need access to annotations or pdfPage.getViewport, etc.
  });
});

// Scroll event to render pages as they come into view
document.body.addEventListener('scroll', e => {
  /* ... */
});
PDFJSAnnotate.getStoreAdapter().addAnnotation(
    'example.pdf',
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


</script>