<html>
  <head>
    <script type="text/javascript" src="./js/jsapi_bar.js"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["columnchart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses', 'test'],
          ['2004',  1000,      400, 1000],
          ['2005',  1170,      460, 500],
          ['2006',  660,       1120, 400],
          ['2007',  1030,      540, 422]
        ]);

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, {width: 400, height: 240, is3D: true, title: 'Company Performance'});
      }
    </script>
  </head>

  <body>
    <div id="chart_div"></div>
  </body>
</html>