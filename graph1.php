<?php
    
    $username = "root"; 
    $password = "";   
    $host = "127.0.0.1";
    $database="sommar";

    $db = mysqli_connect($host, $username, $password, $database);
    if (mysqli_connect_errno()) {
        printf("123123Connectaa failed: %s\n", mysqli_connect_error());
        exit();
    }
    else {
    /* printf("Lyckades att hamta stuff"); */
        }


    $sqlquery = "
    SELECT PK_ID as ID, Sex, AgeCategory, BMI, PhysicalHealth, MentalHealth, SleepTime, HeartDisease
    FROM PrimTable 
    ";

    $result = mysqli_query($db,$sqlquery);

/* 
    $query = mysqli_query($myquery); */

    if ( ! $result ) {
        echo mysqli_error();
        die;
    }

    $data = array();

    for ($x = 0; $x < mysqli_num_rows($result); $x++) {
        $data[] = mysqli_fetch_assoc($result);
    }



$female = 0; // Used for counting how many women there are in the results
$male = 0; // Used for counting how many men there are in the results

$agecat1 = 0; // Agecategory 18-24
$agecat2 = 0; // 25-29
$agecat3 = 0; // 30-34
$agecat4 = 0; // 35-39
$agecat5 = 0; // 40-44
$agecat6 = 0; // 45-49
$agecat7 = 0; // 50-54
$agecat8 = 0; // 55-59
$agecat9 = 0; // 60-64
$agecat10 = 0; // 65-69
$agecat11 = 0; // 70-74
$agecat12 = 0; // 75-79
$agecat13 = 0; // 80 and older





$ageSleepArr = array(array('Age', 'SleepTime')); // Array to store Age and Sleep
$ageSleepArr1 = array(array('Age', 'BMI')); // Array to store Age and Sleep



$bubbleArr = array(array('Sex', 'AgeCategory', 'PhysicalHealth','HeartDisease','PhysicalHealth','MentalHealth')); // Array to store Age and BMI




foreach($data as $key => $value) { // Används bl.a som en COUNT funktion för graf 1 och 2.
  

  if($value['Sex'] == "Female") { // Used for graph 1
    $female++;
    
    $bubbleArr[] = 
    array((object)
    ['v' => 1, 'f' => $value['Sex']], 
    strval($value['AgeCategory']), 
    strval($value['PhysicalHealth']), 
    strval($value['HeartDisease']), 
    strval($value['PhysicalHealth']), 
    strval($value['MentalHealth']));
  }
  if($value['Sex'] == "Male") {
    $male++;
    
  }
  if($value['AgeCategory'] == "18-24") {
    $ageSleepArr[] = array((object)['v' => 22, 'f' => $value['AgeCategory']], floatval($value['SleepTime']));
    $ageSleepArr1[] = array((object)['v' => 22, 'f' => $value['AgeCategory']], floatval($value['BMI']));
    $agecat1++;
  }
  if($value['AgeCategory'] == "25-29") {
    $ageSleepArr[] = array((object)['v' => 27, 'f' => $value['AgeCategory']], floatval($value['SleepTime']));
    $agecat2++;
  }
  if($value['AgeCategory'] == "30-34") {
    $ageSleepArr[] = array((object)['v' => 32, 'f' => $value['AgeCategory']], floatval($value['SleepTime']));
    $agecat3++;
  }
  if($value['AgeCategory'] == "35-39") {
    $ageSleepArr[] = array((object)['v' => 37, 'f' => $value['AgeCategory']], floatval($value['SleepTime']));
    $agecat4++;
  }
  if($value['AgeCategory'] == "40-44") {
    $ageSleepArr[] = array((object)['v' => 42, 'f' => $value['AgeCategory']], floatval($value['SleepTime']));
    $agecat5++;
  }
  if($value['AgeCategory'] == "45-49") {
    $ageSleepArr[] = array((object)['v' => 47, 'f' => $value['AgeCategory']], floatval($value['SleepTime']));
    $agecat6++;
  }
  if($value['AgeCategory'] == "50-54") {
    $ageSleepArr[] = array((object)['v' => 52, 'f' => $value['AgeCategory']], floatval($value['SleepTime']));
    $agecat7++;
  }
  if($value['AgeCategory'] == "55-59") {
    $ageSleepArr[] = array((object)['v' => 57, 'f' => $value['AgeCategory']], floatval($value['SleepTime']));
    $agecat8++;
  }
  if($value['AgeCategory'] == "60-64") {
    $ageSleepArr[] = array((object)['v' => 62, 'f' => $value['AgeCategory']], floatval($value['SleepTime']));
    $agecat9++;
  }
  if($value['AgeCategory'] == "65-69") {
    $ageSleepArr[] = array((object)['v' => 67, 'f' => $value['AgeCategory']], floatval($value['SleepTime']));
    $agecat10++;
  }
  if($value['AgeCategory'] == "70-74") {
    $ageSleepArr[] = array((object)['v' => 72, 'f' => $value['AgeCategory']], floatval($value['SleepTime']));
    $agecat11++;
  }
  if($value['AgeCategory'] == "75-79") {
    $ageSleepArr[] = array((object)['v' => 77, 'f' => $value['AgeCategory']], floatval($value['SleepTime']));
    $agecat12++;
  }
  if($value['AgeCategory'] == "80 or older") {
    $ageSleepArr[] = array((object)['v' => 82, 'f' => $value['AgeCategory']], floatval($value['SleepTime']));
    $agecat13++;
  }

}

