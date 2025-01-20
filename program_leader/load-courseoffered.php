<?php
session_start();
include('../include/database.php');

$counter = 1;
$programmeCode = [];
$courses = [];
$currentdate = $_POST['currentdate'];

// Get the semester id based on current date
$semester = "SELECT id FROM semester WHERE start < '$currentdate' AND end > '$currentdate'";
$result = mysqli_query($connection, $semester);
$semesterid = mysqli_fetch_assoc($result);

// Get the programme the register under the program leader
$programme = "SELECT * FROM programme WHERE program_leader = '" . $_SESSION['id'] . "'";
$result = mysqli_query($connection, $programme);

while ($programmeinfo = mysqli_fetch_assoc($result)) {
    $programmeCode[] = $programmeinfo['code']; // Store the programme code in an array
}

if (isset($_POST['search']) || isset($_POST['filter'])) {
    $query = isset($_POST['search']) ? $_POST['query'] : $_POST['data'];  // Fetch query

    if (isset($_POST['search'])) {
        foreach ($programmeCode as $code) { // Search course under the programme code
            $offered = "SELECT course.*, course_category.image FROM course INNER JOIN course_category ON SUBSTRING(course.code,1,3) = course_category.code INNER JOIN course_offer ON course.code = course_offer.course_code WHERE course.programme = '$code' AND course.code = course_offer.course_code AND (course.code LIKE '%$query%' OR course.name LIKE '%$query%') AND course_offer.semester = '".$semesterid['id']."' ORDER BY course.name";
            $result = mysqli_query($connection, $offered);
        }
    } elseif (isset($_POST['filter'])) {
        $conditions = implode(" AND ", $query);
        foreach ($programmeCode as $code) { // Filter course under the programme code
            $offered = "SELECT course.*, course_category.image FROM course INNER JOIN course_category ON SUBSTRING(course.code,1,3) = course_category.code INNER JOIN course_offer ON course.code = course_offer.course_code WHERE course.programme = '$code' AND course.code = course_offer.course_code AND ($conditions) AND course_offer.semester = '".$semesterid['id']."' ORDER BY course.name";
            $result = mysqli_query($connection, $offered);
        }
    }
} else {
    foreach ($programmeCode as $code) {
        // Get the course info offered under the programme
        $offered = "SELECT course.*, course_category.image FROM course INNER JOIN course_category ON SUBSTRING(course.code,1,3) = course_category.code INNER JOIN course_offer ON course.code = course_offer.course_code WHERE course.programme = '$code' AND course.code = course_offer.course_code AND course_offer.semester = '".$semesterid['id']."' ORDER BY course.name";
        $result = mysqli_query($connection, $offered);
    }
}

if ($result) {
    if (mysqli_num_rows($result) == 0) {
        echo "empty";  // Return empty
    } else {
        while ($courseinfo = mysqli_fetch_assoc($result)) {
            $courses[] = $courseinfo; // Store the course information in an array
        }
        header('Content-Type: application/json');
        echo json_encode($courses);
    }
} else {
    echo "error";
}
?>