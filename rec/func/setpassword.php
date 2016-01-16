<?php
// Include the main page, since that's still necessary
include("../main.php");

function setPassword( $username, $password, $cpassword )
{
    global $connection;
    global $user_table;

    // Validate the input
    $errMsg = "";
    if ($username == "") {		// Username can not be empty
        $errMsg .= "Empty Username<br>";
    }
    if ( strlen( $password ) < 6 ) {
        $errMsg .= "Password is too short<br>";
    }
    if ($password != $cpassword) {	// Password and confirmation must match
        $errMsg .= "Passwords do not match<br>";
    }

    if ( strlen( $errMsg ) > 0 ) {
        return $errMsg;
    }

    // Create a query to check if the username is taken
    $query = "SELECT ID FROM $user_table WHERE username='$username'";

    // Execute the query
    $result = mysqli_query($connection, $query);
    // Check the results
    if ($result->num_rows == 0) {
        return $query . "<br>Username does not exist";
    }

    $row = mysqli_fetch_array($result);
    $id = $row[0];

    // Formulate a query for creating the new user
    $query = "UPDATE $user_table set password='" . sha1($password) . "' where ID=$id";
                                    
    // Execute the query
    mysqli_query($connection, $query);
    return "";
}
?>