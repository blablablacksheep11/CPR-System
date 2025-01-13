<?php
session_start();
include('../include/database.php');

$course = "SELECT * FROM course WHERE department = '" . $_SESSION['department'] . "' ORDER BY name";
$result = mysqli_query($connection, $course);
while ($row = mysqli_fetch_assoc($result)) {
    // Get the image of the respective course category
    $category = substr($row['code'], 0, 3);
    $image = "SELECT image FROM course_category WHERE code = '$category'";
    $result2 = mysqli_query($connection, $image);
    $courseimage = mysqli_fetch_assoc($result2);
?>
    <div class="col-12 col-md-6 col-xl-4 col-xxl-3 d-flex mb-3 align-items-center justify-content-center">
        <div class="card" style="width: 21rem; height: 18rem;" role="button">
            <img src="../media/<?php echo $courseimage['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
            <div class="card-body p-0 px-3 m-0 d-flex flex-column align-items-start">
                <p class="card-text fs-6 text-body-secondary m-0 mt-1 p-0 text-start" id="code"><?php echo $row['code']; ?></p>
                <p class="card-text fw-bold fs-6 m-0 p-0 text-start" id="name"><?php echo $row['name']; ?></p>
                <p class="card-text m-0 mb-2 p-0 text-start position-absolute bottom-0" id="credit-hour" style="font-size: small;">Credit hours:&nbsp;<?php echo $row['credit_hour']; ?></p>
            </div>
        </div>
    </div>
<?php
}
?>