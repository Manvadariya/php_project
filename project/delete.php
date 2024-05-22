<?php
// Process delete operation after confirmation
if (isset($_POST["job_id"]) && !empty($_POST["job_id"])) {
    // Include config file
    require_once "config.php";

    // Prepare a delete statement
    $sql = "DELETE FROM `jobs` WHERE job_id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_job_id);

        // Set parameters
        $param_job_id = trim($_POST["job_id"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records deleted successfully. Redirect to landing page
            header("location: company_dashboard.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);


    mysqli_close($conn);
} else {
    // Check existence of job_id parameter
    if (empty(trim($_GET["job_id"]))) {
        // URL doesn't contain job_id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="images/11.png">

    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>
        .box{
            width: 400px;
            border-radius: 5px;
            margin: 0 auto;
            justify-content: center;
            text-align: center;
            transform: translate(0%, 35vh);
            border: 1px solid black;
            box-shadow: 0 0 10px 0 rgba(0,0,0,0.2);
            background-color: #ebecec;
        }
        #sub{
            background-color: #e10707;
            color: white;
            padding: 10px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        #no{
            background-color: #77d372;
            color: white;
            padding: 12px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
<body>
    <div class="box">
        <h1>Delete Record</h1>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <input type="hidden" name="job_id" value="<?php echo trim($_GET["job_id"]); ?>"/>
            <p>Are you sure you want to delete this record?</p><br/>
                <p>
                    <input type="submit" id="sub" value="Yes">
                    <a href="company_dashboard.php" id="no">No</a>
                </p>
        </form>
    </div>
</body>

</html>
  
