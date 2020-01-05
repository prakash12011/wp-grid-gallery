const lightboxEl = document.getElementById("wp_grid_gallery_lightbox");
const lightboxIMG = document.querySelectorAll("#wp_grid_gallery_lightbox img")[0];

Array.from( document.querySelectorAll(".wp_grid_gallery_lightbox > .close_btn") ).forEach(el => {
    el.addEventListener('click', function(event) {
        lightboxEl.classList.toggle("hide");
    });
});

Array.from( document.querySelectorAll(".wp_grid_gallery_container > img") ).forEach(el => {
    el.addEventListener('click', function(event) {
        lightboxIMG.setAttribute( "src", el.getAttribute('src') );
        lightboxEl.classList.toggle("hide");
    });
});
