<?php
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        // check if email is valid or not
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // if email is valid
            // check if email is already in the database or not
            $sql = mysqli_query($conn, "SELECT email FROM candidate WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){ // if email is already in the database
                echo "Email already in the database";
            }else{ // if email is not in the database
                if(isset($_FILES['image'])){ // check if file is uploaded
                    $img_name = $_FILES['image']['name']; // getting image name
                    $tmp_name = $_FILES['image']['tmp_name']; //this temporary image name is used to save/move file in our folder

                    // check if file is image or not
                    $img_explode = explode(".", $img_name);
                    $img_extension = strtolower(end($img_explode));

                    $extension = ['png', 'jpg', 'jpeg']; // valid image extensions
                    if(in_array($img_extension, $extension) === true){ // if file extension is valid
                        $time = time(); // for unique name of images
                        $new_img_name = $time.$img_name;
                        
                        if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                            $random_id = rand(time(), 10000000);
                            
                            $sql2 = mysqli_query($conn, "INSERT INTO `candidate` (`unique_id`, `fname`, `lname`, `email`, `password`, `img`) VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}')");
                            if( $sql2 ){ // if this data inserted
                                $sql3 = mysqli_query($conn, "SELECT * FROM candidate WHERE email = '{$email}'");
                                if(mysqli_num_rows($sql3) > 0){
                                    $row = mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id'] = $row['unique_id'];
                                    echo "success";
                                }
                            }
                            else{
                                echo "Something went wrong";
                            }   
                        }
                    }
                    else{
                        echo "Please select an Image file - png, jpg, jpeg!";
                    }
                }else{
                    echo "Please upload an Image file";
                }
            }
        }
        else{ // if email is not valid
            echo "Invalid Email Address";
        }
    }
    else{
        echo "All input fields are required";
    }
?>