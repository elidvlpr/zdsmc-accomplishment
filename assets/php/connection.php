<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('ssp.class.php');

$database = 'zdsmc_intranet';
$username  = 'root';
$password = '';
$host = 'localhost';

$db = new PDO("mysql:host=$host", $username, $password);
$query = "CREATE DATABASE IF NOT EXISTS $database";

try {

     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $db->exec($query);
     $db->exec("USE $database");
 
     // $db->exec("CREATE TABLE IF NOT EXISTS `zdsmc_employees` (
     //         `emp_id` VARCHAR(20) PRIMARY KEY,
     //         `fullname` VARCHAR(20) NOT NULL,
     //         `password` VARCHAR(255),
     //         `emp_status` VARCHAR(255) DEFAULT 'ACTIVE' ,
     //         `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     //         `last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
     //     );
     // ");
     
     $db->exec("CREATE TABLE IF NOT EXISTS `holidays` (
             `id` VARCHAR(20) PRIMARY KEY,
             `name` VARCHAR(20) NOT NULL,
             `date` date NOT NULL
         );
     ");

     $db->beginTransaction();
     $db->commit();
 
 } catch (PDOException $e) {
     die("Error creating database: " . $e->getMessage());
     $db = null;
 }

