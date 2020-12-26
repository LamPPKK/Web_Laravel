setTimeout(function() {
    var listScripts = [
        'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0&appId=1508841146171149',
        'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js',
    ];
    for (var i = 0; i < listScripts.length; i++) {
        var headID = document.getElementsByTagName("head")[0];
        var newScript = document.createElement('script');
        newScript.type = 'text/javascript';
        newScript.src = listScripts[i];
        headID.appendChild(newScript);
        console.log(newScript);

    }

    var da = new Date();
    console.log(da);
}, 4000);


$(document).ready(function() {
    if ($(window).width() > 576) {
        $("#zoom_03").ezPlus({
            gallery: 'gallery_01',
            cursor: 'pointer',
            galleryActiveClass: "active",

        });
    } else {
        $("#zoom_03").ezPlus({
            zoomWindowPosition: 6,
            gallery: 'gallery_01',
            cursor: 'pointer',
            galleryActiveClass: "active",
            responsive: 'true',
        });
    }
    $("#zoom_03").bind("click", function(e) {
        var ez = $('#zoom_03').data('ezPlus');
        ez.closeAll(); //NEW: This function force hides the lens, tint and window
        $.fancyboxPlus(ez.getGalleryList());
        return false;
    });

});
$('.slideProductZoom').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 4000,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 6,
                slidesToScroll: 1,
                infinite: true,
            }
        }, {
            breakpoint: 980,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 1,
                infinite: true,
            }
        },
        {
            breakpoint: 900,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1
            }
        }, {
            breakpoint: 800,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        }, {
            breakpoint: 700,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});


$('.plus-product').on('click', function(e) {
    e.preventDefault();
    let total__product = $(this).prev();
    let total = parseInt(total__product.val()) + 1;
    if (total > 99) {
        total__product.val(99);
    } else {
        total__product.val(total);
    }
    let product_price = $(this).prev().prev().prev().val()
    if (product_price != undefined) {
        let cart_id = $(this).attr('cart-id');
        let show_price = total * product_price;
        let change_price = show_price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

        $(this).parent().parent().next().children().children().next().text(change_price);

    }
    // let sell_price = $('.sell-price').attr('sell-price');
    // let price = total * parseInt(sell_price);
    // let change_price = price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    // $('.into__money').text(change_price);
});
$('.only-number').keypress(function() {
    return event.charCode >= 48 && event.charCode <= 57;
});
$('.button-cart').click(function(e) {
    e.preventDefault();
});