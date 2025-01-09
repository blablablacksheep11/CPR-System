<?php
session_start();
include('../include/database.php');

if (isset($_POST['search'])) {
    $query = $_POST['query'];

    $search = "SELECT * FROM student WHERE (student_id LIKE '%$query%' OR name LIKE '%$query%' OR email LIKE '%$query%') AND department = '" . $_SESSION['department'] . "' ORDER BY name";
    $result = mysqli_query($connection, $search);

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            echo "empty";
        } else {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $programme = "SELECT name FROM programme WHERE code = '" . $row['programme'] . "'";
                $fetch = mysqli_query($connection, $programme);
                $programmename = mysqli_fetch_assoc($fetch);
                $row["programme"] = $programmename['name'];
                $data[] = $row;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    } else {
        echo "Unsuccessful";
    }
} else if (isset($_POST['sort'])) {
    $query = $_POST['query'];

    $sort = "SELECT * FROM student WHERE department = '" . $_SESSION['department'] . "' ORDER BY $query, name";
    $result = mysqli_query($connection, $sort);

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            echo "empty";
        } else {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $programme = "SELECT name FROM programme WHERE code = '" . $row['programme'] . "'";
                $fetch = mysqli_query($connection, $programme);
                $programmename = mysqli_fetch_assoc($fetch);
                $row["programme"] = $programmename['name'];
                $data[] = $row;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    } else {
        echo "Unsuccessful";
    }
} else if (isset($_POST['filter'])) {
    $query = $_POST['data'];
    $size = count($query);
    $filter = "SELECT * FROM student WHERE ";
    $conditions = "";

    foreach ($query as $condition) {
        $conditions .= "$condition AND ";
    }

    $conditions = substr($conditions, 0, -5);
    $filter .= "($conditions) AND (department = '" . $_SESSION['department'] . "') ORDER BY name";

    $result = mysqli_query($connection, $filter);

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            echo "empty";
        } else {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $programme = "SELECT name FROM programme WHERE code = '" . $row['programme'] . "'";
                $fetch = mysqli_query($connection, $programme);
                $programmename = mysqli_fetch_assoc($fetch);
                $row["programme"] = $programmename['name'];
                $data[] = $row;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    } else {
        echo "Unsuccessful";
    }
}
