<?php
class DqMysql
{
    static $objMysql = null;

    static public function getDbInstance()
    {
        static $time=0;

        if(time() - $time >10){
            self::$objMysql = null;
        }

        if(empty($time) || empty(self::$objMysql)) {

            $dbms = 'mysql';     //数据库类型
            $host = '127.0.0.1'; //数据库主机名
            $port = '3306';
            $dbName = 'face';    //使用的数据库
            $user = '11';      //数据库连接用户名
            $pass = '33';          //对应的密码
            $dsn = "$dbms:host=$host;dbname=$dbName;port=$port;";
            try {
                $dbh = new PDO($dsn, $user, $pass,
                    array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_TIMEOUT => 3)
                ); //初始化一个PDO对象
                self::$objMysql = $dbh;
                $time = time();
                return $dbh;
            } catch (PDOException $e) {
                return null;
            }
        }
        return self::$objMysql;
    }

    public static function insertData($table, $arrDatas)
    {
        $fileds = implode(',', array_keys($arrDatas));

        if (empty($fileds)) {
            echo 'empty data' . "\n";
            return;
        }
        $sql = 'replace INTO ' . $table . ' (' . $fileds . ') VALUES ';
        $str = '';

        $str .= '("' . implode('","', $arrDatas) . '"),';

        $str = trim($str, ',');
        $sql .= $str;

        if(self::getDbInstance()->query($sql)){
            return self::getDbInstance()->lastInsertId();
        }else{
            return false;
        }
    }

    public static function updateData($table, $arrDatas, $condition)
    {

        $fileds = '';
        foreach ($arrDatas as $k => $v) {
            $fileds .= $k . "='" . $v . "',";
        }
        $fileds = trim($fileds, ',');
        $sql = 'update    ' . $table . ' set  ' . $fileds . ' where ' . $condition;
        return self::getDbInstance()->query($sql);
    }

    public static function select($table, $condition = '', $page = 1, $size = 10000)
    {
        $sql = 'select * from ' . $table;
        if (!empty($condition)) {
            $sql .= ' where ' . $condition;
        }
        $start = ($page - 1) * $size;
        $sql .= ' order by id desc ';
        $sql .= ' limit ' . $start . ',' . $size;
        $obj = self::getDbInstance();
        if(empty($obj)){
            return array();
        }
        $statement = $obj->prepare($sql);
        $statement->execute();
        $arr = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $arr;
    }

    public static function selectCount($table, $condition = '')
    {
        $sql = 'select count(*) as total from ' . $table;
        if (!empty($condition)) {
            $sql .= ' where ' . $condition;
        }
        $sql .= ' order by id desc ';
        $obj = self::getDbInstance();
        if(empty($obj)){
            return 0;
        }
        $statement = $obj->prepare($sql);
        $statement->execute();
        $arr = $statement->fetchAll(PDO::FETCH_ASSOC);
        return isset($arr[0]['total']) ? $arr[0]['total'] : 0;
    }

    public static function delete($table,$id){
        $sql = 'delete from '.$table.' where id='.$id;
        return self::getDbInstance()->query($sql);
    }
}


