<html>
<head>
<!.. script by hscripts.com..!>
<script type="text/javascript">

//******************************************ajax part starts***********************************************//	
	function fname()
		{ 
		
		  var val,aj=null;   
		var yer=document.getElementById('yr').value;
		
             	var linkid=val;
                try
   		{
       		aj=new XMLHttpRequest();
   		}
   		catch(e)
   		  {
       			aj=new ActiveXObject("Microsoft.XMLHTTP");    }  
   			if(aj==null)
   				{
       				alert("Sorry ! Your browser not supports AJAX");
   				}
      				var page="sunday.php";
   				var params="yr="+yer;
          			aj.open("POST",page,true);
       				aj.onreadystatechange=function()
                          	 {
                  		 if(aj.readyState=="4" || aj.readyState=="complete")
              				{ 
						
                    			document.getElementById('opt').innerHTML=aj.responseText;
                       			}

                           	}
       				aj.setRequestHeader("Content-type","application/x-www-form-urlencoded");
   				aj.send(params);
			} 
//************************************************ajax part ends***********************************************//
</script>
</head>
<body>
<div align=center>
     <center><font color=brown>Please Select the year to find the easter sunday date:</font></center><br>
       <select id="yr">
          <?php
		$d=date("Y");
	
            for($i=1970;$i<2037;$i++)
		{
		if($i==$d)
		echo "<option value='$i' selected>$i</option>";
		else
		echo ("<option value=$i>$i</option>");
		}
		?>
	</select>
	<input type="button" value="Find" onclick="fname()">
	</div><br>
		<div id="opt" align=center>
   </div>
  
</body>
</html>
