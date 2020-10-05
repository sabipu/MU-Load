<div class="general__holder">
  <header class="heading__wrapper">
    <h1>Budgets Report - <?php echo $year; ?></h1>
    <!-- Casual staffs: <?php echo $casualCount;?> <br>  -->
    <h5>Budget remaining : <?php echo $casualBudgetPercentage . "%"; ?></h5>
  </header>
  
  <table class="data__table">
    <thead>
      <tr>
        <th>SN.</th>
        <th>Unit Code</th>
        <th>Unit Name</th>
        <th>Activities</th>
        <th>Hours</th>
        <th>Cost</th>
        <th>Staff</th>
      </tr>
    </thead>
    <tbody>
      <?php $totalCostUsage=0; ?>
      <?php $counter = 0; $counterHrs = 0; ?>
      <?php foreach ($allActUsers as $key => $AAU): ?>
        <?php $counter++; ?>
        <?php $counterHrs = $counterHrs + $AAU->workLoad; ?>
        <tr>
          <td><?php echo $counter; ?></td>
          <td><?php echo $AAU->unit_code;?></td>
          <td><?php echo $AAU->unit_name; ?></td>
          <td><?php echo $AAU->title; ?></td>
          <td><?php echo $AAU->workLoad." hrs"; ?></td>
          <td><?php echo "$".$casualBudgetRate * $AAU->workLoad; ?></td>
          <td><?php echo $AAU->name; ?></td>
        </tr>
      <?php endforeach ?>
      <tr>
        <td>Total allocation:</td>
        <td colspan="2"><?php echo $counter; ?></td>
        <td>Total Hours: </td>
        <td><?php echo $counterHrs." hrs"; ?></td>
        <td>Total cost usage:</td>
        <td>$<?php echo $totalCasualCost; ?></td>
      </tr>
    </tbody>
  </table>
</div>