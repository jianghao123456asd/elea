<?php
/**
 * Created by PhpStorm.
 * User: JUST LIKE THAT
 * Date: 2018/11/29
 * Time: 22:55
 */

class Db
{public $host;
    public $userName;
    public $userPassword;
    public $dbName;
    public $port;
    public $setCharset;
    public $link;
    //静态


    //第三步，创建一个私有静态属性
    private static $obj = null;

    //构造方法
    //第一步，将构造函数私有化
    private function __construct($arr)
    {
        foreach($arr as $kk => $vv){
            $this -> $kk = $vv;
        }
        $this->connect();
        $this->setCharset();

    }

    //第二步 创建一个共公的静态方法来创建对象
    public static function jianghao($arr){
        if(!isset(self::$obj)){
            self::$obj = new Db($arr);
        }
        return self::$obj;
    }
    public function connect()
    {
        $this->link = mysqli_connect($this->host, $this->userName, $this->userPassword, $this->dbName, $this->port, $this->setCharset) or die("链接数据库失败");
    }
    public function setCharset(){
        $this->setCharset = mysqli_query($this->link,"set names ".$this->setCharset);
    }
    public  function  cha($sql){
        $rua=mysqli_query($this->link,$sql);
        $rr=mysqli_fetch_assoc($rua);
        // var_dump($rr);
        return $rr;

    }

}
Db::jianghao();