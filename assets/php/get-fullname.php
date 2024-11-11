<?php
require_once 'connection.php';

// Get employee_id from POST request
$employee_id = $_POST['employee_id'];

// SQL query to retrieve employee full name and encoded data
$query = "SELECT h_fullname
            FROM his_account
            WHERE emp_id = :employee_id;";

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
