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
            padding: 2rem; /* Add padding to the container */
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
            position: relative;
            bottom: 1.2rem;
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

        .container-card {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 1.2rem;
            box-shadow: 0 0 1rem rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.5s ease-in-out;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0;
            cursor: pointer;
            margin-bottom: 1rem; /* Add margin to each card */
        }

        .container-card:hover {
            transform: scale(1.05);
            box-shadow: 0 1.5rem 2rem rgba(0, 0, 0, 0.2);
        }

        .header1 {
            display: flex;
            align-items: center;
            padding: 2rem;
            background-color: #4e9ba7;
            color: white;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .container-card:hover .header1,
        .container-card:hover .info-section {
            opacity: 0;
        }

        .logo {
            width: 5rem;
            height: 5rem;
            background-color: rgb(78, 155, 167);
            margin-right: 1.25rem;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .post-info {
            display: flex;
            flex-direction: column;
        }

        .title {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .name {
            color: white;
            font-size: 1rem;
            font-weight: bold;
        }

        .info-section {
            padding: 1rem 2rem;
            color: #3c4043;
            flex: 1;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .fa-map-marker-alt, .fa-money-bill-wave, .fa-briefcase {
            margin-right: 0.5rem;
        }

        .apply-btn {
            display: inline-block;
            background-color: #478e9a;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: background-color 0.3s ease, opacity 0.3s ease, transform 0.3s ease;
            font-size: 1rem;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
        }

        .apply-btn:hover {
            background-color: #3a7f8b;
        }

        .container-card:hover .apply-btn {
            opacity: 1;
            visibility: visible;
            transform: translate(-50%, -50%) scale(1.1);
        }

        .container-card:hover::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #4e9ba7;
            z-index: 0;
            transition: height 0.5s ease;
            height: 100%;
        }

        .container-card:hover .header1,
        .container-card:hover .info-section {
            z-index: 1;
        }
    </style>

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    
    <title>Candidate Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

    <div class="space" style="width: 100%;height:70px"></div>
    
    <div class="container my-5">
        <div class="row">
            <!--  -->
            <?php 
                $sql = "SELECT * FROM `jobs`";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while($row = mysqli_fetch_assoc($result)){
                    echo "<div class='col-lg-6 mb-4'>
                            <div class='container-card'>
                                <div class='header1'>
                                    <div class='logo'>Logo</div>
                                    <div class='post-info'>
                                        <div class='title'>" . $row['job_post'] . "</div>
                                        <div class='name'>company name</div>
                                    </div>
                                </div>
                                <div class='info-section'>
                                    <div><i class='fas fa-briefcase'></i> Experience: " . $row['experience_required'] . "</div>
                                    <div><i class='fas fa-money-bill-wave'></i> Salary: $" . $row['salary'] . "</div>
                                    <div><i class='fas fa-map-marker-alt'></i> Location: " . $row['location'] . "</div>
                                </div>
                                <button class='apply-btn'>Apply</button>
                            </div>
                        </div>";
                } 
            ?>
            <!--  -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
