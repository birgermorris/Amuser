<?php
class db
{
    private static $conn;
    public static function getInstance(){
        include_once("settings.inc.php");
        if( is_null( self::$conn ) ){
            self::$conn= new PDO("'mysql:host=".$settings['server']."; port=".$settings['port']."'; dbname=".$settings['db'].", ".$settings['user'].",".$settings['pw'].";");
        }
        return self::$conn;
    }
}
?>