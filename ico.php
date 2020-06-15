<?php
ob_clean();
$text=strtoupper($_REQUEST["text"]);//显示的文字
$size=48;//字体大小
$font= realpath("fonts/font.ttf");//字体类型，这里为黑体，具体请在windows/fonts文件夹中，找相应的font文件
$width = 64;
$height = 64;
$pos = imagettfbbox($size , 0, $font, $text);
$img=imagecreate($width,$height);//创建一个空白图片
$bg = imagecolorallocatealpha($img , 0 , 0 , 0 , 127);
$color = imagecolorallocate($img,255,0,0);
imagealphablending($img, false);
imagefill($img, 0 , 0 , $bg);
$fontWidth = imagefontwidth ( $size );
$fontHeight = imagefontheight ( $size );
$textWidth = $fontWidth * mb_strlen ( $text );
$textWidth = $pos[2] - $pos[0];
$x = ceil ( ($width - $textWidth) / 2 );//计算文字的水平位置
$textHeight = $fontHeight * mb_strlen($text);
$textHeight = $pos[5] - $pos[3];
$y = ceil(($height - $textHeight) / 2);//计算文字的垂直位置
imagettftext ( $img, $size, 0, $x, $y, $color, $font, $text );

header('Content-Type: image/png');//发送头信息
imagepng($img);//输出图片，输出png使用imagepng方法，输出gif使用imagegif方法
?>