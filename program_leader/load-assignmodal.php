<?php
session_start();
include("../include/database.php");
?>

<div class="modal-header border border-0">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">
        Lecturer List
    </h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body text-start border border-0">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Position</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch lecturer info
            $lecturer = "SELECT * FROM lecturer ORDER BY name";
            $result = mysqli_query($connection, $lecturer);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $counter = 1;

                    // Display lecturer info in list
                    while ($lecturerdetail = mysqli_fetch_assoc($result)) {
            ?>
                        <tr>
                            <th class="py-3"><?php echo $counter; ?></th>
                            <td class="py-3"><?php echo $lecturerdetail["name"] ?> &nbsp;<i class="bi <?php echo $lecturerdetail['gender'] === 'female' ? 'bi-gender-female' : 'bi-gender-male'; ?>"></i></td>
                            <td class="py-3"><?php echo $lecturerdetail["position"] ?></td>
                            <td class="py-3"><button class="btn btn-primary select-btn" value="<?php echo $lecturerdetail['id']; ?>">Select</button></td>
                        </tr>
                    <?php
                        $counter++;
                    }
                } else {
                    ?>
                    <td class="text-center border border-0" colspan="3">No available lecturer</td>
                <?php
                }
            } else { ?>
                <td class="text-center border border-0" colspan="3">Failed to load lecturer list. Please try again later.</td>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>