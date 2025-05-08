<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('ssp.class.php');

$database = 'zdsmc_intranet';
$username  = 'root';
$password = '';
$host = '192.168.20.103';


function iso8859_1_to_utf8(string $s): string {
    $s .= $s;
    $len = \strlen($s);

    for ($i = $len >> 1, $j = 0; $i < $len; ++$i, ++$j) {
        switch (true) {
            case $s[$i] < "\x80": $s[$j] = $s[$i]; break;
            case $s[$i] < "\xC0": $s[$j] = "\xC2"; $s[++$j] = $s[$i]; break;
            default: $s[$j] = "\xC3"; $s[++$j] = \chr(\ord($s[$i]) - 64); break;
        }
    }

    return substr($s, 0, $j);
}

$db_intra = new PDO("mysql:host=$host", $username, $password);
$query = "CREATE DATABASE IF NOT EXISTS $database"; 
try {

    $db_intra->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db_intra->exec($query);
    $db_intra->exec("USE $database");

    // $db_intra->exec("CREATE TABLE IF NOT EXISTS `zdsmc_departments` (
    //         `dep_id` VARCHAR(20) PRIMARY KEY,
    //         `dep_name` VARCHAR(255),
    //         `dep_status` VARCHAR(255) DEFAULT 'ACTIVE' ,
    //         `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    //         `last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    //     );
    // ");
    
    $db_intra->beginTransaction();
    $db_intra->commit();

} catch (PDOException $e) {
    die("Error creating database: " . $e->getMessage());
    $db_intra = null;
}

