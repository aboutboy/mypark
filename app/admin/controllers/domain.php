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

if ($_GET['do'] == null) {
    if ($_GET['cid'] == 'all' || $_GET['cid'] == '') {
        $swhere = '1=1';
        $cwhere = '1=1';
    } else {
        $swhere = 'cid=' . $_GET['cid'];
        $cwhere = 'a.cid=' . $_GET['cid'];
    }
//统计数量
    $count = DB('domain')->where($swhere)->getCount();
//每页显示数量
    $pagesize = 20;
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
//内容查询
    if ($_POST['search'] != null) {
        $where = "a.name LIKE  '%" . $_POST['search'] . "%'";
    } else {
        $where = '1=1';
    }
    $sql = "SELECT b.name as bname,r.name as rname,b.id as bid,a.* 
FROM {$_tb}domain AS a 
LEFT JOIN {$_tb}domain_class AS b ON a.cid = b.id
LEFT JOIN {$_tb}domain_registrar AS r ON a.rid = r.id
WHERE " . $where . " and " . $cwhere . "
ORDER BY  a.id DESC 
LIMIT " . $offset . " , " . $pagesize;
    //echo $sql;exit;
    $rows = DB()->query($sql);
    //var_dump($rows);exit;
} else {
    
    if ($_GET['do'] == 'edit') {//编辑
        $row = DB('domain')->field('*')->where("id={$_GET['id']}")->find();
    } else
    if ($_GET['do'] == 'adds') {//接收添加
        if ($_POST['cid'] <= 0) {
            app::go('', '请选择栏目分类！', 1, 2);
        }
        if ($_POST['title'] == null) {
            app::go('', '标题不能为空！', 1, 2);
        }
        if ($_POST['status']) {
            $status = '1';
        } else {
            $status = '2';
        }
        $data = array(
            "cid" => $_POST['cid'],
            "rid" => $_POST['rid'],
            "name" => $_POST['name'],
            "domain" => $_POST['domain'],
            "title" => $_POST['title'],
            "keywords" => $_POST['keywords'],
            "description" => $_POST['description'],
            "logo" => $_POST['logo'],
            "regtime" => strtotime($_POST['regtime']),
            "stoptime" => strtotime($_POST['stoptime']),
            "data" => base64_encode(serialize($_POST['data'])),
            "url" => $_POST['url'],
            "price" => $_POST['price'],
            "email" => $_POST['email'],
            "qq" => $_POST['qq'],
            "tel" => $_POST['tel'],
            "mobile" => $_POST['mobile'],
            "status" => $status
        );
        //入库主表
        $id = DB('domain')->add($data);

        app::go('domain', '添加成功！', 1);
        exit;
    } elseif ($_GET['do'] == 'edits') {//接收编辑
        if ($_POST['cid'] <= 0) {
            app::go('', '请选择栏目分类！', 1, 2);
        }
        if ($_POST['title'] == null) {
            app::go('', '标题不能为空！', 1, 2);
        }
        if ($_POST['status']) {
            $status = '1';
        } else {
            $status = '2';
        }
        $data = array(
            "cid" => $_POST['cid'],
            "rid" => $_POST['rid'],
            "name" => $_POST['name'],
            "domain" => $_POST['domain'],
            "title" => $_POST['title'],
            "keywords" => $_POST['keywords'],
            "description" => $_POST['description'],
            "logo" => $_POST['logo'],
            "regtime" => strtotime($_POST['regtime']),
            "stoptime" => strtotime($_POST['stoptime']),
            "data" => base64_encode(serialize($_POST['data'])),
            "url" => $_POST['url'],
            "price" => $_POST['price'],
            "email" => $_POST['email'],
            "qq" => $_POST['qq'],
            "tel" => $_POST['tel'],
            "mobile" => $_POST['mobile'],
            "status" => $status
        );
        DB('domain')->where("id={$_GET['id']}")->save($data);

        app::go('domain', '编辑成功！', 1);
    } elseif ($_GET['do'] == 'delete') {//删除处理
        //删除对应内容
        DB('domain')->where("id='{$_GET['id']}'")->delete();
        app::go('domain', '删除成功！', 1);
    }
}