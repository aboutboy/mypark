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
 * 全局控制器总类
 */

class app {

    /**
     * 获取GET请求
     * @param type $url
     * @return type
     */
    public static function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        if ($res === FALSE) {
            echo "CURL Error:" . curl_error($curl);
        }
        curl_close($curl);
        return $res;
    }

    /**
     * 发起POST请求
     * @param type $url
     * @param type $data
     * @return type
     */
    public static function httpPost($url, $data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $output = curl_exec($ch);
        if ($output === FALSE) {
            echo "CURL Error:" . curl_error($ch);
        }
        curl_close($ch);
        return $output;
    }

    /**
     * 跳转
     * @param $url 目标地址
     * @param $info 提示信息
     * @param $sec 等待时间
     * @param $type 跳转类型1为跳转指定链接，2为返回上x步
     * @param $go 返回多x步，默认为1
     * return void
     */
    public static function go($url = null, $info = null, $sec = 3, $type = 1, $go = 1) {
        if ($type == 1) {
            //指定跳转
            if (is_null($info)) {
                header("Location:{$url}");
            } else {
                $gourl = "'" . $url . "'";
                echo '<script type="text/javascript">function go(){location.href =' . $gourl . ';}setTimeout(go,' . $sec . '000)</script>';
                echo $info;
            }
        } elseif ($type == 2) {
            //返回x步
            echo $info;
            echo <<<EOF
            <script type="text/javascript">
            setInterval(go,{$sec}000);
            function go(){
                window.history.go(-{$go});
                    }
            </script>
EOF;
        }
        die;
    }

    /**
     * 控制输出字符数，中文不会乱码
     * @param type $str 需要控制的字符值
     * @param type $q 控制数量
     * @param type $coding 编码，默认utf-8
     */
    public static function cout($str, $q, $coding = 'utf-8') {
        $c = self::dc($str);
        if ($c > $q) {
            //检查字符数量，超过控制数量则增加省略号
            return mb_substr($str, 0, $q, $coding) . '...';
        } else {
            return mb_substr($str, 0, $q, $coding);
        }
    }

    /**
     * 检查字符长度
     * @param type $str 检查的字符
     * @param type $coding 编码
     * @return type
     */
    public static function dc($str, $coding = 'utf-8') {
        return mb_strlen($str, $coding);
    }

}

/**
 * 数据库操作
 * @param type $table 要查询的表
 * @return type
 */
function DB($table=NULL) {
    return cp::db($table);
}
