<div class="general__holder">
  <div class="threecolumns">
    <div class="column">
      <h3 class="column__title">Current Allocation</h3>
      <div class="info__box ">
        <a href="<?php echo base_url("allocation/allocate/".(date("Y"))) ?>">
          <span class="info">Y1</span>
          <div class="text-wrap">
            <span class="status">Allocation Pending</span>
            <h3>Year <span class="count"><?= date("Y"); ?></span></h3>
          </div>
        </a>
      </div>
      <!-- <h1>Budget Remaining: <?php echo $budgets['currentYear'][1]; ?> %</h1> -->
    </div>
    <div class="column">
      <h3 class="column__title">Next Allocation</h3>
      <div class="info__box previous">
        <a href="<?php echo base_url("allocation/allocate/".(date("Y")+1)) ?>">
          <span class="info">Y1</span>
          <div class="text-wrap">
            <span class="status">Allocation Pending</span>
            <h3>Year <span class="count"><?= date("Y") + 1; ?></span></h3>
          </div>
        </a>
      </div>
      <!-- <h1>Budget Remaining: <?php echo $budgets['nextYear'][1]; ?> %</h1> -->
    </div>
  </div>
</div>