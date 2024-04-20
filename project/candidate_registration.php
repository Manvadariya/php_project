<!DOCTYPE html>
<html>
<head>
  <title>Candidate Registration</title>
  <link rel="stylesheet" href="login.css">
  <link rel="icon" type="image/png" href="images/11.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <div class="login-box" style="width: 500px;">

    <a href="index.html"><i class="fa fa-arrow-circle-left" style="font-size:24px; color: white; position: relative; top: -35px;"></i></a>

    <img src="logo2.png" style="height: 58px; padding-left: 63px; position: relative; left: 50px; top: -13px;" >
    <h2>Registrar Your Self</h2>

    <form action="register_candidate.php" method="post" enctype="multipart/form-data">

      <div class="user-box" style="width: 47%;">
        <input type="text" name="fname" id="fname" required="">
        <label>First Name</label>
      </div>
      <div class="user-box" style="width: 47%; position: relative; left: 223px; top: -69px">
        <input type="text" name="lname" id="lname" required="">
        <label>Last Name</label>
      </div>
      <div class="user-box" style="position: relative; top: -69px">
        <input type="email" name="email" id="email" required="">
        <label>Email</label>
      </div>
      <div class="user-box" style="position: relative; top:-69px;">
        <input type="password" name="password" id="password" required="">
        <label>Password</label>
      </div>
      <div class="field image" style="position: relative; top: -70px; color: white;">
        <label>Select Image</label>
        <input type="file" name="image" required="" style="position: relative; top: 43px; left: -97px; cursor:pointer; font-size: 15px;">
      </div>
      <div class="button">
        <input type="submit" value="Submit" style="position: relative; top: -30px;background-color: transparent;cursor: pointer; border: 1px solid #03e9f4; border-radius: 10px;" class="b1">
      </div>
      <div class="error-txt" style="
        color: #721c24;
        background: #f8d7da;
        padding: 8px 10px;
        text-align: center;
        border-radius: 5px;
        margin-bottom: 10px;
        border: 1px solid #f5c6cb;
        display: none;
        top: 5px;"></div>

      <script src="js/signup.js"></script>
    </form>
  </div>
</body>
</html>
