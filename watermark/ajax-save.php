<?php
error_reporting(0);
    $pathdir = "./uploads";
    $selectOption = $_POST['pos']; 
    $DestinationFile = "watermark-images/" . $_POST['img_src']."";
    $WaterMarkText = $_POST['watermark'];
    $type = "image/".$_POST['ext']."";
    $SourceFile = $pathdir."/".$_POST['img_src'];
    if(isset($WaterMarkText))
    {
     watermarkImage ($SourceFile, $WaterMarkText, $DestinationFile,$type);
     $DestinationFile = "watermark-images/" . $_POST['img_src']."";
     echo $DestinationFile;
    }    
    function watermarkImage ($SourceFile, $WaterMarkText, $DestinationFile,$x)
    {
	  $x = explode("/",$x);
	  $x = $x[1];
	  $x = strtolower($x);
	  list($width, $height) = getimagesize($SourceFile); 
	  $ext = strtolower($x);
	  $image = "";
	  if ($ext == "gif"){ 
	  $image = imagecreatefromgif($SourceFile);
	  } else if($ext =="png"){ 
	  $image = imagecreatefrompng($SourceFile);
	  } else { 
	  $image = imagecreatefromjpeg($SourceFile);
	  }
	  $image_p = imagecreatetruecolor($width, $height);
	  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
	  $black = imagecolorallocate($image_p, 0, 255, 0);
	  $font = 'arial.ttf';
	  $font_size = 15;	
	  $bbox = fixbbox(imagettfbbox($font_size, 0, $font, $WaterMarkText));
	  $watermarkWidth = $bbox['width'];
	  $watermarkHeight = $bbox['height'];
	  $imageWidth = imageSX($image);
	  $imageHeight = imageSY($image);
	  $selectOption = $_POST['pos'];
	  $coordinateX = ($imageWidth - 15) - $watermarkWidth;//echo "<br>";
	  $coordinateY = ($imageHeight -5) - 10;
	  if($selectOption=='Left Top')
	  {
		imagettftext($image_p, $font_size, 0, 10, 20, $black, $font, $WaterMarkText);
	  }
	  if($selectOption=='Left Bottom')
	  {
		imagettftext($image_p, $font_size, 0, 10, $height-10, $black, $font, $WaterMarkText);
	  }
	  if($selectOption=='Right Top')
	  {
		imagettftext($image_p, $font_size, 0, $coordinateX, 20, $black, $font, $WaterMarkText);
	  }
	  if($selectOption=='Right Bottom')
	  {
		imagettftext($image_p, $font_size, 0, $coordinateX, $coordinateY, $black, $font, $WaterMarkText);
	  }
	  if($selectOption=='Center')
	  {
		imagettftext($image_p, $font_size, 0, $width/2, $height/2, $black, $font, $WaterMarkText);
	  }
	
	  if ($ext == "gif"){ imagegif($image_p, $DestinationFile);}
	  else if($ext =="png"){ imagepng($image_p, $DestinationFile);}
	  else { imagejpeg($image_p, $DestinationFile, 84);}	   
	  if ($DestinationFile<>'') {	  
		 if ($ext == "gif"){ imagegif($image_p, $DestinationFile);}
		 else if($ext =="png"){ imagepng($image_p, $DestinationFile);}
		 else { imagejpeg($image_p, $DestinationFile, 84);} 
	  } else {
		 header("Content-type: image/".$x);
		 if ($ext == "gif"){ imagegif($image_p, null, 100);}
		 else if($ext =="png"){ imagepng($image_p, null, 100);}
		 else { imagejpeg($image_p, null, 100);}   
	  };		
	  imagedestroy($image); 
	  imagedestroy($image_p); 
  };
  
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
