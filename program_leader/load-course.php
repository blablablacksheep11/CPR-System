<?php
session_start();
include('../include/database.php');

// Fetch course under the same department
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
        <div class="card" style="width: 21rem; height: 18rem;">
            <img src="../media/<?php echo $courseimage['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
            <div class="card-body p-0 m-0">
                <div class="row w-100 p-0 px-3 m-0 mt-1">
                    <p class="card-text fs-6 text-body-secondary m-0 p-0 text-start" id="code"><?php echo $row['code']; ?></p>
                    <p class="card-text fw-bold fs-6 m-0 p-0 text-start" id="name"><?php echo $row['name']; ?></p>
                </div>
                <div class="row w-100 p-0 px-3 m-0 mb-2 position-absolute bottom-0 d-flex justify-content-between">
                    <div class="col-7 p-0 m-0 d-flex align-items-end">
                        <p class="card-text text-start m-0 p-0" id="credit-hour" style="font-size: small;">Credit hours:&nbsp;<?php echo $row['credit_hour']; ?></p>
                    </div>
                    <div class="col-5 p-0 m-0 d-flex align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item offer-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-value="<?php echo $row['code']; ?>">Offer this course</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>