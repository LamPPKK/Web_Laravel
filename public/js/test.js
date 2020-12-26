<!-- Load Facebook SDK for JavaScript -->
<
div id = "fb-root" > < /div> <
    script >
    window.fbAsyncInit = function() {
        FB.init({
            xfbml: true,
            version: 'v8.0'
        });
    };

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk')); < /script>

<!-- Your Chat Plugin code -->
<
div class = "fb-customerchat"
attribution = setup_tool
page_id = "100460761501507"
logged_in_greeting = "Chào bạn. Tôi có thể giúp đỡ gì bạn không?"
logged_out_greeting = "Chào bạn. Tôi có thể giúp đỡ gì bạn không?" >
    <
    /div>