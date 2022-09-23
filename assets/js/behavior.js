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
    
    $('.modal').modaal({
        type: 'inline',
        animation_speed: '1000',
        background: '#000',
    });
});
