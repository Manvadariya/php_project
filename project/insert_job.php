<?php
session_start();
include_once "config.php";

echo "hello";
// Retrieve form data
$job_post = mysqli_real_escape_string($conn, $_POST['job_post']);
$location = mysqli_real_escape_string($conn, $_POST['location']);
$salary = mysqli_real_escape_string($conn, $_POST['salary']);
$job_description = mysqli_real_escape_string($conn, $_POST['job_description']);
$experience_required = mysqli_real_escape_string($conn, $_POST['experience_required']);

// Insert data into database
$sql = "INSERT INTO `jobs` (`company_id`, `job_post`, `location`, `salary`, `job_description`, `experience_required`) 
        VALUES (NULL, '$job_post', '$location', '$salary', '$job_description', '$experience_required')";

if (mysqli_query($conn, $sql)) {
    echo "<script>
        alert('Job posted successfully: Job Post: $job_post, Location: $location, Salary: $salary, Job Description: $job_description, Experience Required: $experience_required');
    </script>";
    
	header("Location: company_dashboard.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>
