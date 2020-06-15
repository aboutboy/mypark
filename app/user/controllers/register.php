<?php

// +----------------------------------------------------------------------
// | 域名停靠系统 v2017
// +----------------------------------------------------------------------
// | 版权所有 2016~2018 开源代码 [ http://www.mypark.com ]
// +----------------------------------------------------------------------
// | 官方网站：http://www.mypark.com
// +----------------------------------------------------------------------
// | 作者: 无名小二
// +----------------------------------------------------------------------
if ($_SESSION['user'] > 0) {
    header('Location:/' . cp::url()[2] . '/index');
}
if (@$_GET['do'] == 'validation') {
    if ($_POST['password'] == null) {
        exit('密码不能为空！');
    }
    $user = DB('user')->field('*')->where("username='{$_POST['username']}'")->find();
    if ($user != null) {
        exit('用户已存在！');
    }
    $data = array(
        'username' => $_POST['username'],
        'password' => md5($_POST['password']),
        'regip' => getip(),
        'regtime' => time()
    );
    DB('user')->add($data);
    app::go('login', '注册成功！', 1);
    exit;
}