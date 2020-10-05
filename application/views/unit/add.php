<div class="general__holder">
  <header class="heading__wrapper">
    <a href="<?php echo base_url('unit'); ?>" class="button">Manage Unit</a>
    <h1>Add a new Unit.</h1>
    <p>Please use the form below to add a new unit.</p>
  </header>
  <form method="post" class="register__form general__form form-validation" id="add-unit" action="<?= base_url('unit/add') ?>">
    <div class="row">
      <div class="col-sm-6">
        <div class="form_group">
          <input class="form_control" type="text" name="unit_name" placeholder="Unit name" required="required">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form_group">
          <input class="form_control" type="text" name="unit_code" placeholder="Unit Code" required="required">
        </div>
      </div>
    </div>
    <span class="form_title">Tick the boxes below to add activities</span>
    <ul class="checkbox__list">
      <?php foreach ($activities as $activity): ?>
        <li>
          <label class="custom-check">
            <input type="checkbox" name="activity[]" value="<?php echo $activity->activitiesID; ?>">
            <span class="custom-input"></span>
            <span class="custom-label"><?php echo $activity->title; ?></span>
          </label>
        </li>  
      <?php endforeach ?>
    </ul>
    <div class="submit_wrapper">
      <input class="button" type="submit" value="Register">
    </div>
  </form>
</div>