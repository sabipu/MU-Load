<div class="general__holder">
  <header class="heading__wrapper">
    <!-- <a href="/unit" class="button">Manage Unit</a> -->
    <h1>Load Allocatation for a unit - <?php echo $year; ?></h1>
    <p>Please use the form below to add a new unit.</p>
  </header>
  <form method="post" class="general__form form-validation" id="form_allocation_create" action="<?= base_url('allocationcreate') ?>">
    <div class="register__form">
      <input type="hidden" name="year" value="<?php echo $year; ?>">
      <div class="row">
        <div class="col-sm-6">
          <div class="form_group">
            <select name="unitID" class="form_control custom-select" id="allocationUnitSelect" data-url="<?php echo base_url("allocate_find_Activities"); ?>" required>
              <option value="" disabled selected="">Select a unit</option>
              <?php foreach ($units as $unit): ?>
                <option value="<?php echo $unit->unit_id; ?>"><?php echo $unit->unit_code." - ".$unit->unit_name; ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="act_allowrapper">
      <select name="filter" id="allocationFilter" style="display: none;">
        <option value="PREF" selected="selected">Preference</option>
        <option value="HRS">Hours</option>
      </select>
      <table class="allocate_activity_container data__table">
      </table>
    </div>
    <span class="form_title">Tick the boxes below to select offerings</span>
    <div id="error-container-offering"></div>
    <ul class="checkbox__list" id="offering_checkboxes">
      <?php foreach ($offerings as $offering): ?>
        <li>
          <label class="custom-check">
            <input type="checkbox" name="offerings[]" value="<?php echo $offering; ?>">
            <span class="custom-input"></span>
            <span class="custom-label"><?php echo $offering; ?></span>
          </label>
        </li>
      <?php endforeach ?>
    </ul>
    <div class="submit_wrapper">
      <input class="button" type="submit" value="Add Allocation">
    </div>
  </form>
</div>