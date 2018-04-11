<?php 
include_once("settings.inc.php");
$server = $settings['server'];
$user = $settings['user'];
$pw = $settings['pw'];
$db = $settings['db'];
$port = $settings['port'];
$conn = new mysqli($server, $user, $pw, $db,$port);

/*class Db {
    private static $conn;

    public static function getInstance(){
            if( self::$conn = null ){
            self::$conn= new PDO("mysql:host=".$settings['server']."; port=".$settings['port']."; dbname=".$settings['db'].", ".$settings['user'].",".$settings['pw'].";");
            return self::$conn;
        }
        else{
            return self::$conn;
        }
    }
}

?>*/