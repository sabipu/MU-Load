<div class="general__holder">
  <header class="heading__wrapper">
    <h1>Staffs Report - <?php echo $year; ?></h1>
    <!-- <p>Manage units and activities associated with units.</p> -->
  </header>
  <table class="data__table">
    <thead>
      <tr>
        <th>Sn.</th>
        <th>Full Name</th>
        <th>Role</th>
        <th>Offering</th>
        <th>Unit Code</th>
        <th>Unit Name</th>
        <th>Activity</th>
        <th>WorkLoad Allocated</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($allUsers as $key => $AU): ?>
        <tr>
          <td><?php echo $key+1; ?></td>
          <td>
            <div class="formula__title"><?php echo $AU->name; ?></div>
          </td>
          <td>
            <div class="formula__title"><?php echo $AU->role; ?></div>
          </td>
          <?php 
            $offerings = array();
            $unitCodes = array();
            $unitNames = array();
            $activities = array();
            $workLoad = array();
           ?>
          <?php foreach ($allActUsers as $AAU): ?>
            <?php if ($AAU->userID == $AU->user_id): ?>
              <?php $offeringContainer = ""; ?>

              <?php foreach ($allAllocationsOfferings as $AAO): ?>
                <?php if ($AAO->allocationID == $AAU->allocationID && $AAO->userID == $AAU->userID && $AAO->activitiesID == $AAU->activitiesID): ?>
                    <?php $offeringContainer .= $AAO->offerings  . "," ?>
                <?php endif ?>
              <?php endforeach ?>

              <?php 
                if ($offeringContainer != "") {
                  $offeringContainer = substr($offeringContainer, 0,-1);
                }
                array_push($offerings, $offeringContainer);
                array_push($unitCodes, $AAU->unit_code);
                array_push($unitNames, $AAU->unit_name);
                array_push($activities, $AAU->title);
                array_push($workLoad, $AAU->workLoad);
               ?>
            <?php endif ?>
          <?php endforeach ?>
  
          <td>
            <?php foreach ($offerings as $offering): ?>
              <div class="formula__title"><?php echo $offering; ?></div>
            <?php endforeach ?>
          </td>
          <td>
            <?php foreach ($unitCodes as $unitCode): ?>
              <div class="formula__title"><?php echo $unitCode; ?></div>
            <?php endforeach ?>
          </td>
          <td>
            <?php foreach ($unitNames as $unitName): ?>
              <div class="formula__title"><?php echo $unitName; ?></div>
            <?php endforeach ?>
          </td>
          <td>
            <?php foreach ($activities as $key => $activity): ?>
              <div class="formula__title"><?php echo $activity . " (".$workLoad[$key].")hrs" ; ?></div>
            <?php endforeach ?>
          </td>


          <td>
            <div class="formula__title">
              <?php 
                try {
                  $workAllocatedhrs = $AU->allocated_hour - $AU->remaining_hour;
                  $workAllocatedPercentage = (($workAllocatedhrs / $AU->allocated_hour) * 100);
                  $workAllocatedPercentage = round($workAllocatedPercentage, 2);
                  $workAllocatedPercentage = $workAllocatedPercentage + 0 ;
                  $workAllocated = $workAllocatedhrs. " hrs - ".$workAllocatedPercentage."%";
                } catch (Exception $e) {
                  $workAllocated = "N/A";  
                }
               ?>
              <?php echo $workAllocated; ?>
            </div>  
          </td>
        </tr>  
        <?php endforeach ?>
    </tbody>
  </table>
</div>