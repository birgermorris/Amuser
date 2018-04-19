<?php
class db
{
    private static $conn;
    public static function getInstance(){
        include_once("settings.inc.php");
        if( is_null( self::$conn ) ){
            //self::$conn = new PDO("'mysql:host=".$settings['server']."; dbname=".$settings['db'].", ".$settings['user'].",".$settings['pw'].";");
            //self::$conn= new PDO("'mysql:host=".$settings["server"]."; dbname=".$settings["db"]."','".$settings["user"]."','".$settings["pw"]."'");
            //var_dump("'mysql:host=".$settings["server"]."; dbname=".$settings["db"]."','".$settings["user"]."','".$settings["pw"]."'");

            self::$conn= new PDO('mysql:host='.$settings["server"].'; dbname=amuser', 'root', 'root');
            return self::$conn;
        } else {
            return self::$conn;
        }
    }
}
?>