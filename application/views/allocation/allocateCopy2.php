<div class="general__holder">
  <?php $counterAllocation = array(); ?>
  <?php $counterOffering = array(); ?>
  <?php $counterActivity = array(); ?>
  <?php $counterLect = array(); ?>
  <div class="allocate__wrapper allocate_display_container">
    <?php foreach ($allAllocations as $AA): ?>
            <div class="column">
              <div class="unit__box">
                <div class="unit__title"><?php echo $AA->unit_name; ?></div>
                <div class="teaching__period">

                  <div class="teaching__list">
                    <li>
                    <?php foreach ($allAllocations as $AAoffering): ?>
                      <?php if ($AA->allocationID == $AAoffering->allocationID): ?>
                        <?php if (!in_array($AAoffering->offerings, $counterOffering)): ?>
                          <?php array_push($counterOffering, $AAoffering->offerings) ?>  
                          <?php $offeringCheck = ""; ?>
                          <label class="custom-check">
                            <input type="checkbox" checked="checked" disabled >
                            <span class="custom-input"></span>
                            <span class="custom-label"><?php echo $AAoffering->offerings ?></span>
                          </label>  
                        <?php endif ?>
                      <?php endif ?>
                    <?php endforeach ?>
                    </li>
                  </div>
                </div>

                <div class="unit__activities">
                  <ul class="acti__list">
                      <li>
                        <?php foreach ($allAllocations as $act): ?>
                          <?php if ($act->allocationID == $AA->allocationID): ?>
                            <?php if (!in_array($act->activitiesCode, $counterActivity)): ?>
                              

                              <?php foreach ($allAllocations as $user): ?>
                                <?php if ($user->allocationID == $AA->allocationID && $act->activitiesCode == $user->activitiesCode && $act->userID == $user->userID): ?>
                                  <div class="row">
                                    <div class="col-xs-3">
                                      <span class="activity__title"><?php if(!in_array($user->activitiesCode, $counterActivity)){ echo $act->activitiesCode; }; ?></span>
                                    </div>
                                    <div class="col-xs-9">
                                          <div class="lecturer__wrapper">
                                            <input type="text" class="input__control" value="<?php echo $user->name." (".$user->role.")"; ?>" readonly>
                                          </div>  
                                    </div>
                                  </div> 
                                <?php endif ?>
                              <?php endforeach ?>
                              <?php array_push($counterActivity, $act->activitiesCode); ?> 
                            <?php endif ?>
                          <?php endif ?>
                        <?php endforeach ?>
                      </li>
                  </ul>
                  <a href="<?php echo base_url('allocate-edit/'.$AA->allocationID); ?>" class="add-btn">Edit Allocation</a>
                </div>
              </div>
            </div>
    <?php endforeach ?>
  </div>
  <div class="control__wrapper">
    <a href="<?php echo base_url('allocate-add/'.$year); ?>" class="button">Add allocation</a>
  </div>
</div>
