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
var ignoreButtons = document.getElementsByClassName('ignoreButton');
var deleteButtons = document.getElementsByClassName('deleteButton');

for(let i = 0; i < comments.length; i++) {
    comments[i].addEventListener('click', function() {
        var id = comments.item(i).id;
        id = id.slice(id.indexOf('-') + 1);

        commentIdField.setAttribute('value', id);
        commentEditionField.innerText = comments[i].innerText;
    });
}


for(let i = 0; i < ignoreButtons.length; i++) {
    ignoreButtons[i].addEventListener('click', function() {
        var name = ignoreButtons[i].getAttribute('name');
        id = name.slice(name.indexOf('-') + 1);

        
    });
}

for(let i = 0; i < deleteButtons.length; i++) {
    deleteButtons[i].addEventListener('click', function() {
        var name = deleteButtons[i].getAttribute('name');
        id = name.slice(name.indexOf('-') + 1);

        
    });
}


