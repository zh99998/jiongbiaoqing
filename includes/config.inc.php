<?php
/**
 * config,inc.php
 *
 * server configurations
 *
 * @author Tamashii
 * @version 13.12.18
 */

// Database configurations
define('DB_HOST', 'localhost');
define('DB_UID', 'root');
define('DB_PWD', 'root');
define('DB_NAME', 'db_ahegao'); // The database of this name must exist.

// Site configurations
//define('SITE_URL', 'http://jiongbq.com');
define('SITE_URL', 'http://localhost');
define('SITE_NAME', '囧表情 - 在线生成表情制作工具');

// Protracted MySQL connection
$mysqli = new MySQLi(DB_HOST, DB_UID, DB_PWD, DB_NAME);
?>