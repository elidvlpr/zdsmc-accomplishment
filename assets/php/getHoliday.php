<?php
require_once('connection.php');

$sql_details = array(
    'user' => $username,
    'pass' => $password,
    'db'   => $database,
    'host' => $host
);

$table = 'holidays';
$primaryKey = 'id';
$columns = array(
    array('db' => 'id', 'dt' => 0,),
    array(
        'db' => 'name',
        'dt' => 1),
    array(
        'db' => 'date',
        'dt' => 2,
        'formatter' => function ($d) {
            return date('F j, Y h:i A', strtotime($d));
        }
    ),
);



echo json_encode(
    SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns)
);
