<?php
session_start();
include("../include/database.php");

if (isset($_POST["submit"])) {
    $password = $_POST["password"];
    $email = $_POST["email"];
    $entity = $_SESSION["entity"];

    // Update the password that corresponding to the email address
    $update = "UPDATE $entity SET password = '$password' WHERE email = '$email'";
    $result = mysqli_query($connection, $update);

    if ($result) {
        echo "success";
    } else {
        echo "Error updating password";
    }
}
?>