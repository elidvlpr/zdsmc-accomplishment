<?php
// Hash'J Programming - hashJProgramming (Joshua Ambalong)

require_once 'connection_intra.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp_id = $_POST['emp_id'];
    $password = $_POST['password'];

    if (empty($emp_id) || empty($password)) {
        $response = array('status' => 'error', 'message' => 'Please fill in all fields!');
        echo json_encode($response);
        exit();
    }

    $sql = "SELECT * FROM zdsmc_employees WHERE emp_id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $emp_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($user && $password == $user['password']) { 
        $_SESSION['emp_id'] = $emp_id;
        $_SESSION['password'] = $password;
        $_SESSION['authenticated'] = true;
        
        if (isset($_POST['remember'])) {
            setcookie('emp_id', $emp_id, time() + (86400 * 30), "/");
            setcookie('password', $password, time() + (86400 * 30), "/");
        } else {
            setcookie('emp_id', '', time() - 3600, "/");
            setcookie('password', '', time() - 3600, "/");

        }

        $response = array('status' => 'success', 'message' => 'User authenticated successfully!', 'password' => $user['password']);
    } else {
        $response = array('status' => 'error', 'message' => 'Invalid employee ID or password!');
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method!');
}

echo json_encode($response);
