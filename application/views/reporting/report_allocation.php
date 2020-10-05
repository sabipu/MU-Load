<div class="general__holder">
  <header class="heading__wrapper">
    <h1>Allocations Report - <?php echo $year; ?></h1>
    <!-- <p>Manage units and activities associated with units.</p> -->
  </header>
  <table class="data__table">
    <thead>
      <tr>
        <th>Sn.</th>
        <th>Unit Code</th>
        <th>Title</th>
        <th>Offerings</th>
        <th>Activities</th>
        <th>Staffs</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($allAllocations as $key => $AA): ?>
          <tr>
            <td><?php echo $key+1; ?></td>
            <td>
              <div class="formula__title"><?php echo $AA->unit_code; ?></div>
            </td>
            <td>
              <div class="formula__title"><?php echo $AA->unit_name; ?></div>
            </td>
            <td>
              <?php foreach ($allAllocationsOfferings as $AAO): ?>
                <?php if ($AAO->allocationID == $AA->allocationID): ?>
                  <div class="formula__title">
                    <?php echo $AAO->offerings; ?>
                  </div>
                <?php endif ?>
              <?php endforeach ?>
            </td>
            <td>
              <?php foreach ($allActUsers as $AAU): ?>
                <?php if ($AAU->allocationID == $AA->allocationID): ?>
                  <div class="formula__title">
                    <?php echo $AAU->title; ?>
                  </div>    
                <?php endif ?>
              <?php endforeach ?>
              
            </td>
            <td>
              <?php foreach ($allActUsers as $AAU): ?>
                <?php if ($AAU->allocationID == $AA->allocationID): ?>
                  <div class="formula__title">
                    <?php echo $AAU->name; ?>
                  </div>    
                <?php endif ?>
              <?php endforeach ?>
            </td>
          </tr>  
        <?php endforeach ?>
    </tbody>
  </table>
</div>