<?php
session_start();
include('../include/database.php');

// Get lecturer assined to current course
$lecturer = "SELECT lecturer.* FROM lecturer INNER JOIN course_offer on lecturer.id = course_offer.lecturer WHERE course_offer.id = '" . $_SESSION['offerid'] . "'";
$result = mysqli_query($connection, $lecturer);

// If no lecturer assigned
if (mysqli_num_rows($result) == 0) {
    $lecturername = "No lecturer assigned";
    echo $lecturername;
?>
    <a class="btn btn-primary ms-2 assign-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Assign lecturer</a> <!-- Display assign button -->
<?php
} else { // If lecturer assigned
    $lecturername = mysqli_fetch_assoc($result);
    $lecturergender = $lecturername['gender'];
    $lecturername = $lecturername['name'];
    echo $lecturername; ?>
    &nbsp;<i class="bi <?php echo $lecturergender === 'female' ? 'bi-gender-female' : 'bi-gender-male'; ?>"></i>
    <a class="btn btn-primary ms-2 assign-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Reassign lecturer</a> <!-- Display reassign button -->
<?php
}
// The assign and reassign btn work the same, just text content different
?>