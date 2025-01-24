$('.banners').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    responsive: [
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                dots: true,
            },
        },
    ],
});
