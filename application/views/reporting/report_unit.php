<div class="general__holder">
  <header class="heading__wrapper">
    <h1>Units Report - <?php echo $year; ?></h1>
  </header>
  <table class="data__table">
    <thead>
      <tr>
        <th>SN.</th>
        <th>Unit Code</th>
        <th>Unit Name</th>
        <th>Offerings</th>
        <th>Activities</th>
        <th>Staffs(casuals)</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($allUnits as $key => $unit): ?>
        <tr>
          <td><?php echo $key+1; ?></td>
          <td><?php echo $unit->unit_code;?></td>
          <td><?php echo $unit->unit_name; ?></td>
          <td>
            <?php $offeringContainer = ""; ?>
            <?php foreach ($allAllocationsOfferings as $AAO): ?>
              <?php if ($AAO->unit_id == $unit->unit_id): ?>
                <?php $offeringContainer .= $AAO->offerings  . "," ?>
              <?php endif ?>
            <?php endforeach ?>
            <?php 
              if ($offeringContainer != "") {
                  $offeringContainer = substr($offeringContainer, 0,-1);
                }
             ?>
             <div class="formula__title"><?php echo $offeringContainer; ?></div>
          </td>
          <td>
            <?php $activitiesContainer = array(); ?>
            <?php $lecturers = 0; ?>
            <?php $casuals = 0 ;?>
            <?php foreach ($allActUsers as $AAU): ?>
              <?php if ($AAU->unit_id == $unit->unit_id): ?>
                <?php array_push($activitiesContainer, $AAU->title . "(".$AAU->workLoad."hrs)"); ?>
                <?php if ($AAU->role != "none" && $AAU->role != "casualstaff"): ?>
                  <?php $lecturers++; ?>
                <?php else: ?>
                  <?php $casuals++; ?>
                <?php endif ?>
              <?php endif ?>
            <?php endforeach ?>
            <?php foreach ($activitiesContainer as $item): ?>
              <div class="formula__title"><?php echo $item; ?></div>
            <?php endforeach ?>
          </td>
          <td>
            <?php if ($casuals == 0): ?>
              <?php echo $lecturers; ?>
            <?php else: ?>  
              <?php echo $lecturers."(".$casuals.")"; ?>
            <?php endif ?>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>