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

    const customSelects = document.querySelectorAll(".liste-deroulante");
    customSelects.forEach((customSelect) => {
        const selectButton = customSelect.querySelector(".select-button");
        const dropdown = customSelect.querySelector(".select-dropdown");
        const taxomony = customSelect.getAttribute('data-taxomony');
        const options = dropdown.querySelectorAll("li");
        const selectedValue = selectButton.querySelector(".selected-value");
        const placeholder = customSelect.getAttribute(".placeholder");


        const toggleDropdown = () => {
            dropdown.classList.toggle("hidden");
            selectButton.classList.toggle("open");
        };
        selectButton.onclick = () => {
            toggleDropdown();
        };

        options.forEach((option) => {
            option.onclick = () => {
                handleOptionSelect(option);
                toggleDropdown();
            }
        });
        const handleOptionSelect = (option) => {
            options.forEach((opt) => opt.classList.remove("selected"));
            pagePhoto = 1;
            if (option.textContent.trim()) {
                option.classList.add("selected");
                selectedValue.textContent = option.textContent.trim(); // Update selected value
                switch (taxomony) {
                    case "categorie":
                        categorieFiltered = option.getAttribute('data-slug');
                        break;
                    case "format":
                        formatFiltered = option.getAttribute('data-slug');
                        break;
                    case "tri":
                        tri = option.getAttribute('data-slug');
                        break;

                }

            } else {
                selectedValue.textContent = placeholder.textContent;
                switch (taxomony) {
                    case "categorie":
                        categorieFiltered = null;
                        break;
                    case "format":
                        formatFiltered = null;
                        break;
                    case "tri":
                        tri = null;
                        break;
                }
            }
            getMorePhotos();


        };
    });





}

let pagePhoto = 1;
let categorieFiltered = null;
let formatFiltered = null;
let tri = null;

const getMorePhotos = () => {
    const formData = new FormData();
    formData.append('action', 'more_photos');
    formData.append('_ajax_nonce', ajaxInfo.nonce);
    formData.append('page', pagePhoto);
    if (categorieFiltered) {
        formData.append('categorie', categorieFiltered);
    }
    if (formatFiltered) {
        formData.append('format', formatFiltered);
    }
    if (tri) {
        formData.append('tri', tri);
    }


    fetch(ajaxInfo.ajaxUrl, {
        method: 'POST',
        body: formData,
    }).then(response => response.json())
        .then((response) => {
            var photos = document.getElementById("all-photos");
            if (pagePhoto === 1) {
                photos.innerHTML = response.data.html;
            } else {
                photos.insertAdjacentHTML('beforeend', response.data.html);
            }
            var maxPosts = response.data.max_photos;

            var photoDisplayed = document.getElementsByClassName('photo-container').length;

            if (photoDisplayed >= maxPosts) {
                document.getElementById('chargerPlusBtn').style.display = 'none';
            }
        }
        );
}


