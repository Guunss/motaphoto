window.onload = () => {
    var modale = document.getElementById('modale-contact');

    var linksOpenContact = document.getElementsByClassName('show-modale-contact');

    var wpcf7Elm = document.querySelector('.wpcf7');

    wpcf7Elm.addEventListener('wpcf7mailsent', function (event) {
        modale.style.display = "none";
    }, false);


    Array.from(linksOpenContact).forEach((linkOpenContact) => {
        linkOpenContact.onclick = () => {
            modale.style.display = "block";
            var refphoto = document.getElementById('photo-ref');
            if (refphoto) {
                var inputRefPhoto = document.getElementsByName('your-ref-photo')[0];
                inputRefPhoto.value = refphoto.textContent;
            }
            return false;
        }
    });

    window.onclick = (event) => {
        if (event.target == modale) {
            modale.style.display = "none";
        }
    }

    //hover au dessus des fleches de l'écran single-photo.php

    var fleches = document.getElementsByClassName('fleche-btn');
    Array.from(fleches).forEach((element) => {
        if (element.classList.contains('precedent')) {
            element.onmouseover = () => {
                document.getElementById('tooltip-precedent').style.opacity = 1;
            }
            element.onmouseout = () => {
                document.getElementById('tooltip-precedent').style.opacity = 0;
            }
        }
        if (element.classList.contains('suivant')) {
            element.onmouseover = () => {
                document.getElementById('tooltip-suivant').style.opacity = 1;
            }
            element.onmouseout = () => {
                document.getElementById('tooltip-suivant').style.opacity = 0;
            }
        }
    });


    var selects = document.getElementsByClassName('filter-select');

    Array.from(selects).forEach((select) => {
        select.onchange = () => {
            if (select.value === 'empty') {
                select.value = 'ALL';
            }
        }
    });

    var btnChargerPlus = document.getElementById('chargerPlusBtn')
    if (btnChargerPlus) {
        btnChargerPlus.onclick = () => {
            pagePhoto++;
            getMorePhotos();


            return false;
        }
    }


}

let pagePhoto = 1;

const getMorePhotos = () => {
    const formData = new FormData();
    formData.append('action', 'more_photos');
    formData.append('_ajax_nonce', ajaxInfo.nonce);
    formData.append('page', pagePhoto);


    fetch(ajaxInfo.ajaxUrl, {
        method: 'POST',
        body: formData,
    }).then(response => response.json())
        .then((response) => {
            var photos = document.getElementById("all-photos");
            photos.insertAdjacentHTML('beforeend', response.data.html);
            var maxPosts = response.data.max_photos;

            var photoDisplayed = document.getElementsByClassName('photo-container').length;

            if (photoDisplayed >= maxPosts) {
                document.getElementById('chargerPlusBtn').style.display = 'none';
            }
        }
        );
}


