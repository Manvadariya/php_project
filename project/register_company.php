<?php
include_once "config.php";

$company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
$business_email = mysqli_real_escape_string($conn, $_POST['business_email']);
$phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
$website = mysqli_real_escape_string($conn, $_POST['website']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($company_name) && !empty($business_email) && !empty($phone_no) && !empty($website) && !empty($description) && !empty($address) && !empty($password)) {
    // Check if email is valid
    if (filter_var($business_email, FILTER_VALIDATE_EMAIL)) {
        // Check if email already exists
        $sql_check_email = "SELECT * FROM company WHERE business_email = '{$business_email}'";
        $result_check_email = mysqli_query($conn, $sql_check_email);

        if (mysqli_num_rows($result_check_email) > 0) {
            echo "Email already exists";
        } else {
            // Proceed with the registration process
            if (isset($_FILES['logo'])) {
                $img_name = $_FILES['logo']['name'];
                $tmp_name = $_FILES['logo']['tmp_name'];

                $img_explode = explode(".", $img_name);
                $img_extension = strtolower(end($img_explode));

                $extension = ['png', 'jpg', 'jpeg'];
                if (in_array($img_extension, $extension)) {
                    $time = time();
                    $new_img_name = $time . $img_name;

                    if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                        $logo_path = "images/" . $new_img_name;

                        list($width, $height) = getimagesize($logo_path);

                        $sql = mysqli_query($conn, "INSERT INTO `company` (`company_id`, `company_name`, `business_email`, `phone_no`, `website`, `description`, `address`, `logo`, `password`) VALUES (NULL, '{$company_name}', '{$business_email}', '{$phone_no}', '{$website}', '{$description}', '{$address}', '{$logo_path}', '{$password}')");

                        if ($sql) {
                            echo "success";
                        } else {
                            echo "Something went wrong";
                        }
                    } else {
                        echo "Failed to upload image";
                    }
                } else {
                    echo "Please select an image file - png, jpg, jpeg!";
                }
            } else {
                echo "Please upload an image file";
            }
        }
    } else {
        echo "Invalid Business Email Address";
    }
} else {
    echo "All input fields are required";
}
?>
