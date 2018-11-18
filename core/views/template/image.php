<?php

$img = imagecreatetruecolor(100,80);
$white = imagecolorallocate($img,255,255,255);
$black = imagecolorlocate($img,0,0,0);
$red = imagecolorlocate($img,255,0,0);
imagefill($img,0,0,$black);
imagettftext($img,10,0,10,10,$red,"calibri.ttf",'hello');
