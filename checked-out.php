<?php

// include database connection
include('connect-db.php');

// include functions page
include('functions.php');

// initialized delete variable
$deleted = '';

// Delete booking from user
if (isset($_POST['remove'])) {
    // Delete row of info
    $delete_book = mysqli_real_escape_string($connect, $_POST['remove_book']);

    $sql = "DELETE FROM checked_out WHERE id = $delete_book";

    checkQuery($connect, $sql, $deleted);
}


// write query for all books
$sql = "SELECT id, title, author, genre FROM checked_out";

// make the query and get results
$result = mysqli_query($connect, $sql);

// fetch results as an array
$books = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result
mysqli_free_result($result);


// close connection
mysqli_close($connect);





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checked Out</title>
    <!-- Bootstrap CSS Link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-light">

        <ul class="navbar-nav">
            <li class="nav-item  px-5">
                <h1>Checked Out Books!</h1>

            </li>

            <!-- Button to go back to books page -->
            <li class="nav-item p-3">
                <a href="post-login-main.php">Back to Books</a>
            </li>

        </ul>
    </nav>


    <!-- Display books that have been checked out -->
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
                <form action="#" method="POST">
                    <input type="hidden" name="remove_book" value="<?php echo $book['id']; ?>">
                    <input id="remove" class="btn" type="submit" name="remove" value="Remove">
                </form>

            </div>
        <?php } ?>



    </div>



</body>

</html>