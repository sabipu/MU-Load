<div class="general__holder">
  <?php $counterAllocation = array(); ?>
  <?php $counterOffering = array(); ?>
  <?php $counterActLect = array(); ?>
  <?php $counterLect = array(); ?>
  <div class="allocate__wrapper allocate_display_container">
    <?php foreach ($allAllocations as $AA): ?>
            <div class="column">
              <div class="unit__box">
                <div class="unit__title"><?php echo $AA->unit_name; ?></div>
                <div class="teaching__period">

                  <div class="teaching__list">
                      <?php foreach ($offeringsAll as $OALL): ?>
                        <?php $check = ""; ?>
                        <?php foreach ($allAllocationsOfferings as $item): ?>
                          <?php if ($item->allocationID == $AA->allocationID): ?>
                            <?php if ($item->offerings == $OALL): ?>
                              <?php $check = "checked='checked'"; break;?>
                            <?php endif ?>  
                          <?php endif ?>
                        <?php endforeach ?>
                          <li>
                            <label class="custom-check">
                                <input type="checkbox" <?php echo $check; ?> disabled >
                                <span class="custom-input"></span>
                                <span class="custom-label"><?php echo $OALL ?></span>
                              </label>
                          </li>
                      <?php endforeach ?>
                  </div>
                </div>

                <div class="unit__activities">
                  <ul class="acti__list">
                        <?php $counterActLect = array(); ?>
                        <?php foreach ($allActUsers as $actUsers): ?>
                          <?php if ($actUsers->allocationID == $AA->allocationID): ?>

                            <?php if (!in_array($actUsers->title, $counterActLect)): ?>
                              <?php array_push($counterActLect, $actUsers->title); ?> 
                              <?php $activityName = $actUsers->title; ?>
                            <?php else: ?>
                              <?php $activityName = ""; ?>
                            <?php endif ?>
                            <li>
                              <div class="row">
                                <div class="col-xs-6">
                                  <span class="activity__title"><?php echo $activityName;?></span>
                                </div>
                                <div class="col-xs-6">
                                      <div class="lecturer__wrapper">
                                        <span class="lect__text"><?= $actUsers->name; ?></span>
                                        <?php if($actUsers->user_id != '1'): ?>
                                          <span class="hr_count"><?= $actUsers->remaining_hour; ?></span>
                                        <?php endif; ?>
                                      </div>  
                                </div>
                              </div> 
                           </li>
                          <?php endif ?>
                        <?php endforeach ?>
                  </ul>
                  <a href="<?php echo base_url('allocate-edit/'.$year."/".$AA->allocationID); ?>" class="add-btn">Edit Allocation</a>
                </div>
              </div>
            </div>
    <?php endforeach ?>
  </div>
  <div class="control__wrapper">
    <a href="<?php echo base_url('allocate-add/'.$year); ?>" class="button">Add allocation</a>
  </div>
</div>