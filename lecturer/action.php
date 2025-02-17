<?php
session_start();
include("../include/database.php");

// This file is used to handle the action of the lecturer

// Load course offered
if (isset($_POST["courseoffered"])) {
    $programmeCode = [];
    $courses = [];
    $currentdate = $_POST['currentdate'];

    // Get the semester id based on current date
    $semester = "SELECT id FROM semester WHERE start < '$currentdate' AND end > '$currentdate'";
    $result = mysqli_query($connection, $semester);
    $semesterid = mysqli_fetch_assoc($result);

    // Get the programme the register under the program leader
    $programme = "SELECT * FROM programme WHERE program_leader = '" . $_SESSION['id'] . "' ORDER BY name";
    $result = mysqli_query($connection, $programme);

    while ($programmeinfo = mysqli_fetch_assoc($result)) {
        $programmeCode[] = $programmeinfo['code']; // Store the programme code in an array
    }

    if (isset($_POST['search']) || isset($_POST['filter'])) {
        $query = isset($_POST['search']) ? $_POST['query'] : $_POST['data'];  // Fetch query

        if (isset($_POST['search'])) {
            foreach ($programmeCode as $code) { // Search course under the programme code
                $offered = "SELECT course.code, course.name, course.credit_hour, course.programme, course_category.image, course_offer.id FROM course INNER JOIN course_category ON SUBSTRING(course.code,1,3) = course_category.code INNER JOIN course_offer ON course.code = course_offer.course_code WHERE course.programme = '$code' AND course.code = course_offer.course_code AND (course.code LIKE '%$query%' OR course.name LIKE '%$query%') AND course_offer.semester = '" . $semesterid['id'] . "' ORDER BY course.name";
                $result = mysqli_query($connection, $offered);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($courseinfo = mysqli_fetch_assoc($result)) {
                            $courses[] = $courseinfo; // Store the course information in an array
                        }
                    }
                } else {
                    $courses = "error";
                    break;
                }
            }
        } elseif (isset($_POST['filter'])) {
            $conditions = implode(" AND ", $query);
            foreach ($programmeCode as $code) { // Filter course under the programme code
                $offered = "SELECT course.code, course.name, course.credit_hour, course.programme, course_category.image, course_offer.id FROM course INNER JOIN course_category ON SUBSTRING(course.code,1,3) = course_category.code INNER JOIN course_offer ON course.code = course_offer.course_code WHERE course.programme = '$code' AND course.code = course_offer.course_code AND ($conditions) AND course_offer.semester = '" . $semesterid['id'] . "' ORDER BY course.name";
                $result = mysqli_query($connection, $offered);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($courseinfo = mysqli_fetch_assoc($result)) {
                            $courses[] = $courseinfo; // Store the course information in an array
                        }
                    }
                } else {
                    $courses = "error";
                    break;
                }
            }
        }
    } else {
        foreach ($programmeCode as $code) {
            // Get the course info offered under the programme
            $offered = "SELECT course.code, course.name, course.credit_hour, course.programme, course_category.image, course_offer.id FROM course INNER JOIN course_category ON SUBSTRING(course.code,1,3) = course_category.code INNER JOIN course_offer ON course.code = course_offer.course_code WHERE course.programme = '$code' AND course.code = course_offer.course_code AND course_offer.semester = '" . $semesterid['id'] . "' ORDER BY course.name";
            $result = mysqli_query($connection, $offered);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    while ($courseinfo = mysqli_fetch_assoc($result)) {
                        $courses[] = $courseinfo; // Store the course information in an array
                    }
                }
            } else {
                $courses = "error";
                break;
            }
        }
    }

    if (empty($courses) && $courses != "error") {
        $courses = "empty";
    }

    header('Content-Type: application/json');
    echo json_encode($courses);
}
?>