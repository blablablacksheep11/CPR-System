<?php
session_start();
include('../include/database.php');
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
                                        <a class="nav-link" href="../program_leader/course-manage-overview.php">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="../program_leader/course-manage-student.php">Student</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link">Grades</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row m-0 p-0 pt-3 bg-white" id="course-container">
                            <div class="container p-0 m-0">
                                <div class="row p-0 m-0 px-4">
                                    <table class="table table-sm table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Intake</th>
                                                <th scope="col">Programme</th>
                                                <th scope="col">Action</th>
                                                <th scope="col" class="d-flex justify-content-end"><a class="btn btn-primary" id="add-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add</a></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            <!-- Student list will be loaded here -->
                                        </tbody>
                                    </table>

                                    <!-- Select student modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                            </div>
                                        </div>
                                    </div>
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
            function loadEnrolment() {
                $.ajax({
                    type: "POST",
                    url: "../program_leader/action.php",
                    data: {
                        enrolment: "enrolment",
                        offerid: sessionStorage.getItem('offerid'),
                        currentdate: sessionStorage.getItem("currentdate")
                    },
                    success: function(response) {
                        if (response == 'error') {
                            $('#tbody').html(failedMessage); // Display failed message
                        } else {
                            if (response == 'empty') {
                                $('#tbody').html(nullMessage); // Display empty message
                            } else {
                                let counter = 1;
                                $('#tbody').html(
                                    response.map(function(row) { // Display search result
                                        return `<tr>
                                                    <th class='py-3' scope='row'>${counter++}</th>;
                                                    <td class='py-3'>${row.student_id}</td>
                                                    <td class='py-3'>${row.name}&nbsp;<i class="bi ${row.gender === 'female' ? 'bi-gender-female' : 'bi-gender-male'} ps-1"></i></td>
                                                    <td class='py-3'>${row.email}</td>
                                                    <td class='py-3'>${row.intake}</td>
                                                    <td class='py-3'>${row.programme}</td>
                                                    <td colspan='2' class="py-3">
                                                        <select class="form-select" id="action" data-value="${row.id}">
                                                            <option value="null" selected disabled hidden>Action</option>
                                                            <option value="view">View</option>
                                                            <option value="remove">Remove</option>
                                                        </select>
                                                    </td>
                                                </tr>`;
                                    }))
                            }
                        }
                    }
                })
            }

            $('#top-navbar').load('../program_leader/top-navbar.php'); // Load top navbar
            $('#side-navbar').load('../program_leader/side-navbar.html'); // Load side navbar
            loadEnrolment(); // Load enrolment data


            let failedMessage = `<tr><td colspan="8" class="text-center py-3 border border-0">Search failed. Please try again later.</td></tr>`; // Message to display when search failed
            let nullMessage = `<tr><td colspan="8" class="text-center py-3 border border-0">No students found enrolled in this course.<br><a class="btn btn-primary mt-2" id="add-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add</a></td></tr>`; // Message to display when no student found
            let emptyMessage = `<tr><td colspan="8" class="text-center py-3 border border-0">No student found.</td></tr>`; // Message to display when no student found

            $(document).on("click", "#add-btn", function(e) {
                e.preventDefault();
                $('.modal-content').load('../program_leader/load-enrolmodal.php'); // Load modal
            })


            $(document).on("click", "#add-btn2", function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "../program_leader/action.php",
                    data: {
                        add: "add",
                        offerid: sessionStorage.getItem('offerid'),
                        students: students,
                        currentdate: sessionStorage.getItem("currentdate")
                    },
                    success: function(response) {
                        if (response == "success") {
                            loadEnrolment();
                        } else if (response == "error") {
                            alert("Error adding student");
                        }
                    }
                })
            })

            $(document).on("change", "#action", function(e) {
                e.preventDefault();
                const action = $(this).val();
                const studentid = $(this).data("value");

                if (action == "remove") {
                    $.ajax({
                        type: "POST",
                        url: "../program_leader/action.php",
                        data: {
                            remove2: "remove",
                            offerid: sessionStorage.getItem('offerid'),
                            studentid: studentid,
                            currentdate: sessionStorage.getItem("currentdate")
                        },
                        success: function(response) {
                            if (response == "success") {
                                loadEnrolment();
                            } else if (response == "error") {
                                alert("Error removing student");
                            }
                        }
                    })
                }
            })
        })
    </script>
    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>