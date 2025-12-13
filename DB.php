<?php
class DB{
    static $host="localhost";
    static $user="root";
    static $pw="";
    static $data="Scholaria";
    public static function select_data($r){
        $cnx=new PDO("mysql:host=".self::$host.";dbname=".self::$data,self::$user,self::$pw);
        $ex=$cnx->query($r);
        return $ex;
    }
    public static function update_data($r){
        $cnx=new PDO("mysql:host=".self::$host.";dbname=".self::$data,self::$user,self::$pw);
        $ex=$cnx->exec($r);
        return $ex;
    }
}
?>