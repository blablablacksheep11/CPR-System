<?php
session_start();
include('../include/database.php');

if (isset($_POST['query'])) {
    $query = $_POST['query'];

    $search = "SELECT * FROM lecturer WHERE name LIKE '%$query%' OR gender LIKE '%$query%' OR email LIKE '%$query%'";
    $result = mysqli_query($connection, $search);

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            echo "empty";
        } else {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    } else {
        echo "Unsuccessful";
    }
}
