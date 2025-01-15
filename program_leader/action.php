<?php
session_start();
include("../include/database.php");

// This file will be handling all the action and behaviour of the program leader

// If the program leader offer a course in a semesters
if(isset($_POST["offer"])) {
    $coursecode = $_POST["coursecode"];
    $currentdate = $_POST["currentdate"];

    // Get the semester id base on the current date
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