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
        .card:hover {
            #name {
                text-decoration: underline;
            }

            .card-body {
                background-color: rgb(245, 245, 245);
            }
        }

        .card-img-top {
            height: 60%;
        }

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

        #searchbar-container {
            height: 140px;
        }

        #searchbar-input {
            border-left: none;
        }

        #searchbar-input:focus {
            box-shadow: none;
            border-color: rgba(203, 208, 221, 0.54);
        }

        #course-container {
            min-height: calc(100% - 140px);
            max-height: fit-content;
        }

        #dropdown-menu {
            width: 300px;
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
                        <div class="row m-0 p-0" id="searchbar-container">
                            <div class="col-8 p-0 m-0">
                                <div class="row w-100 h-50 m-0 p-0 d-flex">
                                    <nav class="pt-1 ps-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">Courses</li>
                                            <li class="breadcrumb-item active"><a href="course-list.php">List</a></li>
                                        </ol>
                                    </nav>
                                    <h2 class="m-0 ps-4">Course List</h2>
                                </div>
                                <div class="row w-100 h-50 m-0 p-0 d-flex align-items-center">
                                    <form>
                                        <!-- Search bar -->
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border border-end-0 m-0" id="basic-addon1">
                                                <i class="bi bi-search"></i>
                                            </span>
                                            <input type="text" class="form-control m-0 ps-0" placeholder="Search" id="searchbar-input">
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-4 p-0 m-0 d-flex align-items-end">
                                <div class="row w-100 h-50 p-0 m-0 d-flex align-items-center justify-content-evenly justify-content-xl-end">
                                    <div class="col-6 col-md-4 p-0 m-0 me-5 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-funnel fs-5 me-1 d-none d-md-block"></i>
                                        <!-- Filter dropdown -->
                                        <div class="dropdown">
                                            <button class="btn bg-white border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Filter
                                            </button>
                                            <div class="dropdown-menu p-3" id="dropdown-menu">
                                                <form autocomplete="off" id="filter-form">
                                                    <!-- Year filtration-->
                                                    <label for="year" class="form-label text-secondary mt-2 m-0">Year</label>
                                                    <select class="form-select" id="year">
                                                        <option selected disabled hidden>Year</option>
                                                        <?php
                                                        $year = "SELECT DISTINCT year FROM course WHERE department = '" . $_SESSION['department'] . "' ORDER BY year";
                                                        $result = mysqli_query($connection, $year);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo "<option value='" . $row['year'] . "'>Year " . $row['year'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="mt-3 d-flex justify-content-end">
                                                        <input type="reset" class="btn btn-outline-dark me-2">
                                                        <input type="submit" class="btn btn-primary" id="filter-submit" value="Apply">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Row to carry table -->
                        <div class="row m-0 p-0 pt-3 d-flex align-items-center bg-white" id="course-container">
                            <div class="col-12 px-4 m-0 h-100">
                                <div class="container-fluid text-center p-0 m-0">
                                    <div class="row row-cols-4 p-0 m-0" id="course-list">
                                        <!-- The content in load-course.php will be loaded here -->
                                    </div>
                                    <!-- Modal -->
                                    <!-- Pop up alert that will be displayed when program leader offer a course -->
                                    <!-- The modal is hidden initially -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <!-- The content in load-modal will be loaded here -->
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
            // Load top navbar content
            $('#top-navbar').load('../academic_administrator/top-navbar.php');
            // Load side navbar content
            $('#side-navbar').load('../academic_administrator/side-navbar.html');
            // The Js that existed in top-navbar.html and side-navabr.html will also be loaded and bring effects to this document

            $.ajax({
                type: "POST",
                url: "../academic_administrator/load-course.php",
                data: {
                    currentdate: sessionStorage.getItem("currentdate")
                },
                success: function(response) {
                    if (response == 'error') {
                        const failedmessage = document.createElement('div');
                        failedmessage.classList.add('container-fluid');
                        failedmessage.classList.add('text-center');
                        failedmessage.classList.add('mt-3');
                        failedmessage.innerHTML = 'Search failed. Please try again later.';
                        $('#course-list').html(failedmessage);
                    } else {
                        if (response == 'empty') {
                            const emptymessage = document.createElement('div');
                            emptymessage.classList.add('container-fluid');
                            emptymessage.classList.add('text-center');
                            emptymessage.classList.add('mt-3');
                            emptymessage.innerHTML = 'No course found.';
                            $('#course-list').html(emptymessage);
                        } else {
                            $('#course-list').load('../academic_administrator/load-course.php');
                        }
                    }
                }
            })

            // Load modal
            // This is compulsory
            // Error if removed
            $('#staticBackdrop').load('../program_leader/load-modal.php');

            // Search bar functionality
            $(document).on('input', '#searchbar-input', function(e) {
                e.preventDefault();
                const query = $(this).val();

                // When there is query in the serach bar
                // Load the courses according to the query
                if (query.length > 0) {
                    $.ajax({
                        type: 'POST',
                        url: '../program_leader/search-course.php',
                        data: {
                            search: 'search',
                            query: query
                        },
                        success: function(response) {
                            // If the data fetch failed
                            if (response == 'Unsuccessful') {
                                const failedmessage = document.createElement('div');
                                failedmessage.classList.add('container-fluid');
                                failedmessage.classList.add('text-center');
                                failedmessage.classList.add('mt-3');
                                failedmessage.innerHTML = 'Search failed. Please try again later.';
                                $('#course-list').html(failedmessage);
                            } else {
                                // If the data fetch is successful but empty
                                if (response == 'empty') {
                                    const emptymessage = document.createElement('div');
                                    emptymessage.classList.add('container-fluid');
                                    emptymessage.classList.add('text-center');
                                    emptymessage.classList.add('mt-3');
                                    emptymessage.innerHTML = 'No course found.';
                                    $('#course-list').html(emptymessage);
                                }
                                // If the data fetch is successful and there is smth
                                else {
                                    $('#course-list').html(
                                        response.map(function(row) {
                                            return `<div class="col-12 col-md-6 col-xl-4 col-xxl-3 d-flex mb-3 align-items-center justify-content-center">
                                                        <div class="card" style="width: 21rem; height: 18rem;">
                                                            <img src="../media/${row.image}" class="card-img-top" alt="${row.name}">
                                                            <div class="card-body p-0 m-0">
                                                                <div class="row w-100 p-0 px-3 m-0 mt-1">
                                                                    <p class="card-text fs-6 text-body-secondary m-0 p-0 text-start" id="code">${row.code}</p>
                                                                    <p class="card-text fw-bold fs-6 m-0 p-0 text-start" id="name">${row.name}</p>
                                                                </div>
                                                                <div class="row w-100 p-0 px-3 m-0 mb-2 position-absolute bottom-0 d-flex justify-content-between">
                                                                    <div class="col-7 p-0 m-0 d-flex align-items-end">
                                                                        <p class="card-text text-start m-0 p-0" id="credit-hour" style="font-size: small;">Credit hours:&nbsp;${row.credit_hour}</p>
                                                                    </div>
                                                                    <div class="col-5 p-0 m-0 d-flex align-items-center">
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                Action
                                                                            </button>
                                                                            <ul class="dropdown-menu">
                                                                                <li><a class="dropdown-item" data-value="${row.code}">View</a></li>
                                                                                <li><a class="dropdown-item offer-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-value="${row.code}">Offer this course</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>`;
                                        }))
                                }
                            }
                        }
                    })
                }
                // When there is no query in the search bar
                else {
                    // Load student list
                    $('#course-list').load('../program_leader/load-course.php');
                }
            })

            $(document).on("click", "#filter-submit", function(e) {
                e.preventDefault();
                let data = [];
                // Get the value for category
                const query1 = $('#year').val();
                if (query1) {
                    const year = `year = '${query1}'`;
                    data.push(year);
                }

                console.log(data);

                $.ajax({
                    type: "POST",
                    url: "../program_leader/search-course.php",
                    data: {
                        filter: "filter",
                        data: data
                    },
                    success: function(response) {
                        $('#filter-form')[0].reset(); // Reset the form
                        $('#dropdown-menu').removeClass('show'); // Hide the dropdown
                        // If the data fetch failed
                        if (response == 'Unsuccessful') {
                            const failedmessage = document.createElement('div');
                            failedmessage.classList.add('container-fluid');
                            failedmessage.classList.add('text-center');
                            failedmessage.classList.add('mt-3');
                            failedmessage.innerHTML = 'Search failed. Please try again later.';
                            $('#course-list').html(failedmessage);
                        } else {
                            // If the data fetch is successful but empty
                            if (response == 'empty') {
                                const emptymessage = document.createElement('div');
                                emptymessage.classList.add('container-fluid');
                                emptymessage.classList.add('text-center');
                                emptymessage.classList.add('mt-3');
                                emptymessage.innerHTML = 'No course found.';
                                $('#course-list').html(emptymessage);
                            }
                            // If the data fetch is successful and there is smth
                            else {
                                $('#course-list').html(
                                    response.map(function(row) {
                                        return `<div class="col-12 col-md-6 col-xl-4 col-xxl-3 d-flex mb-3 align-items-center justify-content-center">
                                                        <div class="card" style="width: 21rem; height: 18rem;">
                                                            <img src="../media/${row.image}" class="card-img-top" alt="${row.name}">
                                                            <div class="card-body p-0 m-0">
                                                                <div class="row w-100 p-0 px-3 m-0 mt-1">
                                                                    <p class="card-text fs-6 text-body-secondary m-0 p-0 text-start" id="code">${row.code}</p>
                                                                    <p class="card-text fw-bold fs-6 m-0 p-0 text-start" id="name">${row.name}</p>
                                                                </div>
                                                                <div class="row w-100 p-0 px-3 m-0 mb-2 position-absolute bottom-0 d-flex justify-content-between">
                                                                    <div class="col-7 p-0 m-0 d-flex align-items-end">
                                                                        <p class="card-text text-start m-0 p-0" id="credit-hour" style="font-size: small;">Credit hours:&nbsp;${row.credit_hour}</p>
                                                                    </div>
                                                                    <div class="col-5 p-0 m-0 d-flex align-items-center">
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                Action
                                                                            </button>
                                                                            <ul class="dropdown-menu">
                                                                                <li><a class="dropdown-item" data-value="${row.code}">View</a></li>
                                                                                <li><a class="dropdown-item offer-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-value="${row.code}">Offer this course</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>`;
                                    }))
                            }
                        }
                    }
                })
            })

            // When a courses is selected to be offered
            $(document).on("click", ".offer-btn", function(e) {
                e.preventDefault();
                const coursecode = $(this).data("value"); // Get the course code
                const currentdate = sessionStorage.getItem("currentdate"); // Fetch the currentdate from session storage, client side
                sessionStorage.setItem("coursecode", coursecode);

                $.ajax({
                    type: "POST",
                    url: "../program_leader/load-modal.php",
                    data: {
                        coursecode: coursecode,
                        currentdate: currentdate
                    },
                    success: function(response) {
                        if (response == "error") {
                            alert("This course cannot be offered currently. Please try again later.");
                        } else {
                            // Load modal
                            // The content in modal will channged according to the course offered status
                            // refer to load-modal.php
                            $('#staticBackdrop').load('../program_leader/load-modal.php');
                        }
                    }
                })
            })

            // When the confirmed
            // Pop up confirmation in modal
            $(document).on("click", ".confirm-btn", function(e) {
                e.preventDefault();
                const offer = "offer";
                const coursecode = sessionStorage.getItem("coursecode"); // Fetch the coursecode from session storage, client side
                const currentdate = sessionStorage.getItem("currentdate"); // Fetch the currentdate from session storage, client side

                $.ajax({
                    type: "POST",
                    url: "../program_leader/action.php",
                    data: {
                        offer: offer,
                        coursecode: coursecode,
                        currentdate: currentdate
                    },
                    success: function(response) {
                        if (response == "success") {
                            alert("Course offered successfully.");
                        } else if (response == "error") {
                            alert("Failed to offer this course.");
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