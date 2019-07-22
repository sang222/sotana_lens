<?php /*
Template Name: Dang nhap
*/ ?>
<?php get_header() ?>
<!--<form id="login" action="login" method="post">-->
<!--    <h1>Site Login</h1>-->
<!--    <p class="status"></p>-->
<!--    <label for="username">Username</label>-->
<!--    <input id="username" type="text" name="username">-->
<!--    <label for="password">Password</label>-->
<!--    <input id="password" type="password" name="password">-->
<!--    <a class="lost" href="--><?php //echo wp_lostpassword_url(); ?><!--">Lost your password?</a>-->
<!--    <input class="submit_button" type="submit" value="Login" name="submit">-->
<!--    <a class="close" href="">(close)</a>-->
<!--    --><?php //wp_nonce_field('ajax-login-nonce', 'security'); ?>
<!--</form>-->
<?php


//Create a file ajax-login-script.js within theme's directory and paste this js
?>

<div class="form">
    <div class="form-toggle"></div>
    <div class="form-panel one">
        <div class="form-header">
            <h1>Account Login</h1>
        </div>
        <div class="form-content">
            <form id="login" action="login" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" required="required"/>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required="required"/>
                </div>
                <div class="form-group">
                    <label class="form-remember">
                        <input type="checkbox"/>Remember Me
                    </label><a class="form-recovery" href="<?php echo wp_lostpassword_url(); ?>">Forgot Password?</a>
                </div>
                <div class="form-group">
                    <button type="submit" class="submit_button">Log In</button>
                </div>
                <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
            </form>
            <script>
                // This is called with the results from from FB.getLoginStatus().
                function statusChangeCallback(response) {
                    console.log('statusChangeCallback');
                    console.log(response);
                    // The response object is returned with a status field that lets the
                    // app know the current login status of the person.
                    // Full docs on the response object can be found in the documentation
                    // for FB.getLoginStatus().
                    if (response.status === 'connected') {
                        // Logged into your app and Facebook.
                        testAPI();
                    } else {
                        // The person is not logged into your app or we are unable to tell.
                        document.getElementById('status').innerHTML = 'Please log ' +
                            'into this app.';
                    }
                }

                // This function is called when someone finishes with the Login
                // Button.  See the onlogin handler attached to it in the sample
                // code below.
                function checkLoginState() {
                    FB.getLoginStatus(function (response) {
                        statusChangeCallback(response);
                    });
                }

                window.fbAsyncInit = function () {
                    FB.init({
                        appId: '{your-app-id}',
                        cookie: true,  // enable cookies to allow the server to access
                                       // the session
                        xfbml: true,  // parse social plugins on this page
                        version: '{api-version}' // The Graph API version to use for the call
                    });

                    // Now that we've initialized the JavaScript SDK, we call
                    // FB.getLoginStatus().  This function gets the state of the
                    // person visiting this page and can return one of three states to
                    // the callback you provide.  They can be:
                    //
                    // 1. Logged into your app ('connected')
                    // 2. Logged into Facebook, but not your app ('not_authorized')
                    // 3. Not logged into Facebook and can't tell if they are logged into
                    //    your app or not.
                    //
                    // These three cases are handled in the callback function.

                    FB.getLoginStatus(function (response) {
                        statusChangeCallback(response);
                    });

                };

                // Load the SDK asynchronously
                (function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "https://connect.facebook.net/en_US/sdk.js";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));

                // Here we run a very simple test of the Graph API after login is
                // successful.  See statusChangeCallback() for when this call is made.
                function testAPI() {
                    console.log('Welcome!  Fetching your information.... ');
                    FB.api('/me', function (response) {
                        console.log('Successful login for: ' + response.name);
                        document.getElementById('status').innerHTML =
                            'Thanks for logging in, ' + response.name + '!';
                    });
                }
            </script>

        </div>
    </div>

    <div class="form-panel two">
        <div class="form-header">
            <h1>Register Account</h1>
        </div>
        <div class="form-content">
            <form>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required="required"/>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required="required"/>
                </div>
                <div class="form-group">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" id="cpassword" name="cpassword" required="required"/>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required="required"/>
                </div>
                <div class="form-group">
                    <button type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="pen-footer"><a href="https://www.behance.net/gallery/30478397/Login-Form-UI-Library" target="_blank"><i
                class="material-icons">arrow_backward</i>View on Behance</a><a
            href="https://github.com/andyhqtran/UI-Library/tree/master/Login%20Form" target="_blank">View on Github<i
                class="material-icons">arrow_forward</i></a></div>
<?php get_footer() ?>
<script>

</script>