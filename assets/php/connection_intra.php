<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");

$host = '192.168.20.103';
$database   = 'zdsmc_intranet';
$username = 'root';
$password = '';

$dsn = "pgsql:host=$host;dbname=$database";

if (session_status() == PHP_SESSION_NONE) {
     session_start();
 }

$options = [
     PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
     PDO::ATTR_EMULATE_PREPARES   => false,
];


$db_intra = new PDO("mysql:host=$host", $username, $password);
$query = "CREATE DATABASE IF NOT EXISTS $database";

try {

     $db_intra->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $db_intra->exec($query);
     $db_intra->exec("USE $database");
 
   
     $db_intra->beginTransaction();
     $db_intra->commit();
 
 } catch (PDOException $e) {
     die("Error creating database: " . $e->getMessage());
     $db_intra = null;
 }

