<?php

//----------------------------------
// MySQL数据库类
//----------------------------------
class Mysql {

    private $host;   //主机地址
    private $dbport; //数据库端口
    private $dbuser; //数据库账号
    private $dbpwd; //数据库密码
    private $dbname; //数据库名
    private $charset; //数据库编码
    static $SQL; //数据库对象
    static $obj = null;
    public $table; //操作表
    private $pre = null;
    private $opt;  //选项

    /**
     * 初始化数据库
     * @param Array $dsn 数据库连接参数
     */

    private function __construct($dsn) {

        $this->host = $dsn['DB_HOST'];
        $this->dbport = $dsn['DB_PORT'];
        $this->dbuser = $dsn['DB_USER'];
        $this->dbpwd = $dsn['DB_PWD'];
        $this->dbname = $dsn['DB_NAME'];
        $this->charset = $dsn['DB_CHARSET'];
        $this->table = $dsn['DB_PREFIX'] . $dsn['DB_TABLE'];
        $this->opt['where'] = '';
        $this->opt['order'] = '';
        $this->opt['limit'] = '';
        $this->opt['field'] = null;

        $this->connect();
    }

    /**
     * 连接数据库
     * @return Bool
     */
    private function connect() {
        try {
            self::$SQL = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";port=" . $this->dbport . ";charset=" . $this->charset, $this->dbuser, $this->dbpwd, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                //默认是PDO::ERRMODE_SILENT, 0, (忽略错误模式)
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ));
        } catch (PDOException $e) {
            header("Content-Type: text/html; charset=utf-8");
            echo "数据库连接失败：" . $e->getMessage();
            exit;
        }
        return true;
    }

    /**
     * @param Array $dsn 数据库连接参数(DB_HOST[主机],DB_NAME[数据库名],DB_PORT[端口],DB_CHARSET[编码],DB_USER[帐户],DB_PWD[密码],DB_TABLE[表名])
     * @return Object
     */
    static function start($dsn) {
        //判断对象是否存在，若已存在则直接返回该对象
        //if(is_null(self::$obj)){
        self::$obj = null;
        self::$obj = new self($dsn);
        //}
        return self::$obj;
    }

    /**
     * 插入数据(成功返回新插入的 自动增长主键，失败返回0)
     * @param Array $data 欲插入的数据，对应表中的键与值
     * @param Int 0 准备语句 ,1 执行语句,2(默认)准备并执行语句 
     * @return Int 
     */
    public function add($data, $type = 2) {
        try {
            //构造SQL语句
            $count = 0;
            $a = '';
            foreach ($data as $k => $v) {
                if ($count != 0) {
                    $a = ',';
                }
                @$key .= $a . '`' . $k . '`';
                @$bind .= $a . "'$v'";
                $count++;
            }
            $s = "INSERT INTO {$this->table}({$key}) VALUES({$bind})";


            //发送语句
            if ($type != 1) {
                $this->pre = self::$SQL->prepare($s);

                if ($type == 0 && is_object($this->pre) == true) {
                    return 1;
                }
            }

            //执行语句
            if ($type != 0) {
                $this->pre->execute();
            }
            //返回最新主键
            return self::$SQL->lastinsertid();
        } catch (PDOException $e) {
            echo '出现异常：<br/>';
            echo '错误出现的位置：' . $e->getFile() . $e->getLine() . '<br/>';
            echo '错误原因：' . $e->getMessage();
            var_dump($e->getTrace()); //获取完整的错误数据
            exit;
        }
    }

    /**
     * 更新数据(返回受影响行)
     * @param void $data 传入更新数组
     * @return Int
     */
    public function save($data) {
        try {
            //构造SQL语句
            $count = 0;
            $a = '';
            foreach ($data as $k => $v) {
                if ($count != 0) {
                    $a = ',';
                }
                @$bind .= $a . "`$k`=:$k";
                $count++;
            }
            $s = "UPDATE {$this->table} SET {$bind} {$this->opt['where']}";

            //发送语句
            $this->pre = self::$SQL->prepare($s);
            //执行语句
            $this->pre->execute($data);
            //返回受影响行
            return $this->pre->rowCount();
        } catch (PDOException $e) {
            echo '出现异常：<br/>';
            echo '错误出现的位置：' . $e->getFile() . $e->getLine() . '<br/>';
            echo '错误原因：' . $e->getMessage();
            var_dump($e->getTrace()); //获取完整的错误数据
            exit;
        }
    }

    /**
     * 指定字段加N，默认加1 
     * @param String $key 字段
     * @param Int $num [可选]裕增加的数值，默认1
     * @return Int
     */
    public function sum($key, $num = 1) {
        try {
            $s = "UPDATE `{$this->table}` set `{$key}`={$key}+{$num} {$this->opt['where']}";
            //发送语句
            $this->pre = self::$SQL->prepare($s);
            //执行语句
            $this->pre->execute();
            //返回受影响行
            return $this->pre->rowCount();
        } catch (PDOException $e) {
            echo '出现异常：<br/>';
            echo '错误出现的位置：' . $e->getFile() . $e->getLine() . '<br/>';
            echo '错误原因：' . $e->getMessage();
            var_dump($e->getTrace()); //获取完整的错误数据
            exit;
        }
    }

    /**
     * 删除数据(返回受影响行)
     * @return Int
     */
    public function delete() {
        try {
            $s = "DELETE FROM `{$this->table}` {$this->opt['where']}";
            //发送语句
            $this->pre = self::$SQL->prepare($s);
            //执行语句
            $this->pre->execute();
            //返回受影响行
            return $this->pre->rowCount();
        } catch (PDOException $e) {
            echo '出现异常：<br/>';
            echo '错误出现的位置：' . $e->getFile() . $e->getLine() . '<br/>';
            echo '错误原因：' . $e->getMessage();
            var_dump($e->getTrace()); //获取完整的错误数据
            exit;
        }
    }

    /**
     * 取数据集(返回符合条件的所有数据)
     * @return array 
     */
    public function select() {
        try {
            $s = "SELECT " . ($this->opt['field'] ? $this->opt['field'] : '*') . " FROM `{$this->table}` {$this->opt['where']} {$this->opt['order']} {$this->opt['limit']}";
            //发送语句
            $this->pre = self::$SQL->prepare($s);
            //执行语句
            $this->pre->execute();
            //设置返回关联数组
            $this->pre->setFetchMode(PDO::FETCH_ASSOC);
            return $this->pre->fetchAll();
        } catch (PDOException $e) {
            echo '出现异常：<br/>';
            echo '错误出现的位置：' . $e->getFile() . $e->getLine() . '<br/>';
            echo '错误原因：' . $e->getMessage();
            var_dump($e->getTrace()); //获取完整的错误数据
            exit;
        }
    }

    /**
     * 取一行数据(只返回第一条数据)
     * @return array  
     */
    public function find() {
        try {
            $s = "SELECT " . ($this->opt['field'] ? $this->opt['field'] : '*') . " FROM `{$this->table}` {$this->opt['where']} {$this->opt['order']} LIMIT 1";
            echo $this->opt['order'];
            $this->pre = self::$SQL->prepare($s);
            //执行语句
            $this->pre->execute();
            //设置返回关联数组
            $this->pre->setFetchMode(PDO::FETCH_ASSOC);
            $arr = $this->pre->fetchAll();
            if (count($arr) > 0) {
                return $arr[0];
            }
            return null;
        } catch (PDOException $e) {
            echo '出现异常：<br/>';
            echo '错误出现的位置：' . $e->getFile() . $e->getLine() . '<br/>';
            echo '错误原因：' . $e->getMessage();
            var_dump($e->getTrace()); //获取完整的错误数据
            exit;
        }
    }

    /**
     * 取指定字段值(当只有一条数据时，直接返回键值，否则返回数组,失败返回false)
     * @param String $key 指定字段名
     * @return mixed
     */
    public function getField($key) {
        try {
            $opt['field'] = $key;
            $selArr = $this->select();
            foreach ($selArr as $number => $value) {
                $retuls[$number] = $value[$key];
            }

            if (@$retuls == null)
                $retuls = false;
            //判断是否单只有一条数据
            if (count($retuls) == 1 and $retuls != false) {
                $retuls = $retuls[0];
            }
            return $retuls;
        } catch (PDOException $e) {
            echo '出现异常：<br/>';
            echo '错误出现的位置：' . $e->getFile() . $e->getLine() . '<br/>';
            echo '错误原因：' . $e->getMessage();
            var_dump($e->getTrace()); //获取完整的错误数据
            exit;
        }
    }

    /**
     * 设定指定字段值
     * @param String $key 指定字段名
     * @param mixed $value 字段值
     * @return mixed
     */
    public function setField($key, $value) {
        return $this->save(array($key => $value));
    }

    /**
     * 取符合条件的数据总行数
     */
    public function getCount() {
        try {
            $s = "SELECT COUNT(*) as count FROM `{$this->table}` {$this->opt['where']}";
            $this->pre = self::$SQL->prepare($s);
            //执行语句
            $this->pre->execute();
            $count = $this->pre->fetch();
            return Intval($count['count']);
        } catch (PDOException $e) {
            echo '出现异常：<br/>';
            echo '错误出现的位置：' . $e->getFile() . $e->getLine() . '<br/>';
            echo '错误原因：' . $e->getMessage();
            var_dump($e->getTrace()); //获取完整的错误数据
            exit;
        }
    }

    /**
     * 查询条件
     * @param String $where 查询条件
     * @return this
     */
    public function where($where) {
        $this->opt['where'] = $where ? "WHERE " . $where : '';
        return $this;
    }

    /**
     * 指定排序
     * @param String $order 排序规则  desc.倒序    asc.正序
     * @return this
     */
    public function order($order) {
        $this->opt['order'] = $order ? "ORDER BY " . $order : '';
        return $this;
    }

    /**
     * 指定欲取的数据条数
     * @param Int $min 只传一个参数时，传入欲取的数据条数；否则传入记录偏移量，从0开始
     * @param Int $max 欲取的的数据条数
     * @return this
     */
    public function limit($min, $max = null) {
        $this->opt['limit'] = "LIMIT " . intval($min) . ($max ? ',' . intval($max) : '');
        return $this;
    }

    /**
     * 指定欲取的字段
     * @param String $field 指定字段名称，多个请以(,)分号隔开
     * @param this
     */
    public function field($field) {
        $this->opt['field'] = $field;
        return $this;
    }

    //执行SQL语句，返回受影响行
    public function execute($sql, $param) {
        try {
            //发送语句
            $this->pre = self::$SQL->prepare($sql);
            //执行语句
            $this->pre->execute($param);
            //返回受影响行
            return $this->pre->rowCount();
        } catch (PDOException $e) {
            echo '出现异常：<br/>';
            echo '错误出现的位置：' . $e->getFile() . $e->getLine() . '<br/>';
            echo '错误原因：' . $e->getMessage();
            var_dump($e->getTrace()); //获取完整的错误数据
            exit;
        }
    }

    //执行SQL语句，返回数据集
    public function query($sql, $param=NULL) {
        try {
            //发送语句
            $this->pre = self::$SQL->prepare($sql);
            //执行语句
            $this->pre->execute($param);
            //设置返回关联数组
            $this->pre->setFetchMode(PDO::FETCH_ASSOC);
            return $this->pre->fetchAll();
        } catch (PDOException $e) {
            echo '出现异常：<br/>';
            echo '错误出现的位置：' . $e->getFile() . $e->getLine() . '<br/>';
            echo '错误原因：' . $e->getMessage();
            var_dump($e->getTrace()); //获取完整的错误数据
            exit;
        }
    }

}

?>