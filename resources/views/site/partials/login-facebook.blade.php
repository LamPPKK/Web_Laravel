
<script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '{your-app-id}',
        cookie     : true,
        xfbml      : true,
        version    : '{api-version}'
      });
        
      FB.AppEvents.logPageView();   
        
    };
  
    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "https://connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
  </script>
  {{-- Facebook SDK dành cho JavaScript không có bất kỳ tệp độc lập nào cần tải xuống hay cài đặt, thay vào đó, bạn chỉ cần đưa một đoạn ngắn của JavaScript thông thường vào HTML sẽ tải không đồng bộ SDK vào các trang của bạn. Tải không đồng bộ nghĩa là không chặn tải các phần tử khác của trang.
  Đoạn mã sau sẽ cung cấp phiên bản Facebook SDK dành cho JavaScript cơ bản có các tùy chọn được đặt thành tùy chọn mặc định phổ biến nhất. Hãy chèn đoạn mã sau vào ngay sau thẻ <body> mở trên mỗi trang bạn muốn sử dụng Phân tích trên Facebook. Thay thế {your-app-id} bằng ID ứng dụng và {api-version} bằng phiên bản API bạn đang nhắm mục tiêu. Phiên bản hiện tại làv8.0. --}}
      
    
FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});
{{-- {
    status: 'connected',
    authResponse: {
        accessToken: '...',
        expiresIn:'...',
        signedRequest:'...',
        userID:'...'
    }
} --}}
{{-- status chỉ định trạng thái đăng nhập của người dùng ứng dụng. Trạng thái có thể là:
connected - người đó đã đăng nhập Facebook và đăng nhập ứng dụng của bạn.
not_authorized - người đó đã đăng nhập Facebook nhưng không đăng nhập ứng dụng của bạn.
unknown - người đó không đăng nhập Facebook nên bạn không biết họ có đăng nhập ứng dụng của mình không hoặc FB.logout() đã được gọi trước đó và do vậy, không thể kết nối với Facebook.
Có authResponse nếu trạng thái là connected và bao gồm các yếu tố sau:
accessToken - bao gồm một mã truy cập cho người dùng ứng dụng.
expiresIn - cho biết thời gian UNIX khi mã hết hạn và cần được gia hạn.
signedRequest - một thông số được đánh dấu bao gồm thông tin về người dùng ứng dụng.
userID - ID của người dùng ứng dụng.
Sau khi ứng dụng biết trạng thái đăng nhập của người dùng, ứng dụng đó có thể thực hiện một trong những điều sau:
Nếu người đó đăng nhập vào Facebook và ứng dụng của bạn, hãy chuyển họ đến trải nghiệm đăng nhập của ứng dụng.
Nếu người đó không đăng nhập ứng dụng của bạn hoặc không đăng nhập Facebook, hãy nhắc họ bằng hộp thoại Đăng nhập bằng FB.login() hoặc hiển thị cho họ nút Đăng nhập. --}}

<fb:login-button 
  scope="public_profile,email"
  onlogin="checkLoginState();">
</fb:login-button>
<script>
    function checkLoginState() {
        FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
        });
    }
</script>
