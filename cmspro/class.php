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

cp::re('mysql');

/**
 * 域名停靠系统 v1.0.0系统基础类
 */
class cp {

    /**
     * 创建数据库对象
     * @param type $table 要操作的表名
     * @return Object
     */
    public static function db($table) {
        $conn['DB_HOST'] = DB_HOST;
        $conn['DB_PORT'] = DB_PORT;
        $conn['DB_USER'] = DB_USER;
        $conn['DB_PWD'] = DB_PWD;
        $conn['DB_NAME'] = DB_NAME;
        $conn['DB_PREFIX'] = DB_PREFIX;
        $conn['DB_CHARSET'] = DB_CHARSET;
        $conn['DB_TABLE'] = $table;
        return Mysql::start($conn);
    }

    /**
     * 安全过滤
     * @param type $webscan_switch 拦截开关(1为开启，0关闭)
     * @param type $webscan_white_directory 后台白名单,后台操作将不会拦截,添加"|"隔开白名单目录下面默认是网址带 /admin/dede/ 放行
     * @param type $webscan_white_url url白名单,可以自定义添加url白名单 写法：比如cmspro 后台目录为admin时操作index.php?url=admin 
     */
    public static function webscan($webscan_switch = 1, $webscan_white_directory = null, $webscan_white_url = null) {
        if ($webscan_white_directory == null) {
            $webscan_white_directory = _ADMIN_;
        }
        if ($webscan_white_url == null) {
            $webscan_white_directory = _URL_;
        }
        //载入安全过滤组件
        self::re('webscan');
        // 过滤请求参数
        if (count($_REQUEST) > 0) {
            foreach ($_REQUEST as $key => $value) {
                $_REQUEST[$key] = htmlentities($value, ENT_QUOTES, "UTF-8");
            }
        }
        //get拦截规则
        $getfilter = "\\<.+javascript:window\\[.{1}\\\\x|<.*=(&#\\d+?;?)+?>|<.*(data|src)=data:text\\/html.*>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\(|benchmark\s*?\(.*\)|sleep\s*?\(.*\)|\\b(group_)?concat[\\s\\/\\*]*?\\([^\\)]+?\\)|\bcase[\s\/\*]*?when[\s\/\*]*?\([^\)]+?\)|load_file\s*?\\()|<[a-z]+?\\b[^>]*?\\bon([a-z]{4,})\s*?=|^\\+\\/v(8|9)|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.*\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)|UPDATE\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)@{0,2}(\\(.+\\)|\\s+?.+?\\s+?|(`|'|\").*?(`|'|\"))FROM(\\(.+\\)|\\s+?.+?|(`|'|\").*?(`|'|\"))|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)|<.*(iframe|frame|style|embed|object|frameset|meta|xml)|hacker";
        //post拦截规则 去掉 |\\b(alert\\( 不然提交颜色代码会被拦截
        $postfilter = "<.*=(&#\\d+?;?)+?>|<.*data=data:text\\/html.*>|confirm\\(|expression\\(|prompt\\(|benchmark\s*?\(.*\)|sleep\s*?\(.*\)|\\b(group_)?concat[\\s\\/\\*]*?\\([^\\)]+?\\)|\bcase[\s\/\*]*?when[\s\/\*]*?\([^\)]+?\)|load_file\s*?\\()|<[^>]*?\\b(onerror|onmousemove|onload|onclick|onmouseover)\\b|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.*\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)|UPDATE\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)(\\(.+\\)|\\s+?.+?\\s+?|(`|'|\").*?(`|'|\"))FROM(\\(.+\\)|\\s+?.+?|(`|'|\").*?(`|'|\"))|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)|<.*(iframe|frame|style|embed|object|frameset|meta|xml)|hacker";
        //cookie拦截规则
        $cookiefilter = "benchmark\s*?\(.*\)|sleep\s*?\(.*\)|load_file\s*?\\(|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.*\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)|UPDATE\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)@{0,2}(\\(.+\\)|\\s+?.+?\\s+?|(`|'|\").*?(`|'|\"))FROM(\\(.+\\)|\\s+?.+?|(`|'|\").*?(`|'|\"))|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
        //referer获取
        $webscan_referer = empty($_SERVER['HTTP_REFERER']) ? array() : array('HTTP_REFERER' => $_SERVER['HTTP_REFERER']);
        //拦截过滤
        if ($webscan_switch && webscan_white($webscan_white_directory, $webscan_white_url)) {
            if (_WEBSCAN_GET_) {
                foreach ($_GET as $key => $value) {
                    webscan_StopAttack($key, $value, $getfilter, "GET");
                }
            }
            if (_WEBSCAN_POST_) {
                foreach ($_POST as $key => $value) {
                    webscan_StopAttack($key, $value, $postfilter, "POST");
                }
            }
            if (_WEBSCAN_COOKIE_) {
                foreach ($_COOKIE as $key => $value) {
                    webscan_StopAttack($key, $value, $cookiefilter, "COOKIE");
                }
            }
            if (webscan_referre) {
                foreach ($webscan_referer as $key => $value) {
                    webscan_StopAttack($key, $value, $postfilter, "REFERRER");
                }
            }
        }
    }

