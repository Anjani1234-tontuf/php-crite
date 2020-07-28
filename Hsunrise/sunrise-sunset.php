<html>
<head>
<!-- Script by www.hscripts.com -->


<script type="text/javascript">
function change()
		{
		  var dy=document.getElementById('day').value;//get the selected date
		  var mn=document.getElementById('mon').value;//get the selected month
		  var yar=document.getElementById('yr').value;//get the selected year
		  var tzne=document.getElementById('tzone').value;//get the selected time zone
		  
		var aj=null;
		
             	         try
   		{
       		aj=new XMLHttpRequest();
   		}
   	  	catch(e)
  		 {
       		aj=new ActiveXObject("Microsoft.XMLHTTP");       }
		   if(aj==null)
		   {
	          alert("Sorry ! Your browser not supports AJAX");
		   }
	          var page="display.php";//set the page name to be called dynamically
	          var params="day="+dy+"&month="+mn+"&year="+yar+"&tzon="+tzne;//assign the parameters to be passed
			
	          aj.open("POST",page,true);//open the connection in post method
	          aj.onreadystatechange=function()
                           {
                   if(aj.readyState=="4" || aj.readyState=="complete")
           	       {
                    document.getElementById('output').innerHTML=aj.responseText;//sets the response text to the div id
                       }
     		}
       		aj.setRequestHeader("Content-type","application/x-www-form-urlencoded");
   		aj.send(params);
		
      	}

</script>
</head>
<body>
<div align=center>
	 <font color='brown' style=font-family:"Times New Roman",Georgia,Serif;><h2>SELECT THE DATE</h2></font>
		<font color='brown'>DD</font>
		      <select id="day">
			<?php
				$d=date("d");
				for($i=1;$i<32;$i++)
				  {
				if($i==$d)
				echo "<option value='$i' selected>$i</option>";
				else
				echo "<option value='$i'>$i</option>";
				}
				?>
			</select>
			<font color='brown'>Month</font>
			<select id="mon">
			<?php
				$m=date("m");
				for($i=1;$i<13;$i++)
				  {
				if($i==$m)
				echo "<option value='$i' selected>$i</option>";
				else
				echo "<option value='$i'>$i</option>";
				}
				?>
			</select>
			<font color='brown'>Year</font>
			<select id="yr">
			<?php
				
				
				for($i=1919;$i<2031;$i++)
				  {
				  if($i==2010)
				echo "<option value='$i' selected>$i</option>";
				else
				echo "<option value='$i'>$i</option>";
				}
				?>
			</select><br><br>
			Select the Time Zone
			<select id="tzone">
			<?php
			$timezone_identifiers = DateTimeZone::listIdentifiers();
			
			for ($i=0;$i<402;$i++)
			{	
			  $tzone=$timezone_identifiers[$i];
			
				  if($tzone=="Asia/Kolkata")
				echo "<option value='$tzone' selected>$tzone</option>";
				else
			  echo "<option value='$tzone'>$tzone</option>";
			}
			?>
			</select><br><br>
		<input type="button" onclick="change()" value="Go"/><br><br>
		<div id="output" bgcolor="#CCCCCC">
				</div>
	   </div>
</body>
</html>
