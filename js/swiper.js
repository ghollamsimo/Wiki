
const ssSwiper = function() {

    const mySwiper = new Swiper('.swiper-container', {

        slidesPerView: 1,
        effect: 'fade',
        speed: 1000,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            renderBullet: function (index, className) {
                return '<span class="' + className + '">' + (index + 1) + '</span>';
            }
        }

    });

}; // end ssSwiper