$output = "['Kon','Fordelning'],['Kvinnor',$female],['Man',$male]";
$output2 = "['Alder','Fordelning'],
['18-24',$agecat1], ['25-29',$agecat2],
['30-34',$agecat3], ['35-39',$agecat4], 
['40-44',$agecat5], ['45-49',$agecat6],
['50-54',$agecat7],['55-59',$agecat8],
['60-64',$agecat9],['65-69',$agecat10],
['70-74',$agecat11],['75-79',$agecat12],
['80 or older',$agecat13]";

print_r($ageSleepArr1);

$output3 = json_encode($ageSleepArr);
$output4 = json_encode($bubbleArr);



/* print_r($output);

echo "<br>";
echo "<br>";
echo $female;
echo "<br>";
echo $male;

echo json_encode($data);


    //write to json file
    $fp = fopen('MySQL1.json', 'w');
    fwrite($fp, json_encode($data));
    fclose($fp);   

    mysqli_close($db);  */
?>

<!DOCTYPE html>
<html lang="sv" xmlns="http://www.w3.org/1999/ xhtml">
  <head>


  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
	google.charts.load("current", {packages: ["corechart"]});

      google.charts.setOnLoadCallback(drawChart1);

function drawChart1() { // Första grafen!

  var data = new google.visualization.arrayToDataTable([
    <?php echo $output; ?>
  ]);

  var options = {
    title: 'Alla människor uppdelat i procent'
  };

  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}

/*------------------------!!!!!!!!!!SEPERATION!!!!!!!!!!------------------------*/

google.charts.setOnLoadCallback(drawChart2);

function drawChart2() { // Andra grafen!

var button = document.getElementById('change-chart');
var chartDiv = document.getElementById('piechart2');
var cake = 0;

var data = new google.visualization.arrayToDataTable([
<?php echo $output2; ?> // <---- Den data som ska användas i denna graf
]);

var options = {
title: 'Alla människor uppdelat i ålder',
is3D: true,
pieStartAngle: 0,
};

var options2 = {
title: 'Alla människor uppdelat i ålder',
width: 1400,
height: 1200,
is3D: true,
pieStartAngle: 80,
};


function normalOptions() {
document.getElementById('chart_div1').style.paddingTop = '0em'
var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
chart2.draw(data, options);
      button.innerText = 'Make the Piechart larger';
      button.onclick = LargeOptions;
      
}
function LargeOptions() {
document.getElementById('chart_div1').style.paddingTop = '30em'
var chart3 = new google.visualization.PieChart(document.getElementById('piechart2'));
chart3.draw(data, options2);  

button.innerText = 'Make the Piechart smaller';
button.onclick = normalOptions;
}

normalOptions();

};


