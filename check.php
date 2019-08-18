<!DOCTYPE HTML>
<html>
<head>
    <title>answer</title>
    <meta charset="utf-8">
    <link href="stylesheet.css" rel="stylesheet">
</head>

<body>
<?php

if (session_id()==="") session_start();
$start = microtime(true);
date_default_timezone_set("UTC");

$currentTime = time() + 3 * 3600;
echo "<p align='center' id='time'> Сейчас ".date("H:i:s", $currentTime)."</p>";

$x = (float)$_GET["x"];
$y = (float)$_GET["y"];
$r = (float)$_GET["r"];

if ($_GET["y"] == "-0" || $_GET["y"] == "-0.0" || $_GET["y"] == "-0.00") $y = (float)0.0;
if ($_GET["r"] == "-0" || $_GET["r"] == "-0.0" || $_GET["r"] == "-0.00") $r = (float)0.0;


if  (!($x ===-2.0 || $x === -1.5 || $x === -1.0 || $x === -0.5 || $x === 0.0 ||
    $x === 0.5 || $x === 1.0|| $x === 1.5|| $x===2.0))
    die("<p align='center'>Координата X указана неверно</p>");
if ($y < -5 || $y > 3)
    die("<p align='center'> Координата Y указана неверно </p>");
if ($r < 1 || $r > 4)
    die("<p align='center'> Радиус R указан неверно </p>");

if (!isset($_SESSION['responses'])) $_SESSION['responses']=array();

$response = new Response($x, $y, $r, $currentTime);
array_push($_SESSION['responses'],$response);

echo "<p align='center'> Точка ($x;$y) "; echo $response->check_area()? "":"не"; echo " входит в область с радиусом $r </p>";

$time=(float)round(microtime(true)-$start,4);
if ($time==0) $time='Менее 0.0001';
echo "<p align='center'>Время проверки: ".$time." сек.</p>";

$response->setTime($time);
echo
"<table  align='center'  >
<thead>
<tr >
<th> <h5>Х</h5></th>
<th> <h5>Y</h5></th>
<th> <h5>R</h5></th>
<th> <h5>Текущее время</h5></th>
<th> <h5>Время проверки</h5></th>
<th> <h5>Попала?</h5></th>

</tr>
</thead>";

foreach (array_reverse($_SESSION['responses']) as $i=>$response){
    echo "<tr>
<td align='center'>$response->x</td>
 <td align='center'>$response->y</td>
 <td align='center'>$response->r</td>
 <td align='center'>$response->currentTime</td>
  <td align='center'>$response->time</td> ";
    echo $response->check_area()? "<td>Да </td> </tr>" : "<td>Нет</td> </tr>";

}
if (count($_SESSION['responses'])>=10) array_shift($_SESSION['responses']);



echo "</table>";


class Response{
    public $x;
    public $y;
    public $r;
    public $currentTime;
    public $time;

    function __construct($x,$y,$r, $currentTime)
    {
        $this->x=$x;
        $this->y=$y;
        $this->r=$r;
        $this->currentTime=$currentTime;
    }

    function setTime($time) {
        $this->time = $time;
    }

    function check_area(){
        return true;
    }
}
?>


</body>

</html>


