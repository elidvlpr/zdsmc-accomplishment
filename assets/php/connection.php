<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");

$host = '192.168.20.101';
$database   = 'his_zds_mod';
$user = 'postgres';
$pass = 'zdsmc-123456';

$dsn = "pgsql:host=$host;dbname=$database";

if (session_status() == PHP_SESSION_NONE) {
     session_start();
 }

$database = 'zdsmc_intranet';
$username  = 'root';
$password = '';
$host = 'localhost';




$options = [
     PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
     PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $db_posgres = new PDO($dsn, $user, $pass, $options);
     
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$db = new PDO("mysql:host=$host", $username, $password);
$query = "CREATE DATABASE IF NOT EXISTS $database";

try {

     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $db->exec($query);
     $db->exec("USE $database");
 
     $db->exec("CREATE TABLE IF NOT EXISTS `zdsmc_employees` (
             `emp_id` VARCHAR(20) PRIMARY KEY,
             `fullname` VARCHAR(20) NOT NULL,
             `password` VARCHAR(255),
             `emp_status` VARCHAR(255) DEFAULT 'ACTIVE' ,
             `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
             `last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
         );
     ");
     
     $db->beginTransaction();
     $db->commit();
 
 } catch (PDOException $e) {
     die("Error creating database: " . $e->getMessage());
     $db = null;
 }

