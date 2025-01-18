<?php
session_start();
include('../include/database.php');

if (isset($_POST['search'])) {
    $query = $_POST['query'];

    $search = "SELECT * FROM course WHERE (code LIKE '%$query%' OR name LIKE '%$query%') AND department = '" . $_SESSION['department'] . "' ORDER BY name";
    $result = mysqli_query($connection, $search);

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            echo "empty";
        } else {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                // Get the image of the respective course category
                $category = substr($row['code'], 0, 3);
                $image = "SELECT image FROM course_category WHERE code = '$category'";
                $result2 = mysqli_query($connection, $image);
                $courseimage = mysqli_fetch_assoc($result2);
                $row[] = 'image';
                $row["image"] = $courseimage['image'];
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
    $filter = "SELECT * FROM course WHERE ";
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
                // Get the image of the respective course category
                $category = substr($row['code'], 0, 3);
                $image = "SELECT image FROM course_category WHERE code = '$category'";
                $result2 = mysqli_query($connection, $image);
                $courseimage = mysqli_fetch_assoc($result2);
                $row[] = 'image';
                $row["image"] = $courseimage['image'];
                $data[] = $row;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    } else {
        echo "Unsuccessful";
    }
}
