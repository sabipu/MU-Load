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
    <a href="<?= site_url('metrics') ?>" class="button">View all metrics</a>
    <h1>Manage Activities</h1>
    <p>Allocate Acitivites to metrics for teaching hour calculations.</p>
  </header>
  <form  class="register__form general__form form-validation" action="<?php echo base_url('activitiescreate') ?>" method="post">
    <div class="row">
      <div class="col-sm-6">
        <div class="form_group">
          <input class="form_control" type="text" name="title" placeholder="Activity Title" required="required">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form_group">
          <select name="metrics" class="form_control custom-select">
            <option value="" selected="s" disabled="">Select a metric</option>
            <?php foreach ($metrics as $metric): ?>
              <option value="<?php echo $metric->met_id; ?>"><?php echo $metric->metrics_code ."-".$metric->metrics_title; ?></option>    
            <?php endforeach ?> 
          </select>
        </div>
      </div>
    </div>
    <div class="submit_wrapper">
      <input class="button" type="submit" value="Add new Activity">
    </div>
  </form>
  <?php if ($activities == "" || empty($activities)): ?>
    <div class="no-data">
      <h3>Sorry, no activities available.</h3>
      <p>Please use the above form to associate activity with metrics.</p>
    </div>
  <?php else: ?>
    <div class="pt-20">
      <table class="data__table">
        <thead>
          <tr>
            <th>&nbsp;</th>
            <th>Activities Title</th>
            <th>Metrics</th>
            <th>Hours</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($activities as $activity): ?>
            <tr>
              <td>
                <div class="user_profile" style="background-color: #<?= random_color(); ?>"><?= substr(trim($activity->title), 0 , 2) ?></div>
              </td>
              <td><?php echo $activity->title; ?></td>
              <?php foreach ($metrics as $metric): ?>
                <?php if ($metric->met_id == $activity->metricsID): ?>
                  <td><?= $metric->metrics_title; ?></td>
                  <td><?= $metric->formula_or_value_output; ?></td>
                <?php endif ?>
              <?php endforeach; ?>
              <td>
                <a class="button button-nobg button-small" href="<?php echo base_url('activitiesedit/'.$activity->activitiesID); ?>">Edit</a>
                <a class="button button-small" href="<?php echo base_url('activitiesdelete/'.$activity->activitiesID); ?>" onclick="return confirm('Are you sure?');">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>