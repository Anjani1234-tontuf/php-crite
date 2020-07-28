<html>
  <head>
   <title> PHP Watermark Script </title>
   <link href="./style.css" rel="stylesheet" type="text/css">
   <script src='jquery.js'></script>
   <script type='text/javascript'>
	function validateForm() {
			//var x = document.forms["myForm"]["watermark"].value;
			var x = document.getElementById('txt').value;
			if (x == null || x == "") {
				alert("Enter Watermark Text!!");
				return false;
			}
	}
	function chk(){
    var sds = document.getElementById("dum");
    if(sds == null){
        alert("You are using a free package.\n You are not allowed to remove the tag.\n");
    }
    var sdss = document.getElementById("dumdiv");
    if(sdss == null){
        alert("You are using a free package.\n You are not allowed to remove the tag.\n");
		document.getElementById("content").style.visibility="hidden";
    }
	}
	window.onload=chk;
	
	
  $(function()
  {
		$('#file').bind('change', function() {	  
				  var ext = $('#file').val().split('.').pop().toLowerCase();
				  if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
				  alert('Invalid extension!');
				  document.getElementById("file").value='';
				  }
				  else{
							var size = this.files[0].size;
							var kb = size/1024;
							if (kb>1000) {
							   alert("Image size should be less than 1 MB");
							   document.getElementById("file").value='';
							}
				  }			  
		});
	function shuffle(o) {
    for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
	};
		
		var files;
		$('input[type=file]').on('change', prepareUpload);
		$('#sub').on('click', uploadFiles);

		function prepareUpload(event)
		{
			files = event.target.files;		
		}
			  function uploadFiles(event)
			  {
				  var imgVal = $('#file').val();
				  if(imgVal=='')
				  {
					  alert("Choose File!!");
				  }
				  event.stopPropagation(); // Stop stuff happening
				  event.preventDefault(); // Totally stop stuff happening
				  var data = new FormData();		
				  $.each(files, function(key, value)
				  {
					  data.append(key, value);
				  });
				  $('.load').show();
					$("#sub").hide();
				  $.ajax({
					
					  url: 'ajax-reply.php?files',
					  type: 'POST',
					  data: data,
					  cache: false,
					  dataType: 'json',
					  processData: false, // Don't process the files
					  contentType: false, // Set content type to false as jQuery will tell the server its a query string request
					  success: function(data, textStatus, jqXHR)
					  {
						  if(typeof data.error === 'undefined')
						  {
							var x = document.getElementById('txt').value;
							var select = $('#position :selected').text();
							var img = $('#file').val();
							var ext = img.split('.').pop();
							var fileName =img.split('.');
							var alt = fileName[0];
							  var img_src=data.files;//submitForm(event, data);
								if (x!='') {
									var numbers = [1,2,3,4,5];
									var random = shuffle(numbers);
								  $.ajax({
												url: 'ajax-save.php',
												type: 'POST',
												data: {pos:select,watermark:x,img_src:img,ext:ext},
												success: function(data)
												{
												  //alert(data);
												  $('#opimg').html('<img src="'+data+'?'+random+'" class="imgfile" alt="'+alt+'"/>');
												}
											});
								}
									  
						  }
						  else
						  {
						  // Handle errors here
							  console.log('ERRORS: ' + data.error);
						  }
					  },
					  complete: function(){
											$('.load').hide();
											$("#sub").show();                     
											}
				  });
			  }	
  });
	
   </script>
  </head>
  <body>
	<div class='frms resp_code' id='content'>
	 <center><b>PHP Watermark Script </b></center><br><br>

	  
		<label><b>Upload File : (< 1000 KB)</b></label>
		<input type="file" name="file" id="file" required='required' accept='image/*'><br>
		
		<input type="hidden" name="formatt" id="format" value='hscripts'><br>
		<label><b>Watermark Text : </b></label>
		<input type='text' id='txt' name='watermark' style='width:40%;' maxlength='20'>
		
		<label><b>Select Position : </b></label>
		<select name='pos' id='position'>
		  <option>Left Top</option>
		  <option>Left Bottom</option>
		  <option>Right Top</option>
		  <option>Right Bottom</option>
		  <option>Center</option>
		</select><br>
		
		<div align='center'>
		  <div class='load' style='display:none;'><img src='loading.gif'></div>
		  <input type="submit" id="sub" value="Submit" onclick='validateForm()'>
		  <span style="font-size: 10px;color: #dadada;" id="dumdiv" align='center'>
		  <a href="http://www.hscripts.com" id="dum" style="text-decoration:none;color: #dadada;">&copy;h</a>
		  </span>
		</div>
			
		<div align='center' id='opimg'>
			   
		</div>	  
	 </div>
   </body>
</html>
<?php
function fixbbox($bbox) {
   $xcorr=0-$bbox[6]; //northwest X
   $ycorr=0-$bbox[7]; //northwest Y
   $tmp_bbox['left']=$bbox[6]+$xcorr;
   $tmp_bbox['top']=$bbox[7]+$ycorr;
   $tmp_bbox['width']=$bbox[2]+$xcorr;
   $tmp_bbox['height']=$bbox[3]+$ycorr;   
   return $tmp_bbox;
}
?>