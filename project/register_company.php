<?php
// Include database connection
include_once "config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
    $business_email = mysqli_real_escape_string($conn, $_POST['business_email']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Check if all input fields are not empty
    if (!empty($company_name) && !empty($business_email) && !empty($phone_no) && !empty($website) && !empty($description) && !empty($address)) {
        // Check if email is valid
        if (filter_var($business_email, FILTER_VALIDATE_EMAIL)) {
            // Check if email already exists in the database
            $check_email = mysqli_query($conn, "SELECT business_email FROM company WHERE business_email = '{$business_email}'");
            if (mysqli_num_rows($check_email) == 0) {
                // File upload
                $targetDirectory = "uploads/";
                $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check !== false) {
                    // Allow certain file formats
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
                        $uploadOk = 0;
                    } else {
                        // If everything is ok, try to upload file
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                            // File uploaded successfully, insert data into database
                            $sql = "INSERT INTO company (company_name, business_email, phone_no, website, description, address, logo) VALUES ('$company_name', '$business_email', '$phone_no', '$website', '$description', '$address', '$targetFile')";
                            if (mysqli_query($conn, $sql)) {
                                echo "Company registered successfully.";
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            } else {
                echo "Email already exists in the database.";
            }
        } else {
            echo "Invalid email address.";
        }
    } else {
        echo "All input fields are required.";
    }
}

// Close database connection
mysqli_close($conn);
?>
