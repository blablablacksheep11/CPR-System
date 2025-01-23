<?php
session_start();
include("../include/database.php");

if (isset($_POST["coursecode"])) {
    $coursecode = $_POST["coursecode"];
    $currentdate = $_POST["currentdate"];

    // Check if the course is already offered in this semester
    $course = "SELECT course_offer.* FROM course_offer INNER JOIN semester on course_offer.semester = semester.id WHERE course_offer.course_code = '$coursecode' AND semester.start < '$currentdate' AND semester.end > '$currentdate'";
    $result = mysqli_query($connection, $course);

    // If the SQL query is successfully executed
    if ($result) {
        // If the course is already offered in this semester
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["offeredstatus"] = "offered";
        }
        // If the course is not offered in this semester
        else {
            $_SESSION["offeredstatus"] = "not offered";
        }
    }
    // If error in SQL query execution
    else {
        echo "error";
    }
}
?>


<div class="modal-header border border-0">
    <h1 class="modal-title fs-5">
        <?php
        echo $_SESSION["offeredstatus"] == "offered" ? "Course offered" : "Course offering confirmation";
        ?>
    </h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body text-start border border-0">
    <?php
    echo $_SESSION["offeredstatus"] == "offered" ? "This course is already offered in this semester" : "Are you sure you want to offer this course for this semester?";
    ?>
</div>
<div class="modal-footer border border-0">
    <?php
    if ($_SESSION["offeredstatus"] == "offered") { ?>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Okay</button>
    <?php } else if ($_SESSION["offeredstatus"] == "not offered") { ?>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary confirm-btn" data-bs-dismiss="modal">Confirm</button>
    <?php
    }
    ?>
</div>