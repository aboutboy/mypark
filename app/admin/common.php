<?php

// +----------------------------------------------------------------------
// | 域名停靠系统 精简版 v2018
// +----------------------------------------------------------------------
// | 版权所有 2016~2018 开源代码 [ http://www.mypark.com ]
// +----------------------------------------------------------------------
// | 官方网站：http://www.mypark.com
// +----------------------------------------------------------------------
// | 作者: 无名小二
// +----------------------------------------------------------------------

/**
 * 登陆状态检查
 */
if ($_SESSION['admin'] > 0 && cp::url()[2] != 'login') {
    
} elseif ($_SESSION['admin'] == null && cp::url()[2] != 'login') {
    header('Location:/' . cp::url()[1] . '/login');
    exit('还未登陆！');
}
