
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
    <a href="<?php echo base_url('metrics-add'); ?>" class="button">Add new metrics</a>
    <h1>Allocation Metrics</h1>
    <p>Manage units and activities associated with units.</p>
  </header>


  <table class="data__table">
    <thead>
      <tr>
        <th>Code</th>
        <th>Title</th>
        <th>Formula</th>
        <th>Variables</th>
        <th>Notes</th>
        <!-- <th>Activity</th> -->
        <th>Total Hours</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
        <?php if (is_null($metrics)) : ?>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Sorry</td>
            <td>Empty</td>
            <!-- <td></td> -->
            <td></td>
            <td></td>
          </tr>
        <?php else: ?>
          <?php foreach ($metrics as $met): ?>
            <tr data_met_id="<?php echo $met->met_id; ?>">
              <td>
                <div class="formula__code"><?php echo $met->metrics_code; ?></div>
              </td>
              <td>
                <div class="formula__title"><?php echo $met->metrics_title; ?></div>
              </td>
              <td>
                <div class="formula">
                  <?php echo $met->formula_or_value; ?>
                </div>
              </td>
              <td>
                <label class="variable__val">
                  <?php echo $met->metrics_variable; ?>
                </label>
              </td>
              <td>
                <div class="metrics__desc"><?php echo $met->metrics_note; ?></div>
              </td>
              <td>
                <div class="total_hour">
                  <?php if ($met->formula_or_value_output == ""): ?>
                      <span class="formula__title">Error!</span>
                  <?php else: ?>
                    <span class="formula__title"><?php echo $met->formula_or_value_output; ?></span>
                  <?php endif ?>
                </div>
              </td>
              <td>
                <a class="button button-nobg button-small metric_edit" data-url="<?php echo base_url('metrics-edit'); ?>" data-eid="<?php echo $met->met_id ?>">Edit</a>
                <!-- <a href="<?php echo base_url('metrics-edit'); ?>" class="button button-nobg button-small" data-eid="<?php echo $met->met_id ?>">Edit</a> -->
                <a class="button button-small metric_del" data-url="<?php echo base_url('metrics-del'); ?>" data-eid="<?php echo $met->met_id ?>">Delete</a>
              </td>
            </tr>

          <?php endforeach ?>
        <?php endif ?>
        
        
    </tbody>
  </table>
</div>