    /**
     * url请求输出
     * @param type $type 类型 为空默认输出目录结构 | h获取当前是http还是https并输出 | d 输出当前域名 |g 当前GET信息
     */
    public static function url($type = null) {
        //获取http或https方式
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        //获取当前地址栏全部信息
        $url = $http_type . $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
        //格式化为数组
        $request = explode("/", $url);
        //处理类型信息
        foreach ($request as $res) {
            //排除点以后的数据
            $php = strpos($res, ".php");
            $html = strpos($res, ".html");
            $htm = strpos($res, ".htm");
            //排除GET参数
            $site = strpos($res, "?");
            if ($site > 0) {
                if ($php > 0) {
                    $contents[] = substr($res, 0, $php);
                } elseif ($html > 0) {
                    $contents[] = substr($res, 0, $html);
                } elseif ($htm > 0) {
                    $contents[] = substr($res, 0, $htm);
                } else {
                    $contents[] = substr($res, 0, $site);
                }
            } elseif ($dot > 0) {
                $contents[] = substr($res, 0, $dot);
            } else {
                $contents[] = $res;
            }
        }
        //循环
        for ($i = 0; $i <= count($contents); $i++) {
            //排除http或https
            if ($i < 2 || count($contents) == $i) {
                
            } else {
                $null[] = $contents[$i];
            }
        }
        //目录结构
        if ($type == null) {
            $urls = $null;
        } else
        //当前是http还是https并输出
        if ($type == 'h') {
            $urls = $urls = substr($contents[0], 0, -1);
        } else
        //当前是http还是https并输出
        if ($type == 'd') {
            $urls = $contents[2];
        } else
        //当前GET信息
        if ($type == 'g') {
            foreach ($_GET as $a => $b) {
                if (gettype(strpos($a, "/")) == 'integer') {
                    
                } else {
                    $urls[$a] = $b;
                }
            }
        }
        return $urls;
    }

    /**
     * 自动附加封装类、函数入口
     * @param type $re
     */
    public static function re($re = NULL) {
        if (file_exists(PATH . "/cmspro/lib/" . $re . ".lib.php")) {
            require_once PATH . "/cmspro/lib/" . $re . ".lib.php";
        }
    }

    /**
     * 错误输出
     * @param type $value on开启输出 off或其它值为关闭
     * @return type
     */
    public static function error() {
        error_reporting(0);

        function cache_shutdown_error() {
            $_error = error_get_last();
            if ($_error && in_array($_error['type'], array(1, 4, 16, 64, 256, 4096, E_ALL))) {
                $info = <<<EOF
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>系统内部出错</title>
<style>
*{margin:0;padding:0;color:#2196F6}
body{font-size:14px;font-family:"宋体"}
.main{width:90%;margin:3% auto;}
.title{background: #ff9800;color: #fff;font-size: 16px;height: 40px;line-height: 40px;padding-left: 20px;border: 1px dashed #009688;}
.content{background-color:#f3f7f9; height:330px;border:1px dashed #c6d9b6;padding:20px}
.t1{border-bottom: 1px dashed #009688;color: #ff4000;font-weight: bold; margin: 0 0 20px; padding-bottom: 18px;}
.t2{margin-bottom:8px; font-weight:bold}
ol{margin:0 0 20px 22px;padding:0;}
ol li{line-height:30px}
.center {line-height: 50px;text-align:center;}
</style>
</head>
<body>
\t<div class="main">
\t\t<div class="center"><a href="http://www.mypark.com"><img src="http://www.mypark.com/public/static/index/img/logo.png" alt="域名停靠系统"></a></div>
\t\t<div class="title">系统内部出错</div>
\t\t<div class="content">
\t\t\t<p class="t1">您访问的页面程序出现错误</p>
\t\t\t<p class="t2">可能原因：</p>
\t\t\t<ol>
\t\t\t\t<li>数据库错误!</li>
\t\t\t\t<li>程序代码不规范!</li>
\t\t\t</ol>
\t\t\t<p class="t2">捕捉信息：</p>
\t\t\t<ol>
\t\t\t\t<li>错误类型：{$_error['type']}</li>
\t\t\t\t<li>错误信息：{$_error['message']}</li>
\t\t\t\t<li>所在文件：{$_error['file']}</li>
\t\t\t\t<li>所在的行：{$_error['line']}</li>
\t\t\t</ol>
\t\t</div>
<div class="center">Powered by <a href="http://www.mypark.com" target="_blank">域名停靠系统</a> © <a href="http://www.mypark.com" target="_blank">mypark.com </a></div>
\t</div>
</body>
</html>
EOF;
                if (ERROR == 'on') {
                    exit($info);
                } else {
                    exit('本页出现致命错误！无法正常显示内容，请联系管理员处理。');
                }
            }
        }

        register_shutdown_function("cache_shutdown_error");
    }

}
