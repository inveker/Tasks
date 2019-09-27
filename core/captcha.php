<?php

session_start();

$captcha = rand(1000, 9999);
$_SESSION['captcha'] = $captcha;

$im = imagecreatetruecolor(100, 50);

$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 100, 100, 100);
$background = imagecolorallocate($im, 255, 222, 173);

imagefilledrectangle($im, 0, 0, 100, 50, $background);

$font = '../fonts/captcha_font.ttf';

$arr = str_split($captcha);
for($i=0; $i < 4; $i++) { 
    $angle = rand(-15, 15);
    $size = rand(24, 32);
    $height = rand(25, 45);
    imagettftext($im, $size, $angle, 15+20*$i, $height, $grey, $font, $arr[$i]);
    imagettftext($im, $size, $angle, 17+20*$i, $height+2, $white, $font, $arr[$i]);
}

header ("Content-type: image/png");
imagepng($im);
imagedestroy($im);
