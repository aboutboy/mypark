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
if ($_GET['do'] == 'sort') {
    //批量调整排序
    for ($i = 0; $i <= count($_POST['id']); $i++) {
        if ($_POST['id'][$i] > 0) {
            DB()->execute("UPDATE  {$_tb}domain_class SET  sort =  {$_POST['sort'][$i]} WHERE id ={$_POST['id'][$i]}");
        }
    }
    exit('设置完成！');
}
if ($_GET['do'] == null || $_GET['do'] == 'edit' || $_GET['do'] == 'add') { //显示所有分类
    $count = DB('domain_class')->getCount();
//每页显示数量
    if ($_GET['do'] == 'edit') {
        $pagesize = '100';
    } else {
        $pagesize = 20;
    }
//获取页数
    $pages = ceil($count / $pagesize);
//当前页码
    if (isset($_GET['page'])) {
        $page = intval($_GET['page']);
    } else {
        $page = 1;
    }
//获取开始
    $offset = $pagesize * ($page - 1);
//分页是否可点
    if ($pages < 2) {
        $class = 'disabled';
    } else {
        $class = null;
    }

    $sql = "SELECT * FROM  `{$_tb}domain_class` ORDER BY  `sort` ASC LIMIT " . $offset . " , " . $pagesize;
    $rows = DB()->query($sql);
}
if ($_GET['do'] == 'adds') {//接收分类添加
    if ($_POST['name'] == null) {
        app::go('class?do=add', '分类名称不能为空', 1);
    }
    if($_POST['sort']==null){
        $_POST['sort']='99';
    }
    $data = array(
        "tid" => $_POST['tid'],
        "name" => $_POST['name'],
        "info" => $_POST['info'],
        "status" => $_POST['status'],
        "sort" => $_POST['sort']
    );
    $id = DB('domain_class')->add($data);
    if ($id > 0) {
        app::go('class', '添加成功！', 1);
    } else {
        app::go('class?do=add', '添加失败！', 1);
    }
}
if ($_GET['do'] == 'edit') {//列出编辑信息
    if ($_GET['id'] == NULL) {
        app::go('class', '未知编辑，请正确进入！', 1);
    }
    $row = DB('domain_class')->where("id={$_GET['id']}")->find();
}

if ($_GET['do'] == 'edits') {//接收编辑信息
    if ($_POST['name'] == null) {
        app::go('', '分类名称不能为空！', 1,2);
    }
    if($_POST['tid']==$_GET['id']){
         app::go('', '上级分类不能是当前分类！', 1,2);
    }
    $data = array(
        "tid" => $_POST['tid'],
        "name" => $_POST['name'],
        "info" => $_POST['info'],
        "status" => $_POST['status'],
        "sort" => $_POST['sort']
    );
    DB('domain_class')->where("id={$_GET['id']}")->save($data);
    app::go('class', '编辑成功！', 1);
}