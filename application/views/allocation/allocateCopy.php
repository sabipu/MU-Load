<div class="general__holder">
  <!-- <header class="heading__wrapper">
    <div class="current_year">Year: <?= $_GET["r"] ?></div>
  </header> -->
  <div class="allocate__wrapper allocate_display_container">
    <?php foreach ($allocations as $allocate): ?>
      <?php $courseType = explode(",", $allocate->courseType); ?>
      <div class="column">
        <div class="unit__box">
          <div class="unit__title"><?php echo $allocate->unit_code. " - ". $allocate->unit_name; ?></div>
          <div class="teaching__period">
            <div class="teaching__list">
              <li>
                <label class="custom-check">
                  <input type="checkbox" <?php if(in_array("S1", $courseType)){ echo "checked='checked'" ;} ?> disabled >
                  <span class="custom-input"></span>
                  <span class="custom-label">S1</span>
                </label>
              </li>
              <li>
                <label class="custom-check">
                  <input type="checkbox" <?php if(in_array("S2", $courseType)){ echo "checked='checked'" ;} ?> disabled >
                  <span class="custom-input"></span>
                  <span class="custom-label">S2</span>
                </label>
              </li>
            </div>
            <div class="teaching__list">
              <li>
                <label class="custom-check">
                  <input type="checkbox"<?php if(in_array("TJA", $courseType)){ echo "checked='checked'" ;} ?> disabled >
                  <span class="custom-input"></span>
                  <span class="custom-label">TJA</span>
                </label>
              </li>
              <li>
                <label class="custom-check">
                  <input type="checkbox"<?php if(in_array("TMA", $courseType)){ echo "checked='checked'" ;} ?> disabled >
                  <span class="custom-input"></span>
                  <span class="custom-label">TMA</span>
                </label>
              </li>
              <li>
                <label class="custom-check">
                  <input type="checkbox"<?php if(in_array("TSA", $courseType)){ echo "checked='checked'" ;} ?> disabled >
                  <span class="custom-input"></span>
                  <span class="custom-label">TSA</span>
                </label>
              </li>
            </div>
            <div class="teaching__list">
              <li>
                <label class="custom-check">
                  <input type="checkbox"<?php if(in_array("TJD", $courseType)){ echo "checked='checked'" ;} ?> disabled >
                  <span class="custom-input"></span>
                  <span class="custom-label">TJD</span>
                </label>
              </li>
              <li>
                <label class="custom-check">
                  <input type="checkbox"<?php if(in_array("TMD", $courseType)){ echo "checked='checked'" ;} ?> disabled >
                  <span class="custom-input"></span>
                  <span class="custom-label">TMD</span>
                </label>
              </li>
              <li>
                <label class="custom-check">
                  <input type="checkbox"<?php if(in_array("TSD", $courseType)){ echo "checked='checked'" ;} ?> disabled >
                  <span class="custom-input"></span>
                  <span class="custom-label">TSD</span>
                </label>
              </li>
            </div>
          </div>
          <div class="unit__activities">
            <ul class="acti__list">
              <?php $activities = explode(",", $allocate->activities); ?>
              <?php $allocatedLect = explode(",", $allocate->lecturers); ?>
              <?php foreach ($activities as $key => $item): ?>
                <li>
                  <!-- <a href="#" class="close"><?= file_get_contents(base_url() . 'assets/svg/close.svg') ?></a> -->
                  <div class="row">
                    <div class="col-xs-3">
                      <span class="activity__title"><?php echo $item; ?></span>
                    </div>
                    <div class="col-xs-9">
                      <?php $lectName = ""; ?>
                      <?php foreach ($lecturers as $lect): ?>
                        <?php if ($lect->user_id == $allocatedLect[$key]): ?>
                          <?php $lectName = $lect->name; ?>
                        <?php endif ?>
                      <?php endforeach ?>
                      <div class="lecturer__wrapper">
                        <!-- <span class="hr_count"><?php echo $lectName; ?></span> -->
                        <input type="text" class="input__control" value="<?php echo $lectName; ?>" readonly>
                      </div>
                    </div>
                  </div>
                </li>
              <?php endforeach ?>
            </ul>
            <a href="<?php echo base_url('allocate-edit/'.$allocate->allocationID); ?>" class="add-btn">Edit Allocation</a>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
  <!-- <div class="allocate__wrapper">
    <div class="column">
      <div class="add__button">
          <div class="add__buttonwrap">
            <a href="<?php echo base_url('allocate-add'); ?>"><span>+ <span class="txt">Add unit</span></span></a>
          </div>
      </div>
    </div>
  </div> -->
  <div class="control__wrapper">
    <!-- <label class="custom-check">
      <input type="checkbox" id="apply-changes">
      <span class="custom-input"></span>
      <span class="custom-label">Apply all changes.</span>
    </label> -->
    <a href="<?php echo base_url('allocate-add/'.$year); ?>" class="button">Add allocation</a>
  </div>
</div>
