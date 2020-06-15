<?php
include './phpqrcode/phpqrcode.php'; //phprcode路径地址.生成二维码插件
$value = @$_GET['host'];//二维码内容
if($value == '') exit('二维码内容不存在');
$logo = @$_GET['logo'] ? @$_GET['logo'] : false;//logo
//生成二维码的配置
$errorCorrectionLevel = 'L';//容错级别 (L 7%) (M 15%) (Q 25%) (H 30%)
$matrixPointSize = 6;//生成图片大小
$margin = 2; //控制生成二维码的空白区域大小
if($logo){
$QR = './code.png';//保存的文件地址
}else{
$logo = false;//准备好的logo图片
$QR = false;//已经生成的原始二维码图
}
//生成二维码图片
QRcode::png(urldecode($value), $QR, $errorCorrectionLevel, $matrixPointSize, $margin);
if ($logo !== false) {  //是否有Logo图
    $logo = urldecode($logo);
//对logo加白边
    $w = 26; //logo白边的宽带
//源图对象
    $src_image = imagecreatefromstring(file_get_contents($logo));
    $src_width = imagesx($src_image);
    $src_height = imagesy($src_image);
//添加白边
    $final_image = imagecreatetruecolor($src_width + $w, $src_height + $w);
    $color = imagecolorallocate($final_image, 255, 255, 255);
    imagefill($final_image, 0, 0, $color);
    $x = $w / 2;
    $y = $w / 2;
    imagecopy($final_image, $src_image, $x, $y, 0, 0, $src_width, $src_height);
    $QR = imagecreatefromstring(file_get_contents($QR));
// $logo = imagecreatefromstring(file_get_contents($logo));
    $logo = $final_image;
    $QR_width = imagesx($QR);//二维码图片宽度
    $QR_height = imagesy($QR);//二维码图片高度
    $logo_width = imagesx($logo);//logo图片宽度
    $logo_height = imagesy($logo);//logo图片高度
    $logo_qr_width = $QR_width / 5;
    $scale = $logo_width / $logo_qr_width;
    $logo_qr_height = $logo_height / $scale;
    $from_width = ($QR_width - $logo_qr_width) / 2;
//重新组合图片并调整大小
    imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
//输出图片
    Header("Content-type: image/png");
    ImagePng($QR);
}
?>