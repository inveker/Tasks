<?php 

define('DB', array(
        'user' => 'root',
        'pass' => 'get5',
        'host' => 'localhost',
        'dbname' => 'task',
        'charset' => 'utf8'));

class DB
{
    protected static $instance = null;

    public function __construct() {}
    public function __clone() {}

    public static function instance()
    {
        if (self::$instance === null) {
            $opt  = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => TRUE,
            );
            $dsn = 'mysql:host=' . DB['host'] . ';dbname=' . DB['dbname'] . ';charset=' . DB['charset'];
            self::$instance = new PDO($dsn, DB['user'], DB['pass'], $opt);
        }
        return self::$instance;
    }

    public static function run($sql, ...$args)
    {
        if (!$args) {
            return self::instance()->query($sql);
        }
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}