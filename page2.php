<head>
<style>

        .axis path, .axis line
        {
            fill: none;
            stroke: #777;
            shape-rendering: crispEdges;
        }
        
        .axis text
        {
            font-family: 'Arial';
            font-size: 13px;
        }
        .tick
        {
            stroke-dasharray: 1, 2;
        }
        .bar
        {
            fill: FireBrick;
        }
        
       </style>
</head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js" charset="utf-8"></script>
<?php
$number = 5;
if (isset($_GET["number"])){
	$number = $_GET["number"];
}
mysql_connect("localhost","root","");
mysql_select_db("skyeng");

$sql = "SELECT MIN(time) FROM users";
$result = mysql_query($sql);
$date = mysql_fetch_array($result)[0];
//echo $date;


$sql = "SELECT FLOOR((TO_DAYS(time)-TO_DAYS((SELECT MIN(time) FROM users)))/$number) as period,COUNT(*)  as amount ";
$sql.="FROM `users` ";
$sql.="WHERE `status`='registered' ";
$sql.="GROUP BY FLOOR((TO_DAYS(time)-TO_DAYS((SELECT MIN(time) FROM users)))/$number)";
//echo $sql;
//echo $sql;
$result = mysql_query($sql);
$num = mysql_num_rows($result);
$array = array();
for ($i=0;$i<$num;$i++){
	$row = mysql_fetch_array($result);
	//echo $row[0]." ".$row[1]."<br/>";
	$array[$row[0]] = $row[1];
}
$sql = "SELECT FLOOR((TO_DAYS(time)-TO_DAYS((SELECT MIN(time) FROM users)))/$number) as period,COUNT(*)  as amount ";
$sql.="FROM `users` ";
$sql.="GROUP BY FLOOR((TO_DAYS(time)-TO_DAYS((SELECT MIN(time) FROM users)))/$number)";
//echo $sql;
//echo $sql;
$result = mysql_query($sql);
$num = mysql_num_rows($result);
$array2 = array();
for ($i=0;$i<$num;$i++){
	$row = mysql_fetch_array($result);
	//echo $row[0]." ".$row[1]."<br/>";
	$array2[$row[0]] = $row[1];
	
}
$output = array();
foreach ($array2 as $key=>$item){
	$registered = 0;
	if (isset($array[$key])){
		$registered = $array[$key];
	}
	$output[] = "{'x': ".$key.", 'y' : ".$registered/$item."}\n";
}
foreach ($array2 as $key=>$value){
	$outputdate = DateTime::createFromFormat('Y-m-d H:i:s', $date);
	$outputdate->modify('+'.$number*$key.' day');
	echo $key.":".$outputdate->format('Y-m-d')."<br/>";
}



$output = implode(",", $output);
?>
<svg id="visualisation" width="1000" height="500"></svg>
<div style="float:left;">
	<form action="page2.php" method="get">
	Number:<input type="text" name="number" value="<?= $number ?>"/>
	<input type="submit"/>
	</form>
	</div>



<script>

InitChart();

function InitChart() {

  var barData = [<?= $output ?>];

  var vis = d3.select('#visualisation'),
    WIDTH = 1000,
    HEIGHT = 500,
    MARGINS = {
      top: 20,
      right: 20,
      bottom: 20,
      left: 50
    },
    xRange = d3.scale.ordinal().rangeRoundBands([MARGINS.left, WIDTH - MARGINS.right], 0.1).domain(barData.map(function (d) {
      return d.x;
    })),


    yRange = d3.scale.linear().range([HEIGHT - MARGINS.top, MARGINS.bottom]).domain([0,
      d3.max(barData, function (d) {
        return 1;
      })
    ]),

    xAxis = d3.svg.axis()
      .scale(xRange)
      .tickSize(5)
      .tickSubdivide(true),

    yAxis = d3.svg.axis()
      .scale(yRange)
      .tickSize(5)
      .orient("left")
      .tickSubdivide(true);


  vis.append('svg:g')
    .attr('class', 'x axis')
    .attr('transform', 'translate(0,' + (HEIGHT - MARGINS.bottom) + ')')
    .call(xAxis);

  vis.append('svg:g')
    .attr('class', 'y axis')
    .attr('transform', 'translate(' + (MARGINS.left) + ',0)')
    .call(yAxis);

  vis.selectAll('rect')
    .data(barData)
    .enter()
    .append('rect')
    .attr('x', function (d) {
      return xRange(d.x);
    })
    .attr('y', function (d) {
      return yRange(d.y);
    })
    .attr('width', xRange.rangeBand())
    .attr('height', function (d) {
      return ((HEIGHT - MARGINS.bottom) - yRange(d.y));
    })
    .attr('fill', 'grey');

}
</script>
