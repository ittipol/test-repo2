<script type="text/javascript">

    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    google.setOnLoadCallback(drawChart2);
    google.setOnLoadCallback(drawChart3);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['', 'จำนวนนักเรียน', { role: "annotation" }, { role: 'style' }],
        ['จำนวนนักเรียน',  <?php echo $total_member; ?>, "", 'green'],
      ]);

      var options = {
        title: '',
        hAxis: {title: '', titleTextStyle: {color: 'red'}},
        width: '100%',
        height: 600,
        vAxis: {textStyle: {fontSize:12, color:'#666', bold: true},
          //'title': 'จำนวนนักเรียน (คน)',
          'textPosition': 'out',
          'minValue': 0, 
          'maxValue': 3, 
          // 'format':'#%',
          'gridlines': {color: '#bbb', count: 2}},
        colors:['green'],  
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('chart'));

      chart.draw(data, options);
    }

    function drawChart2() {
      var data = google.visualization.arrayToDataTable([
        ['', 'ยังไม่ได้จ่าย', { role: "annotation" }, { role: 'style' }],
        ['ยังไม่ได้จ่าย',  <?php echo $total_invoice_not_paid; ?>, "", 'green'],
      ]);

      var options = {
        title: '',
        hAxis: {title: '', titleTextStyle: {color: 'red'}},
        width: '100%',
        height: 600,
        vAxis: {textStyle: {fontSize:12, color:'#666', bold: true},
          //'title': 'จำนวนคอร์สทั้งหมด',
          'textPosition': 'out',
          'minValue': 0, 
          'maxValue': <?php echo $total_invoice; ?>, 
          // 'format':'#%',
          'gridlines': {color: '#bbb', count: 3}},
        colors:['green'],  
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('chart2'));

      chart.draw(data, options);
    }

    function drawChart3() {
      var data = google.visualization.arrayToDataTable([
        ['', 'จ่ายแล้ว', { role: "annotation" }, { role: 'style' }],
        ['จ่ายแล้ว',  <?php echo $total_invoice_paid; ?>, "", 'green'],
      ]);

      var options = {
        title: '',
        hAxis: {title: '', titleTextStyle: {color: 'red'}},
        width: '100%',
        height: 600,
        vAxis: {textStyle: {fontSize:12, color:'#666', bold: true},
          //'title': 'จำนวนคอร์สทั้งหมด',
          'textPosition': 'out',
          'minValue': 0, 
          'maxValue': <?php echo $total_invoice; ?>, 
          // 'format':'#%',
          'gridlines': {color: '#bbb', count: 3}},
        colors:['green'],  
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('chart3'));

      chart.draw(data, options);
    }

    // function drawChart4() {
    //   var data = google.visualization.arrayToDataTable([
    //     ['', 'รายได้ทั้งหมด', { role: "annotation" }, { role: 'style' }],
    //     <?php foreach ($reports as $report) { $w = $report['month']; ?>
    //     ['<?php echo $w; ?>',  <?php echo $report['total']; ?>, "", 'green'],
    //     <?php } ?>
    //   ]);

    //   var options = {
    //     title: '',
    //     hAxis: {title: '', titleTextStyle: {color: 'red'}},
    //     width: '100%',
    //     height: 500,
    //     vAxis: {textStyle: {fontSize:12, color:'#666', bold: true},
    //       'title': 'รายได้ทั้งหมด (บาท)',
    //       'textPosition': 'out',
    //       'minValue': 0, 
    //       'maxValue': 1, 
    //       // 'format':'#%',
    //       'gridlines': {color: '#bbb', count: 6}},
    //     colors:['green'],  
    //   };

    //   var chart = new google.visualization.ColumnChart(document.getElementById('chart'));

    //   chart.draw(data, options);
    // }

</script>

<div class="chart-group clearfix">

	<!-- <div class="chart c-full" style="width:200px;">
		<h4>จำนวนนักเรียนทั้งหมด</h4>
		<div class="dashboard-content">
			<div id="chart" style="width: 100%; height: 100%;"></div>
		</div>
	</div> -->

	<!-- <div class="chart c-full" style="width:200px;">
		<h4>จำนวนทียังไม่ได้จ่าย</h4>
		<div class="dashboard-content">
			<div id="chart2" style="width: 100%; height: 100%;"></div>
		</div>
	</div>

  <div class="chart c-full" style="width:200px;">
    <h4>จำนวนที่จ่ายแล้ว</h4>
    <div class="dashboard-content">
      <div id="chart3" style="width: 100%; height: 100%;"></div>
    </div>
  </div> -->

  <?php if(Yii::app()->user->getState('is_top_admin')){ ?>

  <div class="clearfix" style="padding-top:20px; padding-bottom:20px;">
    <div style="float:left; height:80px; margin-right:20px;">
      <img src="<?php echo Yii::app()->user->getState('school_logo'); ?>" style="height:100px;" />
    </div>
    <div style="float:left;">
      <div>ระบบบจัดการข้อมูล</div>
      <div style="font-size:20px;"><?php echo Yii::app()->user->getState('school_name'); ?></div>
    </div>
  </div>

  <?php }else{ ?>

  <div class="clearfix" style="padding-top:20px; padding-bottom:20px;">
    <div>ระบบบจัดการข้อมูล</div>
    <div style="font-size:20px;">คูณเข้าระบบด้วยสิทธิ Administrator</div>
  </div>

  <?php } ?>

  <hr/>

</div>