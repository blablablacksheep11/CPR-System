<?php
session_start();
include('../include/database.php');

$counter = 1;
$programmeCode = [];
$students = [];

// Get the programme the register under the program leader
$programme = "SELECT * FROM programme WHERE program_leader = '" . $_SESSION['id'] . "'";
$result = mysqli_query($connection, $programme);

while ($programmeinfo = mysqli_fetch_assoc($result)) {
    $programmeCode[] = $programmeinfo['code']; // Store the programme code in an array
}

if (isset($_POST['search']) || isset($_POST['sort']) || isset($_POST['filter'])) {
    $query = isset($_POST['search']) ? $_POST['query'] : (isset($_POST['sort']) ? $_POST['query'] : $_POST['data']);  // Fetch query

    if (isset($_POST['search'])) {
        foreach ($programmeCode as $code) { // Search student under the programme code
            $student = "SELECT student.*, programme.name AS programme FROM student INNER JOIN programme ON student.programme = programme.code WHERE student.programme = '$code' AND (student.student_id LIKE '%$query%' OR student.name LIKE '%$query%' OR student.email LIKE '%$query%') ORDER BY student.name";
            $result = mysqli_query($connection, $student);
        }
    } elseif (isset($_POST['sort'])) {
        foreach ($programmeCode as $code) { // Sort student under the programme code
            $student = "SELECT student.*, programme.name AS programme FROM student INNER JOIN programme ON student.programme = programme.code WHERE student.programme = '$code' ORDER BY $query, student.name";
            $result = mysqli_query($connection, $student);
        }
    } elseif (isset($_POST['filter'])) {
        $conditions = implode(" AND ", $query);
        foreach ($programmeCode as $code) { // Filter student under the programme code
            $student = "SELECT student.*, programme.name AS programme FROM student INNER JOIN programme ON student.programme = programme.code WHERE student.programme = '$code' AND ($conditions) ORDER BY student.name";
            $result = mysqli_query($connection, $student);
        }
    }
} else {
    foreach ($programmeCode as $code) {
        $student = "SELECT student.*, programme.name AS programme FROM student INNER JOIN programme ON student.programme = programme.code WHERE student.programme = '$code' ORDER BY name";
        $result = mysqli_query($connection, $student);
    }
}

if ($result) {
    if (mysqli_num_rows($result) == 0) {
        echo "empty"; // Return empty
    } else {
        while ($studentinfo = mysqli_fetch_assoc($result)) {
            $students[] = $studentinfo; // Store the student information in an array
        }
        header('Content-Type: application/json');
        echo json_encode($students);
    }
} else {
    echo "error";
}
