<?php
session_start();
include("../include/database.php");

if (isset($_POST["coursecode"])) {
    $coursecode = $_POST["coursecode"];
    $currentdate = $_POST["currentdate"];

    // Get the semester id base on the current date
    $semester = "SELECT id FROM semester WHERE start < '$currentdate' AND end > '$currentdate'";
    $result = mysqli_query($connection, $semester);
    $semesterid = mysqli_fetch_assoc($result);

    $offer = "SELECT * FROM course_offer WHERE course_code = '$coursecode' AND semester = '$semesterid[id]'";
    $result = mysqli_query($connection, $offer);
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

<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header border border-0">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                <?php
                if ($_SESSION["offeredstatus"] == "offered") {
                    echo "Course offered";
                } else if ($_SESSION["offeredstatus"] == "not offered") {
                    echo "Course offering confirmation";
                }
                ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-start border border-0">
            <?php
            if ($_SESSION["offeredstatus"] == "offered") {
                echo "This course is already offered in this semester";
            } else if ($_SESSION["offeredstatus"] == "not offered") {
                echo "Are you sure you want to offer this course for this semester?";
            }
            ?>
        </div>
        <div class="modal-footer border border-0">
            <?php
            if ($_SESSION["offeredstatus"] == "offered") { ?>
                <!-- The data-bs-dismiss will hide the modal -->
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Okay</button>
            <?php } else if ($_SESSION["offeredstatus"] == "not offered") { ?>
                <!-- The data-bs-dismiss will hide the modal -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary confirm-btn" data-bs-dismiss="modal">Confirm</button>
            <?php
            }
            ?>
        </div>
    </div>
</div>