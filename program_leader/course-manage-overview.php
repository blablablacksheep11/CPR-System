<?php
session_start();
include('../include/database.php');

if (isset($_POST['offerid'])) {
    $_SESSION["offerid"] = $_POST['offerid'];
    if (isset($_SESSION["offerid"]) && ($_SESSION['offerid'] == $_POST['offerid'])) {
        echo "success";
    } else {
        echo "error";
    }
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CPR System</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <style>
            .bi-gender-female {
                color: #ff69b4;
            }

            .bi-gender-male {
                color: #0096FF;
            }

            #top-navbar {
                min-height: 79px;
                max-height: 79px;
                background-color: transparent;
            }

            #content-container {
                min-height: calc(100% - 79px);
            }

            /* The container is not 100% width under full screen width */
            #content-holder {
                width: calc(100% - 256px);
                background-color: rgb(240, 241, 246);
            }

            @media (max-width: 991px) {

                /* The container will be 100% width when screen width falls under lg */
                #content-holder {
                    width: 100%;
                }

                /* The side navbar will be 100% width when screen width falls under lg */
                /* The side navbar is hidden in default when screen width falls under lg */
                #side-navbar {
                    min-width: 100%;
                    max-width: 100%;
                }
            }

            @media (min-width: 992px) {

                /* The side navbar will be 256px width when screen width go above lg */
                #side-navbar {
                    min-width: 256px;
                    max-width: 256px;
                    background-color: transparent;
                    /*background-color: #f8f9fa;*/
                }
            }

            #title-container {
                height: 120px;
            }

            #course-container {
                min-height: calc(100% - 120px);
                max-height: fit-content;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid position-absolute h-100 p-0 m-0" id="main-container">
            <div class="row h-100 m-0 p-0">
                <!-- Top navbar -->
                <div class="row border-bottom border-1 m-0 p-0 d-flex justify-content-between" id="top-navbar">
                    <!-- Content in top-navbar.html will be loaded here -->
                </div>

                <!-- Container for side navbar and content -->
                <div class="row m-0 p-0 overflow-hidden" id="content-container">
                    <!-- Side navabr -->
                    <!-- The side navabr collapse in default(display:none), and will only visible(display:flex) when screen width go above lg -->
                    <div class="border-end border-1 h-100 m-0 p-0 d-lg-flex justify-content-center collapse" id="side-navbar">
                        <!-- Content in side-navbar.html will be loaded here -->
                    </div>
                    <!-- Main content of the page will be loaded here -->
                    <div class="container h-100 m-0 p-0 overflow-hidden" id="content-holder">
                        <div class="row h-100 m-0 p-0 overflow-hidden">
                            <!-- Row to carry search bar -->
                            <div class="row m-0 p-0" id="title-container">
                                <div class="container-fluid p-0 ps-3 m-0">
                                    <p class="fs-6 m-0 p-0">
                                        <?php
                                        // Get semester info of current course
                                        $semester = "SELECT semester FROM course_offer WHERE id = '" . $_SESSION['offerid'] . "'";
                                        $result = mysqli_query($connection, $semester);
                                        $semesterid = mysqli_fetch_assoc($result);

                                        $semester = "SELECT detail FROM semester WHERE id = '" . $semesterid['semester'] . "'";
                                        $result = mysqli_query($connection, $semester);
                                        $semesterdetail = mysqli_fetch_assoc($result);

                                        // Get course code of current course
                                        $course = "SELECT course_code FROM course_offer WHERE id = '" . $_SESSION['offerid'] . "'";
                                        $result = mysqli_query($connection, $course);
                                        $coursecode = mysqli_fetch_assoc($result);

                                        echo $coursecode['course_code'] . "_" . $semesterdetail['detail'] . "_SCPG";
                                        ?>
                                    </p>
                                    <p class="fs-3 m-0 p-0 fst-italic">
                                        <?php
                                        // Get name of current course
                                        $course = "SELECT course.* FROM course INNER JOIN course_offer ON course.code = course_offer.course_code WHERE course_offer.id = '" . $_SESSION['offerid'] . "'";
                                        $result = mysqli_query($connection, $course);
                                        $courseinfo = mysqli_fetch_assoc($result);

                                        echo $courseinfo['name'];
                                        ?>
                                    </p>
                                </div>
                                <div class="container-fluid p-0 ps-3 m-0 d-flex align-items-end">
                                    <ul class="nav nav-underline">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="../program_leader/course-manage-overview.php">Overview</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../program_leader/course-manage-student.php">Student</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link">Grades</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row m-0 p-0 pt-3 bg-white" id="course-container">
                                <div class="container">
                                    <!-- Row to carry lecturer name -->
                                    <div class="row m-0 p-0 py-2 gap-2">
                                        <div class="col-2 p-0 m-0 d-flex align-items-center">
                                            <label class="col-form-label p-0 m-0">Lecturer:</label>
                                        </div>
                                        <div class="col-auto p-0 m-0">
                                            <div class="p-0 m-0 d-flex align-items-center" id="row-lecturer">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Select lecturer modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Row to carry course name -->
                                    <div class="row m-0 mt-1 p-0 py-2 gap-2">
                                        <div class="col-2 p-0 m-0">
                                            <label class="col-form-label p-0 m-0">Course Name:</label>
                                        </div>
                                        <div class="col-auto p-0 m-0">
                                            <p class="p-0 m-0"><?php echo $courseinfo['name']; ?></p>
                                        </div>
                                    </div>

                                    <!-- Row to carry course code -->
                                    <div class="row m-0 mt-1 p-0 py-2 gap-2">
                                        <div class="col-2 p-0 m-0">
                                            <label class="col-form-label p-0 m-0">Course Code:</label>
                                        </div>
                                        <div class="col-auto p-0 m-0">
                                            <p class="p-0 m-0"><?php echo $courseinfo['code']; ?></p>
                                        </div>
                                    </div>

                                    <!-- Row to carry course credit hour -->
                                    <div class="row m-0 mt-1 p-0 py-2 gap-2">
                                        <div class="col-2 p-0 m-0">
                                            <label class="col-form-label p-0 m-0">Credit Hours:</label>
                                        </div>
                                        <div class="col-auto p-0 m-0">
                                            <p class="p-0 m-0"><?php echo $courseinfo['credit_hour']; ?></p>
                                        </div>
                                    </div>

                                    <!-- Row to carry course code -->
                                    <div class="row m-0 mt-1 p-0 py-2 gap-2">
                                        <div class="col-2 p-0 m-0">
                                            <label class="col-form-label p-0 m-0">Programme:</label>
                                        </div>
                                        <div class="col-auto p-0 m-0">
                                            <p class="p-0 m-0">
                                                <?php
                                                $programmename = "SELECT name FROM programme WHERE code = '" . $courseinfo['programme'] . "'";
                                                $result = mysqli_query($connection, $programmename);
                                                $programmename = mysqli_fetch_assoc($result);
                                                echo $programmename['name'];
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Row to carry course clo (label) -->
                                    <div class="row m-0 mt-2 p-0 py-2 gap-2 align-items-center">
                                        <div class="col-2 p-0 m-0 align-items-center">
                                            <label class="col-form-label p-0 m-0">Learning Outcomes:</label>
                                        </div>
                                    </div>

                                    <!-- Row to carry course clo (content) -->
                                    <div class="row m-0 p-0 gap-2 align-items-center">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">CLO</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col" class="text-center">Weightage (%)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Get the clos registered under current course
                                                $clo = "SELECT course.clos FROM course INNER JOIN course_offer ON course.code = course_offer.course_code WHERE course_offer.id = '" . $_SESSION['offerid'] . "'";
                                                $result = mysqli_query($connection, $clo);
                                                $cloid = mysqli_fetch_assoc($result);

                                                if ($cloid["clos"] != "UNDEFINED") {
                                                    $cloid = explode(",", $cloid['clos']); // Break the clos into individual pieces
                                                    $counter = 1;

                                                    // Fetch info of each individual clo
                                                    foreach ($cloid as $id) {
                                                        $clo = "SELECT * FROM clo WHERE id = '$id'";
                                                        $result = mysqli_query($connection, $clo);
                                                        $clodetail = mysqli_fetch_assoc($result);
                                                ?>
                                                        <tr>
                                                            <th class="py-3"><?php echo $counter; ?></th>
                                                            <td class="py-3"><?php echo $clodetail['details']; ?></td>
                                                            <td class="py-3 text-center"><?php echo $clodetail['weightage']; ?></td>
                                                        </tr>
                                                    <?php
                                                        $counter++;
                                                    }
                                                } else { ?>
                                                    <td colspan="3" class="py-3 text-center">CLO undefined yet.</td>
                                                <?php
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <?php
                                                // Get the clos registered under current course
                                                $clo = "SELECT course.clos FROM course INNER JOIN course_offer ON course.code = course_offer.course_code WHERE course_offer.id = '" . $_SESSION['offerid'] . "'";
                                                $result = mysqli_query($connection, $clo);
                                                $cloid = mysqli_fetch_assoc($result);

                                                if ($cloid["clos"] != "UNDEFINED") {
                                                    $cloid = explode(",", $cloid['clos']);
                                                    $sum = 0;
                                                    // Sum up the weightage of all clos
                                                    foreach ($cloid as $id) {
                                                        $weightage = "SELECT weightage FROM clo WHERE id = '$id'";
                                                        $result = mysqli_query($connection, $weightage);
                                                        $weightage = mysqli_fetch_assoc($result);
                                                        $sum += $weightage['weightage'];
                                                    }
                                                ?>
                                                    <tr>
                                                        <th class="py-3"></th>
                                                        <th class="py-3">Total</th>
                                                        <th class="py-3 text-center">
                                                            <?php
                                                            echo $sum; // Output the total weightage 
                                                            ?>
                                                        </th>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Functional script -->
        <script>
            $(document).ready(function() {
                function loadLecturer() {
                    $.ajax({
                        type: "POST",
                        url: "../program_leader/action.php",
                        data: {
                            load: "load",
                            offerid: sessionStorage.getItem("offerid")
                        },
                        success: function(response) {
                            if (response == "error") {
                                $("#row-lecturer").html(`<p class="p-0 m-0">Failed to load lecturer name. Please try again.</p>`);
                            } else if (response == "empty") {
                                $("#row-lecturer").html(`<p class="p-0 m-0">No lecturer assigned.</p>
                                                         <a class="btn btn-primary ms-2 assign-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Assign lecturer</a> `);
                            } else {
                                $("#row-lecturer").html(`<p class="p-0 m-0">${response[0]}</p>
                                                         &nbsp;<i class="bi ${response[1] === 'female' ? 'bi-gender-female' : 'bi-gender-male'}"></i>
                                                         <a class="btn btn-primary ms-2 assign-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Reassign lecturer</a>`);
                            }
                        }
                    })
                }

                $('#top-navbar').load('../program_leader/top-navbar.php'); // Load top navbar
                $('#side-navbar').load('../program_leader/side-navbar.html'); // Load side navbar
                $('.modal-content').load('../program_leader/load-assignmodal.php'); // Load modal
                loadLecturer() // Load lecturer name

                // Event listener for select button 
                $(document).on("click", ".select-btn", function(e) {
                    e.preventDefault();
                    const lecturerid = $(this).val();
                    sessionStorage.setItem("lecturerid", lecturerid); // Set lecturerid in session storage

                    $.ajax({
                        type: "POST",
                        url: "../program_leader/action.php",
                        data: {
                            select: "select",
                            offerid: sessionStorage.getItem('offerid'),
                            lecturerid: lecturerid
                        },
                        success: function(response) {
                            if (response == "error") {
                                alert("Failed to select lecturer. Please try again later.");
                                window.location.reload();
                            } else {
                                // Update modal content
                                $(".modal-dialog").removeClass("modal-lg"); // Reduce modal size
                                $(".modal-content").html(`<div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Assign lecturer</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" id="modal-body-2">
                                                Confirm assigning ${response[0]} as the lecturer for ${response[1]}?
                                                </div>
                                                <div class="modal-footer border border-0">
                                                    <button class="btn btn-secondary reselect-btn">Reselect</button>
                                                    <button type="button" class="btn btn-primary assign-btn2" data-bs-dismiss="modal">Assign</button>
                                                </div>`);
                            }
                        }
                    })
                })

                // Event listener for reselect button
                $(document).on("click", ".reselect-btn", function(e) {
                    e.preventDefault();
                    // Reset modal
                    $(".modal-dialog").addClass("modal-lg"); // Increase modal size
                    $('.modal-content').load('../program_leader/load-assignmodal.php');
                })

                // Event listener for assign button
                $(document).on("click", ".assign-btn", function(e) {
                    e.preventDefault();
                    $(".modal-dialog").addClass("modal-lg"); // Increase modal size
                    $('.modal-content').load('../program_leader/load-assignmodal.php');
                })

                // Event listener for confirm assign button
                $(document).on("click", ".assign-btn2", function(e) {
                    e.preventDefault();
                    const lecturerid = sessionStorage.getItem("lecturerid");
                    const offerid = sessionStorage.getItem("offerid");

                    $.ajax({
                        type: "POST",
                        url: "../program_leader/action.php",
                        data: {
                            assign: "assign",
                            lecturerid: lecturerid,
                            offerid: offerid
                        },
                        success: function(response) {
                            if (response == "success") {
                                loadLecturer() // Reload lecturer name
                            } else if (response == "error") {
                                alert("Failed to assign lecturer. Please try again later.");
                            }
                        }
                    })
                })
            })
        </script>
        <!-- Bootstrap CSS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
}
?>