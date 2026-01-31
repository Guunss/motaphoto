window.onload = () => {
    var modale = document.getElementById('modale-contact');

    var linkOpenContact = document.getElementsByClassName('show-modale-contact')[0];

    var wpcf7Elm = document.querySelector('.wpcf7');

    wpcf7Elm.addEventListener('wpcf7mailsent', function (event) {
        modale.style.opacity = 0;
        modale.style.height = 0;
    }, false);


    linkOpenContact.onclick = () => {
        modale.style.opacity = 1;
        modale.style.height = '100%';
        return false;
    };

    window.onclick = (event) => {
        if (event.target == modale) {
            modale.style.opacity = 0;
            modale.style.height = 0;
        }
    }
}