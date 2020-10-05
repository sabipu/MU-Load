<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Teaching Load Allocation - Murdoch University</title>
  <!-- Stylesheets (<?= isset($stylesheets) ? count($stylesheets) : '0' ?>) -->
  <?php if(isset($stylesheets)) : foreach($stylesheets as $stylesheet) : ?>
  <link type="text/css" rel="stylesheet" href="<?= $stylesheet ?>" media="screen" />
  <?php endforeach; endif; ?>
  <!-- endstylesheet -->
  <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>assets/css/login.min.css" media="screen" />
</head>
<body>
  <div id="wrapper">
    <div class="login__container">
      <header class="login__header">
        <div class="logo">
          <a href="/">
            <img src="<?= base_url() ?>assets/images/logo.png" alt="MU Load">
          </a>
        </div>
      </header>
      <div class="form__container">
        <div class="form__wrapper">
          <div class="login__wrapper">
            <form method="post" class="form-validation" action="<?php echo site_url('login/verify') ?>">
              <h2>Sign in, <mark>here</mark>.</h2>
              <div class="form_group">
                <input type="text" name="username" class="form_control" placeholder="Email address" required="required">
              </div>
              <div class="form_group">
                <input type="password" name="password" class="form_control" placeholder="Password" required="required">
              </div>
              <div class="submit_wrapper">
                <input type="submit" value="Login" class="button">
                <a href="#" class="button button-nobg submit_link forgot_password">Forgot Password</a>
              </div>
            </form>
          </div>
          <div class="recover__wrapper">
            <form action="<?php echo site_url('forgot') ?>" method="post">
              <h2><mark>Reset</mark> password.</h2>
              <div class="form_group">
                <input type="email" name="recover_email" class="form_control" placeholder="Your email">
              </div>
              <div class="submit_wrapper">
                <input type="submit" value="Recover Now" class="button">
                <a href="#" class="button button-nobg submit_link forgot_password">Back to Login</a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="login_art">
        <img src="<?= base_url() ?>assets/images/art.png" alt="MU Load">
      </div>
      <footer class="login__footer">
        <div class="footer__logo">
          <img src="<?= base_url() ?>assets/images/murdoch-logo.png" alt="Murdoch University">
        </div>
        <strong class="copyright">&copy; All rights reserved by <a href="">Murdoch</a>. Built with <?= file_get_contents(base_url() . 'assets/svg/heart.svg') ?> by <a href="#">Team Bright</a>.</strong>
      </footer>
    </div>
  </div>
  <!-- <div class="login">
    <h1>Admin Login</h1>
    <form method="post" class="form-validation" action="<?php echo site_url('login/verify') ?>">
      <input type="text" name="username" placeholder="Username" required="required">
      <input type="password" name="password" placeholder="Password" required="required">
      <input type="submit" value="Submit">
    </form>
    <h1>Forgot Password</h1>
    <form action="/forgot" method="post">
      <input type="email" name="recover_email" placeholder="Your email">
      <input type="submit" value="Recover now">
    </form>
  </div> -->
  <script src="<?= base_url(); ?>assets/js/main.js" defer></script>
</body>
</html>



