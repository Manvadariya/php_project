<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php
     $conn = mysqli_connect("localhost", "root", "", "auxilio");
    ?>
      <style>
        /*=============== GOOGLE FONTS ===============*/
@import url("https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600&display=swap");

/*=============== VARIABLES CSS ===============*/
:root {
  --header-height: 3.5rem;

  /*========== Colors ==========*/
  /*Color mode HSL(hue, saturation, lightness)*/
  --first-color: hsl(230, 75%, 56%);
  --title-color: hsl(230, 75%, 15%);
  --text-color: hsl(230, 12%, 40%); 
  --body-color: hsl(230, 100%, 98%);
  --container-color: hsl(230, 100%, 97%);
  --border-color: hsl(230, 25%, 80%);

  /*========== Font and typography ==========*/
  /*.5rem = 8px | 1rem = 16px ...*/
  --body-font: "Syne", sans-serif;
  --h2-font-size: 1.25rem;
  --normal-font-size: .938rem;

  /*========== Font weight ==========*/
  --font-regular: 400;
  --font-medium: 500;
  --font-semi-bold: 600;

  /*========== z index ==========*/
  --z-fixed: 100;
  --z-modal: 1000;
}

/*========== Responsive typography ==========*/
@media screen and (min-width: 1023px) {
  :root {
    --h2-font-size: 1.5rem;
    --normal-font-size: 1rem;
  }
}

/*=============== BASE ===============*/
* {
  box-sizing: border-box;
  padding: 0;
  margin: 0;
}

html {
  scroll-behavior: smooth;
}

body,
input,
button {
  font-family: var(--body-font);
  font-size: var(--normal-font-size);
}

body {
  color: var(--text-color);
}

input,
button {
  border: none;
  outline: none;
}

ul {
  list-style: none;
}

a {
  text-decoration: none;
}

img {
  display: block;
  max-width: 100%;
  height: auto;
}

/*=============== REUSABLE CSS CLASSES ===============*/
.container {
  max-width: 1120px;
  margin-inline: 1.5rem;
}

.main {
  position: relative;
  height: 100vh;
}

.main__bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  z-index: -1;
}

.search,
.login {
  position: fixed;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  z-index: var(--z-modal);
  background-color: hsla(230, 75%, 15%, .1);
  backdrop-filter: blur(24px);
  -webkit-backdrop-filter: blur(24px); /* For safari */
  padding: 8rem 1.5rem 0;
  opacity: 0;
  pointer-events: none;
  transition: opacity .4s;
}



/*=============== HEADER & NAV ===============*/
.header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background-color: var(--body-color);
  box-shadow: 0 2px 16px hsla(230, 75%, 32%, .15);
  z-index: var(--z-fixed);
}

