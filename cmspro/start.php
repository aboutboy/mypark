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
/*
 * 域名停靠系统系统各种类入口
*/
//载入基本配置
require PATH . "/cmspro/config.php";
//载入系统操作类
require PATH . "/cmspro/class.php";
//错误输出
cp::error();
class cmspro {
    /**
     * 系统框架引导
     */
    public static function init() {
        //安全过滤
        cp::webscan(1,_ADMIN_,_URL_);
        //采用目录结构方式
        $url = cp::url();
        //控制器
        if ($url[1] != '') {
            $controller = $url[1];
        } else {
            $controller = 'index';
        }
        //在可以获取控制器功能文件的情况下定义控制器文件名
        //var_dump($url);exit;
        if (empty($url[2])) {
            $appsfile = 'index';
        } elseif ($url[2] != '') {
            $appsfile = $url[2];
        } else {
            $appsfile = 'index';
        }
        //得到控制器的目录
        $Controller_dir = APP_PATH . $controller . '/';
        //得到控制器的路径
        $method = APP_PATH . $controller . '/controllers/' . $appsfile . '.php';
        //得到控制器的总函数
        $function1 = APP_PATH . $controller . '/class.php';
        //得到控制器的函数
        $function2 = APP_PATH . $controller . '/class/' . $appsfile . '.php';
        //得到控制器公共文件
        $common = APP_PATH . $controller . '/common.php';
        //系统总自定义类
        require APP_PATH . '/class.php';
        //系统总公共全局
        require APP_PATH . '/common.php';
        //判断控制器总函数是否存在
        if (file_exists($function1)) {
            require $function1;
        }
        //判断控制器函数是否存在
        if (file_exists($function2)) {
            require $function2;
        }
        //判断控制器公共文件是否存在
        if (file_exists($common)) {
            require $common;
        }
        if (!is_dir($Controller_dir)) {
            exit($controller . '控制器不存在'.$Controller_dir);
        }
        //判断控制器文件是否存在
        if (file_exists($method)) {
            //输出方法
            if (file_exists($Controller_dir . 'view/' . $appsfile . '.php')) { //检查方法模板是否存在
                require $method;
                require $Controller_dir . 'view/' . $appsfile . '.php';
            } else { //不存在则直接输出方法
                require $method;
            }
        } else {
            exit($controller.'控制器中的' . $appsfile . '方法不存在');
        }
    }
}
