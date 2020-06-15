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
    if ($user == null) {
        exit('用户不存在！');
    }
    if ($user['enable'] == 0) {
        exit('用户被禁用！');
    }
    if (md5($_POST['password']) == $user['password']) {
        $_SESSION['user'] = $user['username'];
        $data = array(
            "lastip" => getip(),
            'lasttime' => time()
        );
        DB('user')->where("username='{$_POST['username']}'")->save($data);
        exit('登录成功! <script>location.href="/'.cp::url()[1] . '/index";</script>');
    } else {
        exit('密码错误！');
    }
}