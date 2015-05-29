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

  <div>

    <h2>ค่าทางสถิติ</h2>

    <div style="float:left;">
      <!-- Graph HTML -->
      <div id="graph-wrapper">
          <div class="graph-info">
              <a href="javascript:void(0)" class="visitors">Visitors</a>
              <a href="javascript:void(0)" class="returning">Returning Visitors</a>
       
              <a href="#" class="bars"><span></span></a>
              <a href="#" class="lines active"><span></span></a>
          </div>
       
          <div class="graph-container">
              <div id="graph-lines" class="graph-lines"></div>
              <div id="graph-bars" class="graph-bars"></div>
          </div>
      </div>
      <!-- end Graph HTML -->
    </div>

    <div style="float:left; margin-left: 50px;">
      <!-- Graph HTML -->
      <div id="graph-wrapper">
          <div class="graph-info">
              <a href="javascript:void(0)" class="visitors">Income</a>
              <a href="javascript:void(0)" class="returning">Profit</a>
       
              <a href="#" class="bars"><span></span></a>
              <a href="#" class="lines active"><span></span></a>
          </div>
       
          <div class="graph-container">
              <div id="graph-lines2" class="graph-lines"></div>
              <div id="graph-bars2" class="graph-bars"></div>
          </div>
      </div>
      <!-- end Graph HTML -->
    </div>

  </div>

</div>

<script type="text/javascript">

  function showTooltip(x, y, contents) {
      $('<div id="tooltip">' + contents + '</div>').css({
          top: y - 16,
          left: x + 20
      }).appendTo('body').fadeIn();
  }

  $(document).ready(function(){

    var graphData = [{
          // Visits
          data: [ [6, 1300], [7, 1600], [8, 1900], [9, 2100], [10, 2500], [11, 2200], [12, 2000], [13, 1950], [14, 1900], [15, 2000] ],
          color: '#71c73e'
      }, {
          // Returning Visits
          data: [ [6, 500], [7, 600], [8, 550], [9, 600], [10, 800], [11, 900], [12, 800], [13, 850], [14, 830], [15, 1000] ],
          color: '#77b7c5',
          points: { radius: 4, fillColor: '#77b7c5' }
      }
    ];

    var graphData2 = [{
          // Visits
          data: [ [1, 1950], [2, 2500], [3, 2000] ],
          color: '#71c73e'
      }, {
          // Returning Visits
          data: [ [1, 850], [2, 750], [3, 1000] ],
          color: '#77b7c5',
          points: { radius: 4, fillColor: '#77b7c5' }
      }
    ];

    // create any graphs
    plotGraph('#graph-lines','#graph-bars', graphData);
    setGraphHoverOver('#graph-lines','#graph-bars', '');
    plotGraph('#graph-lines2','#graph-bars2', graphData2);
    setGraphHoverOver('#graph-lines2','#graph-bars2', '');

    // switch between graphs, when user click line or bar button
    $('.lines').on('click', function (e) {
        $(this.parentNode.querySelectorAll(".bars")).removeClass('active');
        $(this.parentNode.parentNode.querySelectorAll(".graph-container .graph-bars")).fadeOut();
        $(this).addClass('active');
        $(this.parentNode.parentNode.querySelectorAll(".graph-container .graph-lines")).fadeIn();
        e.preventDefault();
    });

    $('.bars').on('click', function (e) {
        $(this.parentNode.querySelectorAll(".lines")).removeClass('active');
        $(this.parentNode.parentNode.querySelectorAll(".graph-container .graph-lines")).fadeOut();
        $(this).addClass('active');
        $(this.parentNode.parentNode.querySelectorAll(".graph-container .graph-bars")).fadeIn().removeClass('hidden');
        e.preventDefault();
    });

    // $('#lines').on('click', function (e) {
    //     $('#bars').removeClass('active');
    //     $('#graph-bars').fadeOut();
    //     $(this).addClass('active');
    //     $('#graph-lines').fadeIn();
    //     e.preventDefault();
    // });
     
    // $('#bars').on('click', function (e) {
    //     $('#lines').removeClass('active');
    //     $('#graph-lines').fadeOut();
    //     $(this).addClass('active');
    //     $('#graph-bars').fadeIn().removeClass('hidden');
    //     e.preventDefault();
    // });

  });

  function plotGraph(graphLineElem, graphBarElem, graphData){

    // Lines
    $.plot($(graphLineElem), graphData, {
        series: {
            points: {
                show: true,
                radius: 5
            },
            lines: {
                show: true
            },
            shadowSize: 0
        },
        grid: {
            color: '#646464',
            borderColor: 'transparent',
            borderWidth: 20,
            hoverable: true
        },
        xaxis: {
            tickColor: 'transparent',
            tickDecimals: 0
        },
        yaxis: {
            tickSize: 1000
        }
    });
     
    // Bars
    $.plot($(graphBarElem), graphData, {
        series: {
            bars: {
                show: true,
                barWidth: .9,
                align: 'center'
            },
            shadowSize: 0
        },
        grid: {
            color: '#646464',
            borderColor: 'transparent',
            borderWidth: 20,
            hoverable: true
        },
        xaxis: {
            tickColor: 'transparent',
            tickDecimals: 0
        },
        yaxis: {
            tickSize: 1000
        }
    });

    $(graphBarElem).hide();

  }

  function setGraphHoverOver(graphLineElem, graphBarElem, message){

    var previousPoint = null;
     
    $(graphLineElem+', '+graphBarElem).bind('plothover', function (event, pos, item) {
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                $('#tooltip').remove();
                var x = item.datapoint[0],
                    y = item.datapoint[1];
                    // showTooltip(item.pageX, item.pageY, y + ' visitors at ' + x + '.00h');
                    showTooltip(item.pageX, item.pageY, y);
            }
        } else {
            $('#tooltip').remove();
            previousPoint = null;
        }
    });

  }

</script>