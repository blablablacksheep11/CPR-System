<?php
session_start();
include('../include/database.php');

$counter = 1;
$lecturers = [];

if (isset($_POST['search']) || isset($_POST['sort']) || isset($_POST['filter'])) {
    $query = isset($_POST['search']) ? $_POST['query'] : (isset($_POST['sort']) ? $_POST['query'] : $_POST['data']); // Fetch query

    if (isset($_POST['search'])) {
        // Search lecturer under the department
        $lecturer = "SELECT * FROM lecturer WHERE department = '" . $_SESSION['department'] . "' AND (name LIKE '%$query%' OR email LIKE '%$query%') ORDER BY name";
        $result = mysqli_query($connection, $lecturer);
    } elseif (isset($_POST['sort'])) {
        // Sort lecturer under the department
        $lecturer = "SELECT * FROM lecturer WHERE department = '" . $_SESSION['department'] . "' ORDER BY $query, name";
        $result = mysqli_query($connection, $lecturer);
    } elseif (isset($_POST['filter'])) {
        // Filter lecturer under the department
        $conditions = implode(" AND ", $query);
        $lecturer = "SELECT * FROM lecturer WHERE department = '" . $_SESSION['department'] . "' AND ($conditions) ORDER BY name";
        $result = mysqli_query($connection, $lecturer);
    }
} else {
    // Retrieve all lecturers under the same department as the program leader
    $lecturer = 'SELECT * FROM lecturer WHERE department = "' . $_SESSION['department'] . '" ORDER BY name';
    $result = mysqli_query($connection, $lecturer);
}

if ($result) {
    if (mysqli_num_rows($result) == 0) {
        echo "empty"; // Return empty
    } else {
        while ($lecturerinfo = mysqli_fetch_assoc($result)) {
            $lecturers[] = $lecturerinfo; // Store the lecturer information in an array
        }
        header('Content-Type: application/json');
        echo json_encode($lecturers);
    }
} else {
    echo "error";
}