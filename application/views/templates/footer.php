  <div class="popup__wrapper">
    <div class="popup__container">
      <a href="#" class="popup__close js-popup__close"><?= file_get_contents(base_url() . 'assets/svg/close.svg') ?></a>
      <div class="popup__hold">
        <form method="post" class="register__form general__form popup__box" action="<?php echo site_url('register/add') ?>">
          <div class="row">
            <div class="col-sm-6">
              <div class="form_group">
                <input class="form_control" type="text" name="fname" placeholder="First Name">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form_group">
                <input class="form_control" type="text" name="mname" placeholder="Middle Name">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form_group">
                <input class="form_control" type="text" name="lname" placeholder="Last Name">
              </div>
            </div>
            <div class="col-sm-6">
              <select name="user_role" class="form_control custom-select">
                <option value="" selected disabled hidden>Choose academic role</option>
                <option value="academic">Academic Staff</option>
                <option value="casual">Casual Staff</option>
                <option value="staff">Staff</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-7">
              <div class="form_group">
                <input class="form_control" type="email" name="email" placeholder="Email address">
              </div>
            </div>
            <div class="col-sm-5">
              <div class="form_group">
                <div class="form_contain">
                  <input class="form_control" type="text" name="hours" placeholder="Allocation">
                  <span class="fixed-content">%</span>
                </div>
              </div>
            </div>
          </div>
          <div class="form_group pt-20">
            <label class="custom-check">
              <input type="checkbox">
              <span class="custom-input"></span>
              <span class="custom-label">Create profile and email login details to staff.</span>
            </label>
          </div>
          <div class="submit_wrapper">
            <input class="button" type="submit" value="Register">
          </div>
        </form>
        <div class="warning__box popup__box">
          <div class="warning__wrap">
            <h4>Delete</h4>
            <p>Are you sure you want to delete?</p>
          </div>
          <div class="warning__meta">
            <a href="#" class="button button-nobg js-popup__close">Cancel</a>
            <a href="#" class="button confirm-delete">Delete</a>
          </div>
        </div>
        <div class="confirm__box popup__box">
          <div class="warning__wrap">
            <h4>Action</h4>
            <p>Are you sure you want to action?</p>
          </div>
          <div class="warning__meta">
            <a href="#" class="button button-nobg js-popup__close">Cancel</a>
            <a href="#" class="button confirm-action">Yes</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= base_url(); ?>assets/js/main.js" defer async></script>
</body>
</html>
