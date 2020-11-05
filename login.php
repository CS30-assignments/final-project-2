<?php

// call file with database connection
include('connect-db.php');

// initialize login variable
$loginError = $errors = " ";

// write query for all user information
$sql = "SELECT id, names, email, passwords FROM user_information";

// make the query and get results
$result = mysqli_query($connect, $sql);

// fetch results as an array
$user_information = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result
mysqli_free_result($result);

// close connection
mysqli_close($connect);

// Login Validation
if(isset($_POST['log-in'])){
    
    // loop through user_information to check log in and password
    foreach ($user_information as $user) {
        if ($_POST['email'] == $user['email'] && $_POST['password'] == $user['passwords']) {
            header('Location: index.php');
        } elseif ($_POST['email'] != $user['email'] || $_POST['password'] != $user['passwords']) {
            // go to about page
            $loginError =  "Sorry, incorrect login. Try again. Email and password are case sensitive.";
        }
    }

}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Bootstrap CSS Link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">

</head>

<body>

    </nav>
    <div class="p-5 col d-flex justify-content-center ">
        <div id="login-div" class="container bg-light  float-left">

            <!-- Log in Heading -->
            <h3 class="display 4">Log In</h3>

            <form method="POST" class="pt-2">
                <label>Email:</label>
                <!-- Enter in value  -->
                <input type="text" name="email">
                <br>

                <label>Password:</label>
                <!-- Enter in value  -->
                <input type="password" name="password">

                <br>

                <!-- Submit Login -->
                <input id="login-btn" class="btn-secondary" type="submit" name="log-in" value="Log In">

                <!-- Error in the Login -->
                <p class="pt-2 text-danger"></p>
            </form>


            <!-- Sign up -->
            <div>
                <p class="text-secondary">Don't have a login?</p>
                <a id="sign-up-link" class="nav-link" href="sign-up.php">Sign Up</a>
            </div>



        </div>
    </div>

    </div>

</body>

</html>