<?php 

// function for checking in book has been deleted
function checkQuery($db, $sqlQuery, $statement){
    // create and check if query is successful
    if (mysqli_query($db, $sqlQuery)) {
        // success
        $statement = "Your checkout has been removed";
        echo $statement;
    } else {
        // failure
        echo 'query error: ' . mysqli_error($db);
    }
}


?>