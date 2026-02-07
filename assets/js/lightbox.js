document.addEventListener('DOMContentLoaded', () => {
    const lightbox = document.getElementById('lightbox');
    const lightboxCloseBtn = lightbox.querySelector('.lightbox-close');
    const lightboxPrevBtn = lightbox.querySelector('.lightbox-prev');
    const lightboxNextBtn = lightbox.querySelector('.lightbox-next');

    const photoContainers = document.getElementsByClassName('photo-container');

    let images = [];
    let currentIndex;

    Array.from(photoContainers).forEach((photo, index) => {
        var lightboxBtn = photo.querySelector('.btn-lightbox');
        var imgSrc = lightboxBtn.getAttribute('data-img');

        const refPhoto = lightboxBtn.getAttribute('data-photo-ref');
        const categories = lightboxBtn.getAttribute('data-photo-cat');

        images.push({ imgSrc, refPhoto, categories });

        lightboxBtn.onclick = () => {
            openLightbox(index);
        }
    });

    const openLightbox = (index) => {
        currentIndex = index;

        lightbox.querySelector('.lightbox-photo').src = images[index].imgSrc;
        lightbox.querySelector('.ref-photo').innerHTML = images[index].refPhoto;
        lightbox.querySelector('.categorie').innerHTML = images[index].categories;
        lightbox.style.display = 'block';

    };

    lightboxCloseBtn.onclick = () => {
        lightbox.style.display = 'none';
    };

    lightboxNextBtn.onclick = () => {
        var nextIndex = (currentIndex + 1) % images.length;
        openLightbox(nextIndex);
    }

    lightboxPrevBtn.onclick = () => {
        var prevIndex = (currentIndex - 1 + images.length) % images.length;
        openLightbox(prevIndex);
    }

})