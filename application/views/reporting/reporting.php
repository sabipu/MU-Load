<div class="reporting_columns">
  <div class="column">
    <div class="report-box">
      <h3>Casual budget status</h3>
      <canvas id="oilChart" width="300" height="200"></canvas>
      <a href="<?php echo base_url('reporting/budgets/'.$year) ?>" class="button">View all budget</a>
    </div>
    
   
  </div>
  <div class="column">
    <div class="report-box box--half">
      <h3>Staffs</h3>
      <div class="units__wrapper">
        <span class="title">Total Staffs</span>
        <span class="value"><?php echo $staffs; ?></span>
      </div>
      <a href="<?php echo base_url('reporting/staffs/'.$year) ?>" class="button">View all staffs</a>
    </div>
    <div class="report-box box--half">
      <h3>Units</h3>
      <div class="units__wrapper">
        <span class="title">Total Units</span>
        <span class="value"><?php echo $totalUnits; ?></span>
      </div>
      <a href="<?php echo base_url('reporting/units/'.$year) ?>" class="button">View all units</a>
    </div>
  </div>
  <div class="column">
    <div class="report-box box--half">
      <h3>Allocation Summary</h3>
      <div class="units__wrapper">
        <span class="title">Year</span>
        <span class="value"><?php echo $year; ?></span>
      </div>
      <h4>Total hours allocated: <br><?php echo $yearlyHours; ?> hrs.</h4>
      <!-- Budget : <?php echo $budgets['currentYear'][1]; ?> % Remaining<br> -->
      <a href="<?php echo base_url('reporting/allocations/'.$year) ?>" class="button">View <?php echo $year; ?> allocation</a>
    </div>
  </div>
</div>
<script src="<?= base_url(); ?>assets/js/chart.js"></script>
<script>
  var oilCanvas = document.getElementById("oilChart");
  Chart.defaults.global.defaultFontFamily = "Montserrat";
  Chart.defaults.global.defaultFontSize = 15;
  var totalBudget = <?php echo $budgets['currentYear'][0]; ?>;
  var casualUsed = <?php echo $budgets['currentYear'][1]; ?>;
  var oilData = {
      labels: [
          "Total budget",
          "Spent so far"
      ],
      datasets: [
          {
              data: [totalBudget, casualUsed],
              backgroundColor: [
                  "#a7e0bd",
                  "#e4776e"
              ]
          }]
  };

  var pieChart = new Chart(oilCanvas, {
    type: 'pie',
    data: oilData
  });
</script>