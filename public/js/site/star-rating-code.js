// $(document).on('click','.pagination a',function(e){
//     e.preventDefault();
//     var page = $(this).attr('href').split('page=')[1];
//     let url = fetch_data(page);
// });
// function fetch_data(page){
//     let url = "{{route('fetch_data')}}"+"?page="+page  ;
//     console.log(url);
//     // console.log(page);
//     // return url;
//     $.ajax({
//         type:"POST",
//         url:url,
//         data:{
//             slug_post:"{{$page['slug_post']}}"
//         },
//         success:function(res){
//             // console.log(data);
//             var data = res.ls_assess;
//             var htmlchange = '';
//             for(var i = 0 ; i< data.length ; i++ ){
//                 // $datetime = \App\Ultility\Ultility::getdateFacebook($ls->created_at);
//                     $htmlchange +=  '<li>'
//                                         +'<p>'
//                                             +'<span class="rating-name">'+data[i].user_name+'</span>'+ ' |'
//                                         +'</p>'
//                                         +'com_eye<p class="align-center-style">'
//                                             +'<span class="user-detail-rating " data-rating="'+data[i].number_star+'"></span>'
//                                             +'<span class="mg-detail-review">'+data[i].content+'</span>'
//                                         +'</p>'
//                                     +'</li>';
//             }

//             // return     $htmlchange   ;  
//             console.log(htmlchange); 
//             $('.danhgialist').html(htmlchange);
//         }

//     });
// }
$('.send_comment').click(function() {
    if ($.trim($('#content').val()).length === 0) {
        // alert("Đã vào");
        $('.note_text_content').hide();
        $('.error_text_content').html('<i class="error"><span class="error_reg_mess_icon">Vui lòng nhập câu hỏi</span></i>');
        $('.error_reg_mess_icon').css("color", "#ff0000");
        $('.error_border_content').css("cssText", "border: 1px solid #ff0000  !important;");
        $('#myModal').hide();
    } else {
        $('#myModal').modal('show');

    }
});

$('.avgStar').starRating({
    totalStars: 5,
    starShape: 'rounded',
    starSize: 20,
    readOnly: true,
    emptyColor: 'lightgray',
    hoverColor: 'orange',
    activeColor: 'orange',
    useGradient: false
});
$(".user-detail-rating").starRating({
    starSize: 20,
    initialRating: 4,
    readOnly: true,
    starShape: 'rounded'
});
$(".review-rating-8").starRating({
    starSize: 30,
    totalStars: 5,
    useFullStars: true,
    disableAfterRate: false,
    starShape: 'rounded',
    activeColor: 'orange',
    ratedColor: 'orange',
    hoverColor: 'orange',

    onHover: function(currentIndex, currentRating, $el) {
        var showText = '';
        if (currentIndex == 1) {
            showText = 'Tệ';
        }
        if (currentIndex == 2) {
            showText = 'Trung bình';
        }
        if (currentIndex == 3) {
            showText = 'Khá';
        }
        if (currentIndex == 4) {
            showText = 'Tốt';
        }
        if (currentIndex == 5) {
            showText = 'Xuất sắc';
        }
        $('.live-rating').removeClass('hide');
        $('.live-rating').text(showText);

    },
    onLeave: function(currentIndex, currentRating, $el) {
        $('.live-rating').addClass('hide');
    },
    callback: function(currentIndex, $el) {
        var showText = '';
        if (currentIndex == 1) {
            showText = 'Tệ';
        }
        if (currentIndex == 2) {
            showText = 'Trung bình';
        }
        if (currentIndex == 3) {
            showText = 'Khá';
        }
        if (currentIndex == 4) {
            showText = 'Tốt';
        }
        if (currentIndex == 5) {
            showText = 'Xuất sắc';
        }
        activeRate = showText;

        $('.live-rating').removeClass('hide');
        $('.live-rating').text(showText);
        $('.form-rating').addClass('show');
        $('.live-rating').addClass('show');
        $('.form-rating').removeClass('hide');
        // console.log(currentIndex);
        $('input[name="star"]').attr('value', currentIndex);
    }
});

$('#btnrating').click(function(e) {
    e.preventDefault();
    if (
        $('#content_rating').val().length == 0
        // $('#user_name').val().length == 0 ||
        // $('#phone_assess').val().length == 0 ||
        // $('#email').val().length == 0
    ) {

        if ($('#content_rating').val().length == 0) {
            $('#content_rating').css('border', '1px solid red ');
            $('.info-error').text('Bạn chưa nhập nội dung đánh giá');
            $('.info-error').show();
        }
        // if ($('#user_name').val().length == 0) {
        //     $('#user_name').css('border', '1px solid red ');
        //     $('.user_name-info-error').text('Bạn chưa nhập họ và tên');
        //     $('.user_name-info-error').show();
        // }
        // if ($('#phone_assess').val().length == 0) {
        //     $('#phone_assess').css('border', '1px solid red ');
        //     $('.phone_assess-info-error').text('Bạn chưa nhập số điện thoại');
        //     $('.phone_assess-info-error').show();
        // }
        // if ($('#email').val().length == 0) {
        //     $('#email').css('border', '1px solid red ');
        //     $('.email-info-error').text('Bạn chưa nhập email');
        //     $('.email-info-error').show();

        // }


    } else {
        $('#formRating').submit();
    }
});