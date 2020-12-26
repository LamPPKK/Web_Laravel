$('.cancelled__order__item').click(function(e) {
        e.preventDefault();
        let href = $(this).parent().attr('href');
        console.log(href);
        Swal.fire({
            title: 'Bạn có muốn hủy đơn hàng này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không'
        }).then((result) => {
            window.location.href = href;
        })
    }

);
$('.buy__again').click(function() {
        Swal.fire({
            title: 'Bạn có muốn mua lại đơn hàng này?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Thành công', 'Bạn đã mua lại đơn hàng thành công', 'success')
                Window.location.href = 'D:/Code%20Private/Html/BaiTap1/html/Client/order.html'
            }
        })
    }

);