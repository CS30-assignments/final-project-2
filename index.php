<?php

// include database connection
include('connect-db.php');

// write query for all books
$sql = "SELECT id, title, author, genre FROM books";

// make the query and get results
$result = mysqli_query($connect, $sql);

// fetch results as an array
$books = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result
mysqli_free_result($result);


// Search and select the book that is looked up and replace other books on the screen
if (isset($_POST['search'])) {

    // Filter search specific to category
    if (($_POST['category'])) {

        $search = $_POST['search-bar'];
        $category = $_POST['category'];

        $sql = "SELECT * FROM `books` WHERE $category LIKE '%$search%'";

        // make the query and get results
        $result = mysqli_query($connect, $sql);

        // fetch results as an array
        $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    <title>Library</title>
    <!-- Bootstrap CSS Link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <!-- Navigation Bar (to display different sections) -->
    <nav class="navbar navbar-expand-sm bg-light">

        <!-- Items in the bar -->
        <ul class="navbar-nav">
            <!-- Search for books -->
            <form action="index.php" method="POST">

                <ul class="navbar-nav">
                    <!-- Category to search by -->
                    <li class="pl-5">
                        <select name="category">
                            <option value="title">Book Title</option>
                            <option value="author">Author</option>
                            <option value="genre">Genre</option>
                        </select>
                    </li>
                    <li class="nav-item pl-5">
                        <input class="search-bar" type="search" name="search-bar" placeholder="Search ">
                    </li>
                    <li class="nav-item pr-5">
                        <input class="btn bg-white" type="submit" name="search" value="Search">
                    </li>
                </ul>

            </form>

            <!-- Login to checkout and save books -->
            <form action="login.php" method="POST">
                    <input class="login" type="submit" name="log-in" value="Log In">
            </form>

        </ul>

    </nav>

    <!-- Display all books -->
    <div class="container row">
        <!-- <img src="book-images/fellow.jpg" alt="fellowship of the ring"> -->

        <?php foreach ($books as $book) { ?>
            <div id="each-book" class="py-2 col">
                <div class="border p-3">
                    <?php
                        echo $book['title'] . '</br>';
                        echo $book['author'] . '</br>';
                        echo $book['genre'] . '</br>';
                        ?>
                </div>
            </div>
        <?php } ?>
    </div>

    </div>
</body>

</html>