tinymce.init({
  selector: '#editedContent',
  branding: false,
  statusbar: false,
  height: 500,
  menubar: false,
  toolbar: 'undo redo |  formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat',
  content_css: './public/css/chapter-inner-style.css'
});

/*tinymce.init({
  selector: '#editedComment',
  branding: false,
  statusbar: false,
  height: 120,
  menubar: false,
  toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | removeformat',
  content_css: './public/css/chapter-inner-style.css'
});*/
