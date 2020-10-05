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
    <a href="<?= site_url('activities') ?>" class="button">View all activities</a>
    <h1>Edit Activity</h1>
  </header>
  <form  class="register__form general__form form-validation" action="<?php echo base_url('activitiesupdate/'.$activity->activitiesID); ?>" method="post">
    <div class="row">
      <div class="col-sm-6">
        <div class="form_group">
          <input class="form_control" type="text" name="title" value="<?php echo $activity->title; ?>" required="required">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form_group">
          <select name="metrics" class="form_control custom-select">
            <?php foreach ($metrics as $metric): ?>
              <?php $selectionStatus = ""; ?>
              <?php if ($activity->metricsID == $metric->met_id): ?>
                <?php $selectionStatus = "selected='selected'"; ?>
              <?php endif ?>
              <option value="<?php echo $metric->met_id; ?>" <?php echo $selectionStatus; ?> ><?php echo $metric->metrics_code ."-".$metric->metrics_title; ?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
    </div>
    <div class="submit_wrapper">
      <input class="button" type="submit" value="Add new Activity">
    </div>
  </form>
</div>