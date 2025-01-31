<?php
session_start();
include('../include/database.php');

$lecturer = "SELECT lecturer.* FROM lecturer INNER JOIN course_offer on lecturer.id = course_offer.lecturer WHERE course_offer.id = '" . $_SESSION['offerid'] . "'";
$result = mysqli_query($connection, $lecturer);
if (mysqli_num_rows($result) == 0) {
    $lecturername = "No lecturer assigned";
    echo $lecturername;
?>
    <a class="btn btn-primary ms-2 assign-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Assign lecturer</a>
<?php
} else {
    $lecturername = mysqli_fetch_assoc($result);
    $lecturergender = $lecturername['gender'];
    $lecturername = $lecturername['name'];
    echo $lecturername; ?>
    &nbsp;<i class="bi <?php echo $lecturergender === 'female' ? 'bi-gender-female' : 'bi-gender-male'; ?>"></i>
    <a class="btn btn-primary ms-2 assign-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Reassign lecturer</a>
<?php
}
?>