<?php
header('Content-type: image/png');

$img = imagecreatetruecolor(170, 70);

$white = imagecolorallocate($img,255,255,255);
$black = imagecolorallocate($img, 0,0,0);
$color = imagecolorallocate($img,generateColor(), generateColor(), generateColor());

function generateChars()
{
    $str = '';
    $collection = "abcdefghklmnopqrstuvwx023456789";
    $length = strlen($collection);
    $arr = str_split($collection);
    for ($i = 0; $i <= 5; $i++){
        $s = mt_rand(0,$length);
        if ($s%2 == 0){
            $str .= strtoupper($arr[$s]);
        }else{
            $str .= ($arr[$s]);
        }
    }
    return $str;
}
function generateColor()
{
    $color = '';
    for ($i = 0; $i <= 3; $i++){
        $s = mt_rand(0,255);
        $color .= $s;
    }
    return $color;
}

imagefill($img,0,0,$color);
$someText = generateChars();
session_start();
$_SESSION['string'] = $someText;
imagettftext($img,24,3,30,40,generateColor(),'BRITANIC.ttf',$someText);
imagefilter($img, IMG_FILTER_PIXELATE, 2);

imagepng($img);
imagedestroy($img);