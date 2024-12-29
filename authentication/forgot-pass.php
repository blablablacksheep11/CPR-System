<?php
session_start();
include("../include/database.php");

if (isset($_POST["submit"])) {
    $email = $_POST["email"];

    // Email address validation
    if (str_contains($email, "@segi.edu.my")) {
        // Check lecturer table
        $account = "SELECT * FROM lecturer WHERE email = '$email'";
        $lecturer = mysqli_query($connection, $account);
        $lecturerinfo = mysqli_fetch_assoc($lecturer);

        // Check program_leader table
        $account = "SELECT * FROM program_leader WHERE email = '$email'";
        $programleader = mysqli_query($connection, $account);
        $programleaderinfo = mysqli_fetch_assoc($programleader);

        // If is lecturer
        if (mysqli_num_rows($lecturer) > 0) {
            $_SESSION["entity"] = "lecturer";
            echo "success";  // "success" statement will be returned to forgot-pass.html
        }
        // If is program leader
        else if (mysqli_num_rows($programleader) > 0) {
            $_SESSION["entity"] = "program_leader";
            echo "success";  // "success" statement will be returned to forgot-pass.html
        }
        //If account doesn't existed
        else {
            echo "Account not found.";  // Return error messages to forgot-pass.html
        }
    } else {
        echo "Invalid email address.";  // Return error messages to forgot-pass.html
    }
}
