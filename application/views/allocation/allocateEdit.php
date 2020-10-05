<div class="general__holder">
  <header class="heading__wrapper">
    <a href="<?php echo base_url('allocate-delete/'.$year.'/'.$thisAllocations->allocationID); ?>" class="button" onclick="return confirm('Do you wish to delete this allocation?');">Delete Allocation</a>
    <h1>Load Allocatation for a unit - <?php echo $year; ?></h1>
    <p>Please use the form below to update the allocation.</p>
  </header>
  <form method="post" class="general__form form-validation" id="form_allocation_create" action="<?= base_url('allocationupdate/'.$thisAllocations->allocationID); ?>">
    <div class="register__form">
      <input type="hidden" name="year" value="<?php echo $year; ?>">
      <div class="row">
        <div class="col-sm-6">
          <div class="form_group">
            <select name="unitID" class="form_control custom-select" id="allocationUnitSelect111" data-url="<?php echo base_url("allocate_find_Activities"); ?>">
              <option value="<?php echo $thisAllocations->unit_id; ?>" selected="selected" readonly><?php echo $thisAllocations->unit_code." - ".$thisAllocations->unit_name; ?></option>  
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="act_allowrapper">
      <select name="filter" id="allocationFilter"  style="display: none;">
        <option value="PREF" selected="selected">Preference</option>
        <option value="HRS">Hours</option>
      </select>
      <table class="allocate_activity_container data__table">
        <tr>
          <?php $counterAct = array(); ?>
          <?php foreach ($thisActUsers as $item): ?>
            <?php if (!in_array($item->activitiesID, $counterAct)): ?>
              <?php array_push($counterAct, $item->activitiesID); ?>
              <th><?php echo $item->title; ?></th>
              <input type="hidden" name="activities[]" value="<?php echo $item->activitiesID; ?>">
              <input type="hidden" name="workload[]" value="<?php echo $item->workLoad; ?>">
            <?php endif ?>
          <?php endforeach ?>
        </tr>
        <tr>
          
          <?php foreach ($counterAct as $key => $value): ?>
            <?php $counterActUser = array(); ?>
            <?php foreach ($thisActUsers as $actuser): ?>
              <?php if ($actuser->activitiesID == $value): ?>
                <?php array_push($counterActUser, $actuser->userID); ?>
              <?php endif ?>
            <?php endforeach ?>

            <td>
              <?php foreach ($allUsers as $key => $user): ?>
                  <?php if ($user->user_id != 1): ?>
                    <?php $check = ""; ?>
                    <?php if (in_array($user->user_id, $counterActUser)): ?>
                      <?php $check = "checked='checked'"; ?>
                    <?php endif ?>
                    <label class="custom-check">
                      <input type="checkbox" 
                      data-actID="<?= $value; ?>"
                      data-pref="<?= $key; ?>"
                      data-hour="<?= $user->remaining_hour; ?>" 
                      name="users<?= $value; ?>[]" 
                      value="<?= $user->user_id; ?>" <?= $check; ?>>
                      <span class="custom-input"></span>
                      <span class='custom-label'><?=$user->name; ?><em class='hours'><?=$user->remaining_hour; ?></em></span>
                    </label>
                  <?php endif ?>
              <?php endforeach ?>
            </td>
          <?php endforeach ?>
        </tr>
      </table>
    </div>
    <span class="form_title">Tick the boxes below to select course type</span>
    <div id="error-container-offering"></div>
    <ul class="checkbox__list"  id="offering_checkboxes">
      <?php foreach ($offeringsAll as $offering): ?>
        <?php $check = ""; ?>
        <?php foreach ($thisAllocationsOfferings as $item): ?>
          <?php if ($item->offerings == $offering): ?>
            <?php $check = "checked='checked'"; break; ?>
          <?php endif ?>
        <?php endforeach ?>
        <li>
          <label class="custom-check">
            <input type="checkbox" name="offerings[]" <?php echo $check; ?> value="<?php echo $offering; ?>">
            <span class="custom-input"></span>
            <span class="custom-label"><?php echo $offering; ?></span>
          </label>
        </li>
      <?php endforeach ?>
    </ul>
    <div class="submit_wrapper">
      <input class="button" type="submit" value="Update Allocation">
    </div>
  </form>
</div>