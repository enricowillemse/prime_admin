<!DOCTYPE html>
<html><head><link href="/themes/Make/assets/global/images/favicon.png" rel="stylesheet">
<link href="/themes/Make/assets/global/css/style.css" rel="stylesheet">
<link href="/themes/Make/assets/global/css/ui.css" rel="stylesheet">
<link href="/themes/Make/assets/global/plugins/bootstrap-loading/lada.min.css" rel="stylesheet"></head><body><body class="account2" data-page="login" style="background-image:url('<?php echo $parm['background']; ?>')!important">
        <!-- BEGIN LOGIN BOX -->
        <div class="container" id="login-block" >
            <i class="user-img icons-faces-users-03"></i>
            <div class="account-info" style="background-color:<?php echo $parm['login_colour']; ?>">
                <a href="dashboard.html" class="logo" style="background-image:url('<?php echo $parm['logo']; ?>')!important"></a> 
                <h3><?php echo $parm['description']; ?>.</h3>
</div>
            <div class="account-form" >
                <form action="/session/start" method="post" class="form-signin" role="form">
                    <h3>
<strong>Sign in</strong> to your account</h3>
                    <div class="append-icon">
                        <input type="text" name="email" id="name" class="form-control form-white username" placeholder="Username" required><i class="icon-user"></i>
                    </div>
                    <div class="append-icon m-b-20">
                        <input type="password" name="password" class="form-control form-white password" placeholder="Password" required><i class="icon-lock"></i>
                    </div>
                    <button type="submit"  class="btn btn-lg btn-dark btn-rounded ladda-button" data-style="expand-left">Sign In</button>
                    <span class="forgot-password"><a id="password" href="account-forgot-password.html">Forgot password?</a></span>
                
                </form>
                <form class="form-password" role="form">
                    <h3>
<strong>Reset</strong> your password</h3>
                    <div class="append-icon m-b-20">
                        <input type="password" name="password" class="form-control form-white password" placeholder="Password" required><i class="icon-lock"></i>
                    </div>
                    <button type="submit" id="submit-password" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left">Send Password Reset Link</button>
                    <div class="clearfix m-t-60">
                        <p class="pull-left m-t-20 m-b-0"><a id="login" href="#">Have an account? Sign In</a></p>
                        <p class="pull-right m-t-20 m-b-0"><a href="user-signup2.html">New here? Sign up</a></p>
                    </div>
                </form>
            </div>
        </div>
        <!-- END LOCKSCREEN BOX -->
        <p class="account-copyright">
            <span>Copyright © 2015 </span><span>Prime Analytics</span>.<span>All rights reserved.</span>
        </p>
        </body><script src="/themes/Make/assets/global/plugins/jquery/jquery-1.11.1.min.js"></script>
<script src="/themes/Make/assets/global/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="/themes/Make/assets/global/plugins/gsap/main-gsap.min.js"></script>
<script src="/themes/Make/assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/themes/Make/assets/global/plugins/backstretch/backstretch.min.js"></script>
<script src="/themes/Make/assets/global/plugins/bootstrap-loading/lada.min.js"></script><?php echo $this->getContent(); ?></body>