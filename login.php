<?php

// call file with database connection
include('connect-db.php');

// initialize login variable
$loginError = $errors = "";

// write query for all user information
$sql = "SELECT id, names, email, passwords FROM users";

// make the query and get results
$result = mysqli_query($connect, $sql);

// fetch results as an array
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result
mysqli_free_result($result);



// Login Validation
if (isset($_POST['userLogIn'])) {
    // // loop through users to check log in and password
    foreach ($users as $user) {
        if ($_POST['email'] == $user['email'] && $_POST['password'] == $user['passwords']) {
            echo "HELOO";

            // start the session
            session_start();
            // $_SESSION['name'] = $user['names'];
            $_SESSION['email'] = $user['email'];

            header('Location: post-login-main.php');
        } elseif ($_POST['email'] != $user['email'] || $_POST['password'] != $user['passwords']) {
            // go to about page
            $loginError =  "Sorry, incorrect login. Try again. Email and password are case sensitive.";
        }
    }
}

// close connection
mysqli_close($connect);

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
        <div id="login-div" class="login-background">

            <!-- Log in Heading -->
            <h3 class="display 4">Log In</h3>

            <form action="#" method="POST" class="pt-2">
                <label>Email:</label>
                <!-- Enter in value  -->
                <input type="text" name="email">
                <br>

                <label>Card Number:</label>
                <!-- Enter in value  -->
                <input type="password" name="password">

                <br>

                <!-- Submit Login -->
                <input id="login-btn" class="btn-secondary" type="submit" name="userLogIn" value="Log In">

                <!-- Error in the Login -->
                <p class="pt-2 text-danger"></p>
            </form>

            
        </div>
    </div>

    </div>

</body>

</html>