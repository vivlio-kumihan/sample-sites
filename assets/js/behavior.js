jQuery(function ($) {
    // $('.gallery').each(function () {
    //   $(this).modaal({
    //     type: 'image'
    //   });
    // });
    $('.gallery').modaal({
        type: 'image',
        animation: 'fade',
        animation_speed: '1000',
        background: '#000',
    });
    
    $('.modal').modaal({
        type: 'inline',
        animation: 'fade',
        animation_speed: '1000',
        background: '#000',
    });
});
