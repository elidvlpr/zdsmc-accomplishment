<?php
require_once('connection_intra.php');

$sql_details = array(
    'user' => $username,
    'pass' => $password,
    'db'   => $database,
    'host' => $host
);

$table = 'zdsmc_employees';
$primaryKey = 'emp_id';
$columns = array(
    array('db' => 'emp_id', 'dt' => 0,),
    array(
        'db' => 'emp_id',
        'dt' => 1,
        'formatter' => function ($d, $row) {
            $fullname = iso8859_1_to_utf8($row['emp_lname']) . ', ' . iso8859_1_to_utf8($row['emp_fname']) . ' ' . iso8859_1_to_utf8($row['emp_mi']);
            return $fullname;
        }
    ),
    array(
        'db' => 'dep_id',
        'dt' => 2,
        'formatter' => function ($d) {
            global $db_intra;
            $sql = "SELECT dep_name FROM zdsmc_departments WHERE dep_id = :dep_id";
            $stmt = $db_intra->prepare($sql);
            $stmt->execute(array(':dep_id' => $d));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return iso8859_1_to_utf8($row['dep_name']);
        }
    ),
    array(
        'db' => 'emp_id',
        'dt' => 3,
        'formatter' => function ($d, $row) {
            return '
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle text-md text-light " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                
                                    <a class="dropdown-item" href="print.php">Print Accomplishment</a>
                               
                            </li>
                        </ul>
                    </div>
                ';
        }
    ),
    array(
        'db' => 'emp_lname',
        'dt' => 4,
        'formatter' => function ($d) {
            return iso8859_1_to_utf8($d);
        }
    ),
    array(
        'db' => 'emp_fname',
        'dt' => 5,
        'formatter' => function ($d) {
            return iso8859_1_to_utf8($d);
        }
    ),
    array(
        'db' => 'emp_mi',
        'dt' => 6,
        'formatter' => function ($d) {
            return iso8859_1_to_utf8($d);
        }
    ),
);



echo json_encode(
    SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns)
);
