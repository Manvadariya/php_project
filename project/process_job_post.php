<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    include_once "config.php";

    // Retrieve form data
    $job_post = $_POST['job_post'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $job_description = $_POST['job_description'];
    $experience_required = $_POST['experience_required'];

    // Validate form data
    $errors = [];

    // Example validation - check if fields are not empty
    if (empty($job_post) || empty($location) || empty($salary) || empty($job_description) || empty($experience_required)) {
        $errors[] = "All fields are required";
    }

    // If there are no errors, proceed with inserting data into the database
    if (empty($errors)) {
        // Insert data into the database table (use prepared statements to prevent SQL injection)
        $stmt = $conn->prepare("INSERT INTO jobs (job_post, location, salary, job_description, experience_required) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $job_post, $location, $salary, $job_description, $experience_required);

        if ($stmt->execute()) {
            echo "Job posted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // If there are errors, display them
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: job_form.html");
    exit();
}
?>
