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
    array('db' => 'id', 'dt' => 0),
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
    array(
        'db' => 'id',
        'dt' => 3,
        'formatter' => function ($d, $row) {
            return '
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle text-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <button class="dropdown-item" 
                                    data-id="' . iso8859_1_to_utf8($row['id']) . '" 
                                    data-name="' . iso8859_1_to_utf8($row['name']) . '" 
                                    data-date="' . iso8859_1_to_utf8($row['date']) . '" 
                                    data-bs-target="#update" data-bs-toggle="modal">
                                        Update
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item" 
                                    data-emp_id="' . iso8859_1_to_utf8($row['emp_id']) . '" 
                                    data-bs-target="#remove" data-bs-toggle="modal">
                                        Delete
                                </button>
                        </ul>
                    </div>
                ';
        }
    ),
);



echo json_encode(
    SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns)
);