/*------------------------!!!!!!!!!!SEPERATION!!!!!!!!!!------------------------*/

google.charts.setOnLoadCallback(drawChart3);
function drawChart3() {
        var data = google.visualization.arrayToDataTable(
          <?php echo $output3; ?>
        );

        console.log(<?php echo $output3; ?>);

        var options = {
          title: 'Ålder vs Sömn jämförelse',
          hAxis: {
            title: 'Ålder', 
            minValue: 20, 
            maxValue: 100,
            ticks: [{v:22, f:'18-24'}, 
                    {v:27, f:'25-29'}, 
                    {v:32, f:'30-34'}, 
                    {v:37, f:'35-39'}, 
                    {v:42, f:'40-44'}, 
                    {v:47, f:'45-49'}, 
                    {v:52, f:'50-54'}, 
                    {v:57, f:'55-59'}, 
                    {v:62, f:'60-64'}, 
                    {v:67, f:'65-69'}, 
                    {v:72, f:'70-74'}, 
                    {v:77, f:'75-79'}, 
                    {v:82, f:'80 or older'}],
            viewWindow: {
              min: 20,
              max: 85,
            }
          },
          vAxis: {title: 'Antal timmar sömn', minValue: 0, maxValue: 20},
          legend: 'none'
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div1'));

        chart.draw(data, options);
      }




/*------------------------!!!!!!!!!!SEPERATION!!!!!!!!!!------------------------*/

google.charts.setOnLoadCallback(drawChart4);

function drawChart4 () {

  var data = google.visualization.arrayToDataTable(<?php echo $output4; ?>);

  var options = {
        title: 'Fertility rate vs life expectancy in selected countries (2010).' +
          ' X=Life Expectancy, Y=Fertility, Bubble size=Population, Bubble color=Region',
        hAxis: {title: 'Life Expectancy', 
          ticks: [{v:1, f:'Male'}, 
                    {v:2, f:'Female'}, 
                    {v:3, f:'30-34'}, 
                    {v:4, f:'35-39'}, 
                    {v:5, f:'40-44'}],},
        vAxis: {title: 'Fertility Rate'},
        bubble: {textStyle: {fontSize: 11}}
      };
  
      var chart = new google.visualization.BubbleChart(document.getElementById('series_chart_div'));
      chart.draw(data, options);



}


    </script>






  <meta charset="ISO-8859-1">
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Charts - Visualisering</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap responsive -->
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- Font awesome - iconic font with IE7 support --> 
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/font-awesome-ie7.css" rel="stylesheet">
    <!-- Bootbusiness theme -->
    <link href="css/boot-business.css" rel="stylesheet">







  <style>
  .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
  }

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
  </head>
  


  <body>
    <header>
      <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container">
            <a href="index.html" class="brand brand-bootbus">Google Charts - Visualisering</a>
    
          </div>
        </div>
      </div>
    </header>

    
<div class="container"> <!-- Container that keeps everything in the middle -->
<h3>850 människors data visualiseras i graferna nedan</h3> 
<h5> Dessa rader hämtas från min MySQL databas med hjälp av PHP.</h5>
<div id="piechart" style="width: 900px; height: 500px;"></div> <!-- Graph 1 -->

<!-- <div id="barchart_material" style="width: 1900px; height: 100px; padding: 50px;"></div> -->
<button id="change-chart">Change to..</button>
    <br><br>
    <div id="piechart2box"><div id="piechart2" style="width: 900px; height: 500px;"></div></div><!-- Graph 2 -->


<div id="chart_div1" style="width: 900px; height: 500px;"></div>

<div id="series_chart_div" style="width: 900px; height: 500px;"></div>
</div>
    </div>
    <footer>
      <div class="container">
        <div class="row">
          <div class="span2">
            <h4></i> </h4>
            <nav>
          </div>
        </div>
      </div>
      <hr class="footer-divider">
      <div class="container">
        <p>
          &copy; Visualiseringssida 2022.
        </p>
      </div>
    </footer>

    <!-- End: FOOTER -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/boot-business.js"></script>
  </body>
</html>