<?php
session_start();
$email = $_SESSION['email'];
require_once "config.php";
$sql5 = "SELECT user_id FROM `candidate` WHERE email = 'manvadariya2@gmail.com'";
$result5 = mysqli_query($conn, $sql5);
$row5 = mysqli_fetch_assoc($result5);
$candidate_id = $row5['user_id'];
$sql6 = "SELECT company_id FROM `jobs` WHERE job_id = 40";
$result6 = mysqli_query($conn, $sql6);
$row6 = mysqli_fetch_assoc($result6);
$company_id = $row6['company_id'];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $job_id = $_GET["job_id"];

    $sql = "INSERT INTO `connection` (`company_id`, `user_id`, `job_id`) VALUES ('$company_id', '$candidate_id', '$job_id')";

    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>alert('Application submitted successfully!');</script>";
        header("location: candidate_dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
