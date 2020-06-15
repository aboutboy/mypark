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

/*
 * 当前控制器总类
 */

/**
 * 数据数组设置层级.
 *
 * @param array  $category   数据数组.
 * @param string $pid  父级id.
 * @param string $level      层级id.
 *
 * @return array.
 */
function categoryTree($category, $pid = 0, $level = 0) {
    static $res = array();
    foreach ($category as $v) {
        if ($v['tid'] == $pid) {
            $v['level'] = $level;
            $res[] = $v;
            categoryTree($category, $v['id'], $level + 1);
        }
    }
    return $res;
}

/**
 * 显示下拉框.
 *
 * @param array  $list    数据数组.
 * @param string $id  选中id.
 *
 * @return string.
 */
function showSelect($list, $tid = 0, $gid = NULL, $id = NULL) {
    foreach ($list as $row) {
        $select = '';
        if ($tid == $row['id']) { //编辑一级
            $str .= '<option value="' . $row['id'] . '" selected>' . str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $row['level']) . '|---' . $row['name'] . '</option>';
        } else {
            $str .= '<option value="' . $row['id'] . '">' . str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $row['level']) . '|---' . $row['name'] . '</option>';
        }
    }
    return $str;
}

function showlist($list) {
    foreach ($list as $row) {
        $edit = ' <a href="domain?cid=' . $row['id'] . '" class="btn btn-sm btn-primary btn-addon"><i class="fa fa-eye"></i>查看</a> <a href="domain?do=add&cid=' . $row['id'] . '" class="btn btn-sm btn-success btn-addon"><i class="fa fa-plus"></i>添加</a>';
        $select = '';
        $str .= '<tr><th><input class="form-control" style="width: 48px;" type="text" name="sort" value="' . $row['sort'] . '"> <input type="hidden" name="id" value="' . $row['id'] . '"></th><th>' . $row['id'] . '</th><th>' . str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $row['level']) . '|---' . $row['name'] . '</th><th>' . $row['info'] . '</th><th><a href="?do=edit&id=' . $row['id'] . '" class="btn btn-sm btn-info btn-addon"><i class="fa fa-edit"></i>编辑</a> ' . $edit . '</th></tr>';
    }
    return $str;
}

function pages($page, $class, $pages, $annex = null) {
    //分页附加值
    if ($annex == NULL) {
        $annexs = NULL;
    } else {
        $annexs = $annex;
    }
    if (($page - 1) > 0) { //上一页
        $shang .= '<li class="' . $class . '">';
        $shang .= '<a href="?page=' . ($page - 1) . $annexs . '">&laquo;</a>';
        $shang .= '</li>';
    } else {
        $shang .= '<li class="disabled">';
        $shang .= '<a>&laquo;</a>';
        $shang .= '</li>';
    }
    if (($page + 1) <= $pages) {//下一页
        $xia .= '<li class="' . $class . '">';
        $xia .= '<a href="?page=' . ($page + 1) . $annexs . '">&raquo;</a>';
        $xia .= '</li>';
    } else {
        $xia .= '<li class="disabled">';
        $xia .= '<a>&raquo;</a>';
        $xia .= '</li>';
    }
    $list .= '<footer class="panel-footer">';
    $list .= '<ul class="pagination">';
    $list .= '<li class="' . $class . '">';
    $list .= '<a href="?page=1' . $annexs . '">首页</a>';
    $list .= '</li>';
    $list .= $shang;
    $list .= '<li class="disabled">';
    $list .= '<a>第' . $page . '页</a>';
    $list .= '</li>';
    $list .= $xia;
    $list .= '<li class="' . $class . '">';
    $list .= '<a href="?page=' . $pages . $annexs . '">尾页</a>';
    $list .= '</li>';
    $list .= '<li class="disabled">';
    $list .= '<a>共' . $pages . '页</a>';
    $list .= '</li>';
    $list .= '</ul>';
    $list .= '</footer>';
    return $list;
}
