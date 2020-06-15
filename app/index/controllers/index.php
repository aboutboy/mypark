<?php

// +----------------------------------------------------------------------
// | 域名停靠系统 v1.0.0
// +----------------------------------------------------------------------
// | 版权所有 2018~2118 开源代码 [ http://www.mypark.com ]
// +----------------------------------------------------------------------
// | 官方网站：http://www.mypark.com
// +----------------------------------------------------------------------
// | 作者: 无名小二
// +----------------------------------------------------------------------
if ($dn['domain'] == null) {
    header('Location: index/warn');
} elseif ($dn['url'] != null) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: '.$dn['url']);
}
$host = $simplehost = explode('.',$dn['domain'])[0];
$dn['title'] = '智能域名停靠系统';
//$dn['keywords'] = '域名,'.$host.','.$simplehost;
$logo = $simplehost.'.png';
if (file_exists($logo)){
    $dn['logo'] = $url.'/'.$simplehost.'.png';
}else{
    $dn['logo'] = '/qrcode.php?host='.$host;
}
$ico = '/ico.php?text='.substr($simplehost,0,1);
$dn['price'] = $dn['price'] == 0 ? '商议' : $dn['price'];
$dn['keywords'] .= ','.$dn['domain'].','.$host;
$dn['description'] = $dn['name'].'的域名'.$dn['domain'].'非常有价值，目前正在优惠出售中。'.$dn['description'];
