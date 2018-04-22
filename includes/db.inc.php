<?php 
include_once("settings.inc.php");
$server = $settings['localhost'];
$user = $settings['user'];
$pw = $settings['root'];
$db = $settings['amuser'];
$port = $settings['8888'];
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