.nav {
  height: var(--header-height);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.nav__logo {
  color: var(--title-color);
  font-weight: var(--font-semi-bold);
  transition: color .4s;
}

.nav__actions {
  display: flex;
  align-items: center;
  column-gap: 1rem;
}

.nav__search, 
.nav__login, 
.nav__toggle, 
.nav__close {
  font-size: 1.25rem;
  color: var(--title-color);
  cursor: pointer;
  transition: color .4s;
}

:is(.nav__logo, .nav__search, .nav__login, .nav__toggle, .nav__link):hover {
  color: var(--first-color);
}

/* Navigation for mobile devices */
@media screen and (max-width: 1023px) {
  .nav__menu {
    position: fixed;
    top: -100%;
    left: 0;
    background-color: var(--body-color);
    box-shadow: 0 8px 16px hsla(230, 75%, 32%, .15);
    width: 100%;
    padding-block: 4.5rem 4rem;
    transition: top .4s;
  }
}

.nav__list {
  display: flex;
  flex-direction: column;
  row-gap: 2.5rem;
  text-align: center;
}

.nav__link {
  color: var(--title-color);
  font-weight: var(--font-semi-bold);
  transition: color .4s;
}

.nav__close {
  position: absolute;
  top: 1.15rem;
  right: 1.5rem;
}

/* Show menu */
.show-menu {
  top: 0;
}

/*=============== SEARCH ===============*/
.search__form {
  display: flex;
  align-items: center;
  column-gap: .5rem;
  background-color: var(--container-color);
  box-shadow: 0 8px 32px hsla(230, 75%, 15%, .2);
  padding-inline: 1rem;
  border-radius: .5rem;
  transform: translateY(-1rem);
  transition: transform .4s;
}

.search__icon {
  font-size: 1.25rem;
  color: var(--title-color);
}

.search__input {
  width: 100%;
  padding-block: 1rem;
  background-color: var(--container-color);
  color: var(--text-color);
}

.search__input::placeholder {
  color: var(--text-color);
}

/* Show search */
.show-search {
  opacity: 1;
  pointer-events: initial;
}

.show-search .search__form {
  transform: translateY(0);
}


/*=============== BREAKPOINTS ===============*/
/* For medium devices */
@media screen and (min-width: 576px) {
  .search,
  .login {
    padding-top: 10rem;
  }

  .search__form {
    max-width: 450px;
    margin-inline: auto;
  }

  .search__close,
  .login__close {
    width: max-content;
    top: 5rem;
    left: 0;
    right: 0;
    margin-inline: auto;
    font-size: 2rem;
  }

  .login__form {
    max-width: 400px;
    margin-inline: auto;
  }
}

/* For large devices */
@media screen and (min-width: 1023px) {
  .nav {
    height: calc(var(--header-height) + 2rem);
    column-gap: 3rem;
  }
  .nav__close, 
  .nav__toggle {
    display: none;
  }
  .nav__menu {
    margin-left: auto;
  }
  .nav__list {
    flex-direction: row;
    column-gap: 3rem;
  }

  .login__form {
    padding: 3rem 2rem 3.5rem;
  }
}

@media screen and (min-width: 1150px) {
  .container {
    margin-inline: auto;
  }
}
      </style>

      <!--=============== REMIXICONS ===============-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">

      <title>Company Dashboard</title>
   </head>
   <body>
      <!--==================== HEADER ====================-->
      <header class="header" id="header">
         <nav class="nav container">
            <a href="#" class="nav__logo"><img src="logo3.png" style="width: 210px;">
            </a>

            <div class="nav__menu" id="nav-menu">
               <ul class="nav__list">
                  <li class="nav__item">
                     <a href="#" class="nav__link">Home</a>
                  </li>

                  <li class="nav__item">
                     <a href="#" class="nav__link">Chat</a>
                  </li>

               
               </ul>

               <!-- Close button -->
               <div class="nav__close" id="nav-close">
                  <i class="ri-close-line"></i>
               </div>
            </div>

            <div class="nav__actions">
               <!-- Search button -->
               <i class="ri-search-line nav__search" id="search-btn"></i>

               <!-- Login button -->
               <i class="ri-user-line nav__login" id="login-btn"></i>

               <!-- Toggle button -->
               <div class="nav__toggle" id="nav-toggle">
                  <i class="ri-menu-line"></i>
               </div>
            </div>
         </nav>
      </header>

      <!--==================== SEARCH ====================-->
      <div class="search" id="search">
         <form action="" class="search__form">
            <i class="ri-search-line search__icon"></i>
            <input type="search" placeholder="What are you looking for?" class="search__input">
         </form>

         <i class="ri-close-line search__close" id="search-close"></i>
      </div>

     

   
      


      <div class="main container">
        <div class="left" style="width: 50%; background-color: aqua; float: left; padding-top: 100px;">
          <h1 style="padding-top:px;">hello </h1>
          <div class="container my-4">


            <table class="table" id="myTable">
              <thead>
                <tr>
                  <th scope="col">S.No</th>
                  <th scope="col">Comapny Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Phone no</th>
                  <th scope="col">Website</th>
                  <th scope="col">Address</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $sql = "SELECT * FROM `company`";
                  $result = mysqli_query($conn, $sql);
                  $sno = 0;
                  while($row = mysqli_fetch_assoc($result)){
                    $sno = $sno + 1;
                    echo "<tr>
                    <th scope='row'>". $sno . "</th>
                    <td>". $row['company_name'] . "</td>
                    <td>". $row['business_email '] . "</td>
                    <td>". $row['phone_no'] . "</td>
                    <td>". $row['website'] . "</td>
                    <td>". $row['address'] . "</td>
                    </tr>";
                } 
                  ?>
        
              </tbody>
            </table>
          </div>

          </h2>
        </div>
        <div class="right" style="width: 50%; background-color: aquamarine; float: right; padding-top: 100px;">
          <h1 style="padding-top:px;">hello </h1>
        </div>
      </div>
      

   </body>
</html>