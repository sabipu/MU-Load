<div class="general__holder">
  <header class="heading__wrapper">
    <a href="#" class="button add_setting">Add Global Setting</a>
    <h1>Manage Global Settings</h1>
  </header>
  <table class="data__table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Value</th>
        <th>Year</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($settings as $setting) :?>
        <tr class="data_holder" data-settingid="<?= $setting->settings_id ?>">
          <td>
            <div class="editable__block settings_title">
              <input class="setting_title" type="text" value="<?= $setting->title ?>">
            </div>
          </td>
          <td>
            <div class="editable__block">
              <input class="setting_value" type="text" value="<?= $setting->value ?>">
            </div>
          </td>
          <td class="text-left">
            <div class="editable__block">
              <input class="setting_additional" type="text" value="<?= $setting->additional ?>">
            </div>
          </td>
          <td>&nbsp;</td>
          <td>
            <a href="#" class="button button-small button-nobg update-obj" data-type="settings" data-url="<?= site_url('settings/updateSettings') ?>">Update</a>
            <a href="#" class="button button-small edit-obj">Edit</a>
            <a href="#" class="button button-small cancel-obj">Cancel</a>
          </td>
        </tr>
      <?php endforeach; ?>
      <tr class="data_holder hidden-onclick">
        <td>
          <div class="editable__block settings_title">
            <input class="setting_title" type="text" placeholder="Enter main title">
          </div>
        </td>
        <td>
          <div class="editable__block">
            <input class="setting_value" type="text" placeholder="Please type in value">
          </div>
        </td>
        <td class="text-left">
          <div class="editable__block">
            <input class="setting_additional" type="text" placeholder="Casual budget year if applicable">
          </div>
        </td>
        <td>
          <label class="custom-check is_casual">
            <input type="checkbox" name="casual_budget" class="casual_budget">
            <span class="custom-input"></span>
            <span class="custom-label">Casual budget</span>
          </label>
        </td>
        <td>
          <a href="#" class="button button-small button-nobg update-obj" data-type="settings" data-url="<?= site_url('settings/addSettings') ?>">Add</a>
          <a href="#" class="button button-small edit-obj">Edit</a>
          <a href="#" class="button button-small cancel-obj">Cancel</a>
        </td>
      </tr>
    </tbody>
  </table>
  <!-- <form method="post" class="register__form general__form" action="<?php echo site_url('unit/add') ?>">
    <div class="row">
      <div class="col-sm-6">
        <div class="form_group">
          <input class="form_control" type="text" name="unit_name" placeholder="Unit name">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form_group">
          <input class="form_control" type="text" name="unit_code" placeholder="Unit Code">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="form_group">
          <input class="form_control" type="text" name="unit_activities" placeholder="Activities">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form_group">
          <select name="user_role" class="form_control custom-select">
            <option value="" selected disabled hidden>Choose academic session</option>
            <option value="semester">Semester</option>
            <option value="trimester">Trimester</option>
            <option value="both">Both</option>
          </select>
        </div>
      </div>
    </div>
    <div class="submit_wrapper">
      <input class="button" type="submit" value="Register">
    </div>
  </form> -->
</div>