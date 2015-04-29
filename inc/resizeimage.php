<?php
// $images_name
//$maxwidth
//$maxheight
if(!$maxwidth){$maxwidth=180;}
if(!$maxheight){$maxheight=180;}
$filetype=strtolower(file_extension(trim($images_name)));

$new_images = UPDIR."thumbs/".file_name_non_extension(trim($images_name))."_thumbs_".$maxwidth.".".$filetype;
$images= UPDIR."hotel/".$images_name; 
 if(!file_exists($new_images)){
$size=GetimageSize($images);
if($size[0]>$size[1]){
$height=round($maxwidth*$size[1]/$size[0]);
$width=$maxwidth;
}else{
$height=$maxheight;
$width=round($maxheight*$size[0]/$size[1]);
}
if($filetype==("jpg" || "jpeg")){
$images_orig = ImageCreateFromJPEG($images);
$photoX = ImagesX($images_orig);
$photoY = ImagesY($images_orig);
$images_fin = ImageCreateTrueColor($width, $height);
ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
ImageJPEG($images_fin,$new_images);
}else if($filetype=="png"){
$images_orig = imagecreatefrompng($images);
    // Convert the Image to PNG-24
    $im_tc = imagecreatetruecolor($width, $height);
    imagecopy($im_tc,$images_orig,0,0,0,0,$width+1, $height+1);
    imagedestroy($images_orig);
   
    //Now do what ever you want, all alpha-operation do work
    $color = imagecolorallocatealpha ($im_tc,255,255,255,75);
    imagefilledellipse ($im_tc,10,10,6,4,$color);

    //And now convert it back to PNG-8
    $im_result = imagecreate($width, $height);
    imagecopy($im_result,$im_tc,0,0,0,0,$width, $height);
    imagedestroy($im_tc);
	imagepng($im_result,$new_images,100);    
}else{
$images_orig = imagecreatefromgif($images);
$photoX = ImagesX($images_orig);
$photoY = ImagesY($images_orig);
ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
imagegif($images_fin,$new_images, 100);

}
ImageDestroy($images_orig);
ImageDestroy($images_fin);
}

?> 