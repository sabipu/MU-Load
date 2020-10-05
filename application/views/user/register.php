<div class="general__holder">
  <form method="post" id="add-user" action="<?php echo site_url('register/add') ?>">
    <header class="heading__wrapper">
      <a href="/manage-staff" class="button">Manage Staff</a>
    </header>
    <div class="general__columns">
      <div class="left__column">
        <header class="heading__wrapper">
          <h1>Register a staff member.</h1>
          <p>Please use the form below to register academic staff member or casual staff member.</p>
        </header>
        <div class="register__form general__form form-validation">
          <div class="row">
            <div class="col-sm-6">
              <div class="form_group">
                <input class="form_control" type="text" name="fname" placeholder="First Name" required="required">
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
                <input class="form_control" type="text" name="lname" placeholder="Last Name" required="required">
              </div>
            </div>
            <div class="col-sm-6">
              <select name="user_role" class="form_control custom-select" id="user_role">
                <option value="" selected disabled hidden>Choose academic role</option>
                <option value="academicstaff">Academic Staff</option>
                <option value="casualstaff">Casual Staff</option>
                <option value="parttimestaff">Parttime Staff</option>
                <option value="staff">Staff</option>
                <option value="admin">Administrator</option>
                <option value="none">None</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-8">
              <div class="form_group">
                <input class="form_control" type="email" name="email" placeholder="Email address" required="required">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form_group not_admin">
                <div class="form_option">
                  <input class="form_control" type="text" name="hours" placeholder="Teaching allocation">
                  <span class="optform_text">%</span>
                </div>
              </div>
              <div class="form_group admin_pass">
                <input class="form_control" type="password" name="password" placeholder="Create Password">
              </div>
            </div>
          </div>
          <div class="submit_wrapper">
            <input class="button" type="submit" value="Register">
          </div>
        </div>
      </div>
      <div class="right__column">
        <header class="heading__wrapper">
          <h1>Preferred Units</h1>
          <p>Please select preferred units for the new staff.</p>
        </header>
        <div class="units__list">
          <?php foreach($units as $unit): ?>
            <li>
              <label class="custom-check">
                <input type="checkbox" name="preferred[]" value="<?= $unit->unit_id ?>">
                <span class="custom-input"></span>
                <span class="custom-label"><strong><?= $unit->unit_code ?> </strong>- <?= $unit->unit_name ?></span>
              </label>
            </li>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </form>
</div>
