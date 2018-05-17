<?php
/*spl_autoload_register(function($settings){
    include_once($settings . ".inc.php");
});*/

class db
{
    private static $conn;
    public static function getInstance(){
        /*include_once("settings/db.php");*/
        if( is_null( self::$conn ) ){
            //self::$conn = new PDO("'mysql:host=".$settings['server']."; dbname=".$settings['db'].", ".$settings['user'].",".$settings['pw'].";");
            //self::$conn= new PDO("'mysql:host=".$settings["server"]."; dbname=".$settings["db"]."','".$settings["user"]."','".$settings["pw"]."'");
            //var_dump("'mysql:host=".$settings["server"]."; dbname=".$settings["db"]."','".$settings["user"]."','".$settings["pw"]."'");
            
            self::$conn= new PDO('mysql:host=localhost; dbname=birgexe198_amuser', 'birgexe198_amuser', 'test1234');
            return self::$conn;
        } else {
            return self::$conn;
        }
    }
}
?>