<?php
session_start();
include("../include/database.php");

// This file is used to handle the action of the program leader

// Offer course
if(isset($_POST["offer"])) {
    $coursecode = $_POST["coursecode"];
    $currentdate = $_POST["currentdate"];

    // Get the semester id based on current date
    $semester = "SELECT id FROM semester WHERE start < '$currentdate' AND end > '$currentdate'";
    $result = mysqli_query($connection, $semester);
    $semesterid = mysqli_fetch_assoc($result);

    // Add course into the course offer table
    $offer = "INSERT INTO course_offer(course_code, semester) VALUES('$coursecode','".$semesterid["id"]."')";
    $result = mysqli_query($connection, $offer);
    if($result) {
        echo "success";
    } else{
        echo "error";
    }
}
?>