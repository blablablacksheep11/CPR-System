<?php
session_start();
include("../include/database.php");

if (isset($_POST["submit"])) {
    $code = $_POST["code"];

    // Verify verification code
    if ($code == $_SESSION["code"]) {
        echo "success";
    } else {
        echo "Incorrect verificaiton code.";
    }
}
