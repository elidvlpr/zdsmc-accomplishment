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

$chart_date = [
     'NICU' => '2024-07-15',
     'ER' => '2024-07-15',
     'ICU' => '2024-07-15',
     'PRIVATE' => '2024-07-15',
     'OB' => '2024-04-15',
     'PEDIA' => '2024-04-15',
     'SURGICAL' => '2024-04-15',
     'MEDICAL' => '2024-04-15',
     'RECORDS' => '2024-04-15',
     'PHILHEALTH' => '2024-07-1',
     'CF4' => '2024-07-1',
     'DEFAULT' => '2024-04-15'

];

$options = [
     PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
     PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $db = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
