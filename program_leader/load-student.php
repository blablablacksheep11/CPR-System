<?php
session_start();
include('../include/database.php');

$counter = 1;
$student = 'SELECT * FROM student WHERE department = "' . $_SESSION['department'] . '" ORDER BY name';
$result = mysqli_query($connection, $student);
while ($studentinfo = mysqli_fetch_assoc($result)) {
?>
    <tr>
        <th class="py-3" scope="row"><?php echo $counter; ?></th>
        <td class="py-3"><?php echo $studentinfo['student_id']; ?></td>
        <td class="py-3"><?php echo $studentinfo['name'];
                            if ($studentinfo['gender'] == 'male') { ?>
                <i class="bi bi-gender-male ps-1"></i>
            <?php } else { ?>
                <i class="bi bi-gender-female ps-1"></i>
            <?php } ?>
        </td>
        <td class="py-3"><?php echo $studentinfo['email']; ?></td>
        <td class="py-3"><?php echo $studentinfo['intake']; ?></td>
        <td class="py-3"><?php $programme = 'SELECT name FROM programme WHERE code = "' . $studentinfo['programme'] . '"';
                            $fetch = mysqli_query($connection, $programme);
                            $programmename = mysqli_fetch_assoc($fetch);
                            echo $programmename['name']; ?></td>
        <td class="py-3">
            <select class="form-select" aria-label="Default select example">
                <option value="<?php echo $studentinfo['id']; ?>" selected>View</option>
                <option value="<?php echo $studentinfo['id']; ?>">Edit</option>
                <option value="<?php echo $studentinfo['id']; ?>">Delete</option>
            </select>
        </td>
    </tr>
<?php
    $counter++;
}
?>