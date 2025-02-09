<?php
session_start();
include("../include/database.php");
?>

<div class="modal-header border border-0">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">
        Student List
    </h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body text-start border border-0 py-0">
    <table class="table table-hover m-0">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Intake</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Get the course code of the current course
            $course = "SELECT course_code FROM course_offer WHERE id = '" . $_SESSION["offerid"] . "'";
            $result = mysqli_query($connection, $course);
            $coursecode = mysqli_fetch_assoc($result);

            // Get the programme of the current course
            $programme = "SELECT programme FROM course WHERE code = '" . $coursecode["course_code"] . "'";
            $result = mysqli_query($connection, $programme);
            $programme = mysqli_fetch_assoc($result);

            // Get the student under the programme but haven't enrolled in the course
            $student = "SELECT student.* FROM student LEFT JOIN enrolment ON student.id = enrolment.student_id AND enrolment.course_code = '" . $coursecode["course_code"] . "' WHERE programme = '" . $programme["programme"] . "' AND enrolment.student_id IS NULL ORDER BY name";
            $result = mysqli_query($connection, $student);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {

                    // Display student info in list
                    while ($studentdetail = mysqli_fetch_assoc($result)) {
            ?>
                        <tr onclick="toggleCheckbox(<?php echo $studentdetail['id']; ?>)">
                            <td class="py-3"><input class="form-check-input" type="checkbox" value="<?php echo $studentdetail["id"] ?>" id="<?php echo $studentdetail["id"] ?>" onclick="event.stopPropagation();"></td>
                            <td class="py-3"><?php echo $studentdetail["student_id"] ?></td>
                            <td class="py-3"><?php echo $studentdetail["name"] ?> &nbsp;<i class="bi <?php echo $studentdetail['gender'] === 'female' ? 'bi-gender-female' : 'bi-gender-male'; ?>"></i></td>
                            <td class="py-3"><?php echo $studentdetail["intake"] ?></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <td class="text-center border border-0" colspan="4">No available student</td>
                <?php
                }
            } else { ?>
                <td class="text-center border border-0" colspan="4">Failed to load student list. Please try again later.</td>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div class="modal-footer d-flex justify-content-between border border-0">
    <p class="ms-3" id="count-label"></p>
    <button class="btn btn-primary" id="add-btn2" data-bs-dismiss="modal">Add</button>
</div>

<script>
    if (typeof counter == "undefined" || typeof students == "undefined") {
        var counter = 0;
        var students = [];
    } else {
        counter = 0;
        students = [];
    }

    document.getElementById('count-label').innerHTML = counter + " selected";

    function toggleCheckbox(id) {
        let checkbox = document.getElementById(id);
        checkbox.checked = !checkbox.checked; // Toggle the checkbox state
        if (checkbox.checked) { // If the checkbox is checked
            students.push(checkbox.value);
            counter++;
        } else { // If the checkbox is unchecked
            const index = students.indexOf(checkbox.value);
            if (index !== -1) {
                students.splice(index, 1);
            }
            counter--;
        }

        document.getElementById('count-label').innerHTML = (counter) + " selected";
    }
</script>