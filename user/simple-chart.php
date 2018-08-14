<?php

    /* Include the `../src/fusioncharts.php` file that contains functions to embed the charts.*/
    include("includes/fusioncharts.php");
?>
  <html>

    <head>
        <link rel="stylesheet" type="text/css" href="../FusionCharts/themes/fusioncharts.theme.fusion.css"></link>
        <title>Sahara | Sales Chart</title>
        <!-- FusionCharts Library -->
        <script type="text/javascript" src="//cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
        <script type="text/javascript" src="//cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
        <!--
            <script type="text/javascript" src="//cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.gammel.js"></script>
            <script type="text/javascript" src="//cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.zune.js"></script>
            <script type="text/javascript" src="//cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.carbon.js"></script>
            <script type="text/javascript" src="//cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.ocean.js"></script>
        -->
    </head>
<?php

?>
    <body>

        <?php
                $arrChartConfig = array(
                  "chart" => array(
                    "caption" => "Monthly Sales Summary",
                    "subCaption" => "hover on a month to view exact amount", 
                    "xAxisName" => "Month (2018)",
                     "width"=> "1900", //width of the chart
    "height"=> "700", //height of the chart
                    "yAxisName" => "Amount (N)", 
                    "numberPrefix" => "N", 
                    "theme" => "fusion"
                    )
                );
$arr = array (["Venezuela", "290"], ["Venezuela", "290"], ["Venezuela", "290"], ["Venezuela", "290"]);

$con=mysqli_connect("localhost","root","","einstower_elearn");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$amountoftheday = "SELECT YEAR(dt) as SalesYear,
         MONTH(dt) as SalesMonth,
         SUM(amount) AS TotalSales
    FROM sales
GROUP BY YEAR(dt), MONTH(dt)
ORDER BY YEAR(dt), MONTH(dt) ";

              //use for MySQLi-OOP
              $avd = $pdo->query($amountoftheday);
              while($row = $avd->fetch()){
$month = $row["SalesMonth"];
  $results[] = [''.date('M', strtotime('2012-' . $month . '-01')).'',''.$row["TotalSales"].''];

}

              // An array of hash objects which stores data
              $arrChartData = $results;

              $arrLabelValueData = array();

            // Pushing labels and values
            for($i = 0; $i < count($arrChartData); $i++) {
                array_push($arrLabelValueData, array(
                    "label" => $arrChartData[$i][0], "value" => $arrChartData[$i][1]
                ));
            }

      $arrChartConfig["data"] = $arrLabelValueData;

      // JSON Encode the data to retrieve the string containing the JSON representation of the data in the array.
      $jsonEncodedData = json_encode($arrChartConfig);

      // chart object
      $Chart = new FusionCharts("column2d", "MyFirstChart" , "600", "350", "chart-container", "json", $jsonEncodedData);

      // Render the chart
      $Chart->render();

?>

        <h3>EV Sales Chart</h3>
        <div id="chart-container">Chart will render here!</div>
        <br/>
        <br/>
        <a href="../index.php">Go Back</a>
    </body>

    </html>