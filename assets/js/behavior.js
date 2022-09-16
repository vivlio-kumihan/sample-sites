$(".openbtn1").click(function () {
    $(this).toggleClass('active');
});

jQuery(function ($) {
    // $('.gallery').each(function () {
    //   $(this).modaal({
    //     type: 'image'
    //   });
    // });
    $('.gallery').modaal({
        type: 'image',
        animation_speed: '1000',
        background: '#fff',
    });
});