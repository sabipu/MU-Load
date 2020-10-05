
<div class="general__holder">
  <header class="heading__wrapper">
    <a href="<?php echo base_url('metrics'); ?>" class="button">View metrics</a>
  </header>
  <form method="post" class="register__form general__form size--plus" action="<?php echo base_url('metrics/add'); ?>">
    <div class="row">
      <div class="col-sm-6">
        <div class="text-editor">
          <h3>Title of Metrics</h3>
          <textarea class="custom__texteditor" name="metrics_title"></textarea>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="text-editor">
          <h3>Notes</h3>
          <textarea class="custom__texteditor" name="metrics_notes"></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-5">
        <div class="form_group">
          <input type="text" class="form_control" name="formula_value" placeholder="Formula/value per hour">
          <span class="field_info">Example: 30 + ((k - 1) * 10)</span>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form_group">
          <input type="text" class="form_control" name="metrics_code" placeholder="Metrics Code">
        </div>
      </div>
      <div class="col-sm-5">
        <!-- <div class="form_group">
          <select name="associated_activity" class="form_control custom-select">
            <option value="" selected disabled hidden>Choose associated activity</option>
            <?php foreach ($activities as $activity): ?>
              <option value="<?php echo $activity->activitiesID ?>"><?php echo $activity->activitiesCode . " " . $activity->title; ?></option>  
            <?php endforeach ?>
            <option value="lecture">Lecture</option>
            <option value="workshop">Workshop</option>
            <option value="lab">Lab</option>
            <option value="lecture">Lecture</option>
            <option value="tuts">Tutorials</option>
          </select>
        </div> -->
      </div>
    </div>
    <div class="submit_wrapper">
      <input class="button" type="submit" value="Add new metrics">
    </div>
  </form>
</div>