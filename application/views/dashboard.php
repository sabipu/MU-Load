<div class="general__holder">
  <header class="heading__wrapper">
    <a href="<?php echo base_url('allocation'); ?>" class="button">Create allocation</a>
    <h1>Hi, Hamid.</h1>
    <p>Here is what's happening.</p>
  </header>
  <div class="four__columns">
    <div class="column">
      <div class="dash__box">
        <span class="title">Activities</span>
        <div class="value">
          <?= file_get_contents(base_url() . 'assets/svg/activity.svg') ?>
          <span class="num"><?php echo $activities; ?></span>
        </div>
      </div>
    </div>
    <div class="column">
      <div class="dash__box">
        <span class="title">Staff</span>
        <div class="value">
          <?= file_get_contents(base_url() . 'assets/svg/staff.svg') ?>
          <span class="num"><?php echo $staffs; ?></span>
        </div>
      </div>
    </div>
    <div class="column">
      <div class="dash__box">
        <span class="title">Units</span>
        <div class="value">
          <?= file_get_contents(base_url() . 'assets/svg/units.svg') ?>
          <span class="num"><?php echo $totalUnits; ?></span>
        </div>
      </div>
    </div>
    <div class="column">
      <div class="dash__box">
        <span class="title">Last Allocation</span>
        <div class="value">
          <?= file_get_contents(base_url() . 'assets/svg/allocation.svg') ?>
          <span class="num">2019</span>
        </div>
      </div>
    </div>
  </div>
  <div class="reporting_columns dash__columns">
    <div class="column">
      <div class="report-box">
        <h4>Top 5 Allocation</h4>
        <canvas id="Chart1"></canvas>
        <p><span class="color" style="background-color: rgba(63,203,226,1);"></span> Total hour &emsp; <span class="color" style="background-color: rgba(163,103,126,1)"></span> Allocated hour</p>
      </div>
    </div>
    <div class="column">
      <div class="info__box">
        <a href="<?php echo base_url('allocation/allocate/'.date("Y")); ?>">
          <span class="info">Y1</span>
          <div class="text-wrap">
            <span class="status">Allocation Done</span>
            <h3>Year <span class="count"><?= date("Y"); ?></span></h3>
          </div>
        </a>
      </div>
    </div>
    <div class="column">
      <div class="info__box previous">
        <a href="<?php echo base_url('documentation'); ?>">
          <span class="info">HP</span>
          <div class="text-wrap">
            <span class="status">Click here to read documentation.</span>
            <h3>Need Help?</h3>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
<script src="<?= base_url(); ?>assets/js/chart.js"></script>
<script>
  var barOptions_stacked = {
      tooltips: {
          enabled: false
      },
      hover :{
          animationDuration:0
      },
      scales: {
          xAxes: [{
              ticks: {
                  beginAtZero:true,
                  fontFamily: "'Open Sans Bold', sans-serif",
                  fontSize:11
              },
              scaleLabel:{
                  display:false
              },
              gridLines: {
              }, 
              stacked: true
          }],
          yAxes: [{
              gridLines: {
                  display:false,
                  color: "#fff",
                  zeroLineColor: "#fff",
                  zeroLineWidth: 0
              },
              ticks: {
                  fontFamily: "'Open Sans Bold', sans-serif",
                  fontSize:11
              },
              stacked: true
          }]
      },
      legend:{
          display:false
      },
      
      animation: {
          onComplete: function () {
              var chartInstance = this.chart;
              var ctx = chartInstance.ctx;
              ctx.textAlign = "left";
              ctx.font = "9px Open Sans";
              ctx.fillStyle = "#fff";

              Chart.helpers.each(this.data.datasets.forEach(function (dataset, i) {
                  var meta = chartInstance.controller.getDatasetMeta(i);
                  Chart.helpers.each(meta.data.forEach(function (bar, index) {
                      data = dataset.data[index];
                      if(i==0){
                          ctx.fillText(data, 50, bar._model.y+4);
                      } else {
                          ctx.fillText(data, bar._model.x-25, bar._model.y+4);
                      }
                  }),this)
              }),this);
          }
      },
      pointLabelFontFamily : "Quadon Extra Bold",
      scaleFontFamily : "Quadon Extra Bold",
  };

  var ctx = document.getElementById("Chart1");
  var myChart = new Chart(ctx, {
      type: 'horizontalBar',
      data: {
          labels: <?php echo $t5Users; ?>,
          datasets: [{
              data: <?php echo $t5AllocatedHours; ?>,
              backgroundColor: "rgba(163,103,126,1)",
              hoverBackgroundColor: "rgba(140,85,100,1)"
          },{
              data: <?php echo $t5TotalHours; ?>,
              backgroundColor: "rgba(63,203,226,1)",
              hoverBackgroundColor: "rgba(46,185,235,1)"
          }]
      },

      options: barOptions_stacked,
  });
</script>