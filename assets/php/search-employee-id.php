<?php
require_once 'connection.php';

// Get employee_id from POST request
$employee_id = $_POST['employee_id'];

// SQL query to retrieve employee full name and encoded data
// $query = "SELECT 
//                 TO_CHAR(d.day, 'Month DD, YYYY') AS log_date,
//                 COALESCE(COUNT(h.emp_id), 0) AS encoded,
//                 a.emp_id,
//                 a.h_fullname
//             FROM 
//                 (SELECT 
//                     DATE_TRUNC('month', CURRENT_DATE) + INTERVAL '1 day' * (n - 1) AS day
//                 FROM 
//                     (SELECT generate_series(1, 30) AS n) AS numbers) AS d
//             LEFT JOIN 
//                 his_tracking_logs h ON 
//                     h.log_date::date = d.day
//                     AND h.emp_id = :employee_id
//                     AND h.log_details LIKE '%Forwarded%'
//             LEFT JOIN 
//                 his_account a ON 
//                     a.emp_id = h.emp_id
//             GROUP BY 
//                 d.day, a.emp_id, a.h_fullname
//             ORDER BY 
//                 d.day;";



$query = "SELECT 
            TO_CHAR(d.day, 'Month DD, YYYY') AS log_date,
            COALESCE(COUNT(h.emp_id), 0) AS encoded,
            a.emp_id,
            a.h_fullname
        FROM 
            (SELECT 
                DATE '2025-2-01' + INTERVAL '1 day' * (n - 1) AS day
            FROM 
                (SELECT generate_series(1, 31) AS n) AS numbers) AS d
        LEFT JOIN 
            his_tracking_logs h ON 
                h.log_date::date = d.day
                AND h.emp_id = :employee_id
                AND h.log_details LIKE '%Forwarded%'
        LEFT JOIN 
            his_account a ON 
                a.emp_id = h.emp_id
        GROUP BY 
            d.day, a.emp_id, a.h_fullname
        ORDER BY 
            d.day;
        ;";




// Prepare the SQL statement
$stmt = $db->prepare($query);
$stmt->bindParam(':employee_id', $employee_id);
$stmt->execute();

// Fetch the results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Set the response content type to JSON
header('Content-Type: application/json');

// Function to convert encoding to UTF-8
function my_convert_encoding($item)
{
    if (is_array($item)) {
        return array_map('my_convert_encoding', $item);
    } else if ($item === null) {
        return null;
    } else {
        return mb_convert_encoding($item, 'UTF-8', 'ISO-8859-1');
    }
}

// Apply the encoding conversion to the results
$utf8_encoded_results = array_map('my_convert_encoding', $results);

// Output the JSON-encoded results
echo json_encode($utf8_encoded_results);
?>
