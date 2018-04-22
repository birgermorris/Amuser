<?php

spl_autoload_register(function($inc){
    include_once("includes/". $inc . ".inc.php");
});
class db
{
    private static $conn;
    public static function getInstance(){

        if( is_null( self::$conn ) ){
            //self::$conn = new PDO("'mysql:host=".$settings['server']."; dbname=".$settings['db'].", ".$settings['user'].",".$settings['pw'].";");
            //self::$conn= new PDO("'mysql:host=".$settings["server"]."; dbname=".$settings["db"]."','".$settings["user"]."','".$settings["pw"]."'");
            //var_dump("'mysql:host=".$settings["server"]."; dbname=".$settings["db"]."','".$settings["user"]."','".$settings["pw"]."'");

            self::$conn= new PDO('mysql:host='.$settings["server"].'; dbname=amuser', $settings["user"], $settings["pw"]);
            return self::$conn;
        } else {
            return self::$conn;
        }
    }
}
?>