<?php
session_start();
include('../include/database.php');

$counter = 1;
$lecturer = 'SELECT * FROM lecturer WHERE department = "' . $_SESSION['department'] . '" ORDER BY name';
$result = mysqli_query($connection, $lecturer);
while ($lecturerinfo = mysqli_fetch_assoc($result)) {
?>
    <tr>
        <th class="py-3" scope="row"><?php echo $counter; ?></th>
        <td class="py-3"><?php echo $lecturerinfo['name'];
                            if ($lecturerinfo['gender'] == 'male') { ?>
                <i class="bi bi-gender-male ps-1"></i>
            <?php } else { ?>
                <i class="bi bi-gender-female ps-1"></i>
            <?php } ?>
        </td>
        <td class="py-3"><?php echo $lecturerinfo['email']; ?></td>
        <td class="py-3"><?php echo $lecturerinfo['position']; ?></td>
        <td class="py-3"><?php if ($lecturerinfo['type'] == 'FT') {
                                echo 'Full Time';
                            } elseif ($lecturerinfo['type'] == 'PT') {
                                echo 'Part Time';
                            } ?></td>
        <td class="py-3">
            <select class="form-select" aria-label="Default select example">
                <option value="<?php echo $lecturerinfo['id']; ?>" selected>View</option>
                <option value="<?php echo $lecturerinfo['id']; ?>">Edit</option>
                <option value="<?php echo $lecturerinfo['id']; ?>">Delete</option>
            </select>
        </td>
    </tr>
<?php
    $counter++;
}
?>