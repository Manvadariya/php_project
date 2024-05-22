<?php
session_start();
include_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);


    if ($role == 'candidate') {
    // Query to check user credentials
    $sql = "SELECT * FROM candidate WHERE email = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Check if any rows were returned
        $row_count = mysqli_num_rows($result);
        if ($row_count == 1) {
            // User exists, redirect to dashboard or respective page based on role
            $_SESSION['email'] = $username;
            header("Location: candidate_dashboard.php");
        } else {
            // User does not exist or credentials are incorrect
            header("Location: login.php?error=invalid_credentials");
            exit();
        }
    } else {
        // Error in query execution
        echo "Error: " . mysqli_error($conn);
        exit();
    }
}

if ($role == 'company') {
    // Query to check user credentials
    $sql = "SELECT * FROM company WHERE business_email = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        // Check if any rows were returned
        $row_count = mysqli_num_rows($result);
        if ($row_count == 1) {
            // User exists, redirect to dashboard or respective page based on role
            $_SESSION['cemail'] = $username;
            $sql1 = "SELECT company_id FROM `company` WHERE business_email = '$username'";
            $cid = mysqli_query($conn, $sql1);
            $temp = mysqli_fetch_assoc($cid);
            $cid = $temp['company_id'];
            $_SESSION['cid'] = $cid;

            header("Location: company_dashboard.php");
        } else {
            // User does not exist or credentials are incorrect
            header("Location: login.php?error=invalid_credentials");
            exit();
        }
    } else {
        // Error in query execution
        echo "Error: " . mysqli_error($conn);
        exit();
    }
}
} else {
    // Redirect to login page if accessed directly
    header("Location: login.php");
    exit();
}
?>
