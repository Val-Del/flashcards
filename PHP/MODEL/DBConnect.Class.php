<?php class DBConnect
{

    private static $db;

    public static function getDb()
    {
        return self::$db;
    }
    public static function Connect()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $servername = Gen__Parameters::getServername();
        $username = Gen__Parameters::getUserBdd();
        $password = Gen__Parameters::getPassBdd();
        $db = Gen__Parameters::getNomBdd();
        $charset = '';

        try {
            $conn = new PDO('mysql:host=' . $servername . ';dbname=' . $db . ';charset=UTF8', $username, $password,  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$db = $conn;
            return 0;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            self::$db = "fail";
            return -1;
        }
    }
    // public static function request($sql){
    //     $db=self::getDb();
    //     $q = $db->prepare($sql);
    //    $q->execute();
    //    return $q->fetchAll(PDO::FETCH_ASSOC);
    // }
}
