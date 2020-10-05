
<?php 
function random_color_part() {
  return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
  return random_color_part() . random_color_part() . random_color_part();
}
?>
<div class="general__holder">
  <header class="heading__wrapper">
    <a href="<?= site_url('unit-add') ?>" class="button">Add new unit</a>
    <h1>Manage Units</h1>
    <p>Manage units and activities associated with units.</p>
  </header>
  <?php if(count($units) === 0): ?>
    <div class="no-data">
      <h3>Sorry, no units available.</h3>
      <p><a href="<?= site_url('unit-add') ?>">Click here</a> to add unit.</p>
    </div>
  <?php else: ?>
    <table class="data__table">
      <thead>
        <tr>
          <th>&nbsp;</th>
          <th>Unit Name</th>
          <th>Unit Id</th>
          <th>Activities</th>
          <th>Hours</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($units as $unit) : ?>
          <tr class="data_holder" data-unitid="<?= $unit->unit_id ?>">
            <td>
              <div class="user_profile" style="background-color: #<?= random_color(); ?>"><?= (int) filter_var($unit->unit_code, FILTER_SANITIZE_NUMBER_INT); ?></div>
            </td>
            <td>
              <div class="editable__block">
                <input class="unit_name" type="text" value="<?= $unit->unit_name ?>">
              </div>
            </td>
            <td>
              <div class="editable__block">
                <input  class="unit_code"  type="text" value="<?= $unit->unit_code ?>">
              </div>
            </td>
            <?php $totalUnitHour = 0; ?>
            <td>
              <div class="activity__wrapper">
                <ul class="unit_activities">
                  <?php foreach ($unitactivitiesmeta as $uaMeta): ?>
                    <?php if ($uaMeta->unitID == $unit->unit_id): ?>
                      <?php foreach ($activities_metrics_meta as $amMeta): ?>
                          <?php if ($amMeta->activitiesID == $uaMeta->activitiesID): ?>
                            <li>
                              <?php foreach ($activities as $activity): ?>
                                <?php if ($activity->activitiesID == $uaMeta->activitiesID): ?>
                                  <span class="act_title"><?= $activity->title; ?></span>
                                <?php endif ?>
                              <?php endforeach ?>
                              <span class="act_hour"><?php echo $amMeta->formula_or_value_output." hrs"; ?></span>
                              <?php $totalUnitHour = $totalUnitHour + floatval($amMeta->formula_or_value_output); ?>
                            </li>
                          <?php endif ?>
                      <?php endforeach ?>
                    <?php endif ?>
                  <?php endforeach ?>
                  <!-- <li class="addbox">
                    <div class="editable__block">
                      <a href="#" class="add-field">Add another</a>
                      <div class="box">
                        <input class="act_name" type="text" placeholder="Leave empty to not add">
                      </div>
                    </div>
                  </li> -->
                </ul>
              </div>
            </td>
            <td>
              <?= $totalUnitHour . 'hrs'; ?>
            </td>
            <td>
              <a href="#" class="button button-small button-nobg update-obj" data-type="unit" data-url="<?= site_url('unit/updateUnit') ?>" data-object="<?= $unit->unit_id ?>">Update</a>
              <a href="#" class="button button-small button-nobg edit-obj">Edit unit</a>
              <a href="#" class="button button-small delete-obj" data-type="unit" data-url="<?= site_url('unit/deleteUnit') ?>" data-object="<?= $unit->unit_id ?>">Delete unit</a>
              <a href="#" class="button button-small cancel-obj">Cancel</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>