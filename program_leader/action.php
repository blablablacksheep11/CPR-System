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

// Remove course
if(isset($_POST["remove"])) {
    $offerid = $_POST["offerid"];
    $currentdate = $_POST["currentdate"];

    // Get the semester id based on current date
    $semester = "SELECT id FROM semester WHERE start < '$currentdate' AND end > '$currentdate'";
    $result = mysqli_query($connection, $semester);
    $semesterid = mysqli_fetch_assoc($result);

    // Add course into the course offer table
    $remove = "DELETE FROM  course_offer WHERE id = '$offerid' AND semester = '".$semesterid["id"]."'";
    $result = mysqli_query($connection, $remove);
    if($result) {
        echo "success";
    } else{
        echo "error";
    }
}

// Select lecturer
if(isset($_POST["select"])) {
    $lecturerid = $_POST["lecturerid"];
    $offerid = $_POST["offerid"];

    // Get the cours name of the current course
    $course = "SELECT course.name FROM course INNER JOIN course_offer ON course.code = course_offer.course_code WHERE course_offer.id = '$offerid'";
    $result = mysqli_query($connection, $course);
    $coursename = mysqli_fetch_assoc($result);

    // Get the name of the selected lecturer
    $lecturer = "SELECT name FROM lecturer WHERE id = '$lecturerid'";
    $result = mysqli_query($connection, $lecturer);
    $lecturername = mysqli_fetch_assoc($result);

    if(isset($lecturername) && isset($coursename)) {
        $response = [];
        $response[] = $lecturername["name"];
        $response[] = $coursename["name"];

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        echo "error";
    }
}

// Assign lecturer
if(isset($_POST["assign"])) {
    $lecturerid = $_POST["lecturerid"];
    $offerid = $_POST["offerid"];

    // Assign lecturer to current course
    $assign = "UPDATE course_offer SET lecturer = '$lecturerid' WHERE id = '$offerid'";
    $result = mysqli_query($connection, $assign);

    if($result){
        echo "success";
    } else {
        echo "error";
    }
}
?>