tinymce.init({
  selector: '#editedContent',
  branding: false,
  statusbar: false,
  height: 500,
  menubar: false,
  toolbar: 'undo redo |  formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat',
  content_css: './public/css/chapter-inner-style.css'
});



var commentEditionField = document.getElementById('editedComment');
var commentIdField = document.getElementById('editedCommentId');
var comments = document.getElementsByClassName('comment');

// Display a comment content into a small edition field when the comment is clicked on.
for(let i = 0; i < comments.length; i++) {
    comments[i].addEventListener('click', function() {
        var id = this.id;
        id = id.slice(id.indexOf('-') + 1);

        commentIdField.value = id;
        commentEditionField.value = this.innerText;
    });
}
