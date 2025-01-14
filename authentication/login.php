<?php
session_start();
include('../include/database.php');

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

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

        // Check program_leader table
        $account = "SELECT * FROM academic_administrator WHERE email = '$email'";
        $academicadministrator = mysqli_query($connection, $account);
        $academicadministratorinfo = mysqli_fetch_assoc($academicadministrator);

        // If is lecturer and password correct
        if ((mysqli_num_rows($lecturer) > 0) && ($lecturerinfo["password"] == $password)) {
            $_SESSION["department"] = $lecturerinfo['department'];
            $_SESSION["entity"] = "lecturer";
            echo "success_lecturer";
        }
        // If is program leader and password correct
        else if ((mysqli_num_rows($programleader) > 0) && ($programleaderinfo["password"] == $password)) {
            $_SESSION["department"] = $programleaderinfo['department'];
            $_SESSION["entity"] = "programleader";
            echo "success_programleader";
        }
        // If is academic administrator and password correct
        else if ((mysqli_num_rows($academicadministrator) > 0) && ($academicadministratorinfo["password"] == $password)) {
            $_SESSION["department"] = $academicadministratorinfo['department'];
            $_SESSION["entity"] = "academicadministrator";
            echo "success_academicadministrator";
        }
        // If account founded but password incorrect
        else if (((mysqli_num_rows($lecturer) > 0) && ($lecturerinfo["password"] != $password)) || ((mysqli_num_rows($academicadministrator) > 0) && ($academicadministratorinfo["password"] != $password)) || ((mysqli_num_rows($programleader) > 0) && ($programleaderinfo["password"] != $password))) {
            echo "Incorrect password";
        }
        //If account doesn't existed
        else {
            echo "Account not found.";
        }
    } else {
        echo "Invalid email address.";
    }
}
