<?php
//Script by www.hscripts.com
date_default_timezone_set("Asia/kolkata");
$d=$_POST['day'];
$m=$_POST['month'];
$y=$_POST['year'];
$tzone=$_POST['tzon'];
echo "<table border='1' width='400' bgcolor='#99CCFF'><tr  bgcolor='#33CCFF'><td>Timezone</td><td>Sunrise</td><td>Sunset</td></tr>";


    	$tz = new DateTimeZone("$tzone");
        $lt=$tz->getLocation();
        $lat=$lt['latitude'];
        $lon=$lt['longitude'];

       $info=date_sun_info(strtotime("$y-$m-$d"),$lat,$lon);
	echo"<tr>
		   <td>";
		echo  $tzone."</td><td>";
		echo date("H:i",$info['sunrise']). "</td><td>";
		echo date('H:i',$info['sunset'])."</td></tr>";
		
		
	
echo "</table>";
?>
