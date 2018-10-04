
var signalButtons = document.getElementsByClassName('signalCommentButton');

// Ask the user to confirm the signalement of a comment.
for(let i = 0; i < signalButtons.length; i++) {
    signalButtons[i].addEventListener('click', function(event) {
        if(!confirm('Voulez-vous vraiment signaler ce commentaire ?')) {
            event.preventDefault();
        }
    });
}