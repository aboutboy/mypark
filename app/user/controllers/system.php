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

if (@$_GET['do'] == 'sys') {
    $sys = unserialize(file_get_contents(PATH . '/cmspro/data.cmspro'));
    if (is_dir(PATH . '/app/' . $_POST['adminurl'])) {
        
    } else {
        rename(PATH . '/app/' . $_cp->url()[0], PATH . '/app/' . $_POST['adminurl']);
        $go = 1;
    }
    if ($_POST['password'] != '') {
        $data = array(
            'password' => md5($_POST['password']),
            'email' => $_POST['email'],
            'profile' => $_POST['profile'],
            'statistic' => $_POST['count']
        );
    }else{
        $data = array(
            'email' => $_POST['email'],
            'profile' => $_POST['profile'],
            'statistic' => $_POST['count']
        );
    }

    //保存数据
    
    //file_put_contents(PATH . '/cmspro/data.cmspro', serialize($sys));
    DB('user')->where("username='{$_SESSION['user']}'")->save($data);
    if($go==1){
        exit('修改成功！<script>setTimeout(function(){self.location.href="/user/system"},1000);</script>');
    }else{
        exit('修改成功！<script>setTimeout(function(){window.location.reload();},1000);</script>');
    }
} else {
    //读取数据
    //$data = unserialize(file_get_contents(PATH . '/cmspro/data.cmspro'));
    //$sys = $data['sys'];
    $user = DB('user')->field('email,profile,statistic')->where("username='{$_SESSION['user']}'")->find();
}