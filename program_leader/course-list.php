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
            <div class="row border-bottom border-1 m-0 p-0" id="top-navbar">
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
                                                    <!-- Category filtration-->
                                                    <label for="category" class="form-label text-secondary mt-2 m-0">Category</label>
                                                    <select class="form-select" id="category">
                                                        <option selected disabled hidden>Category</option>
                                                        <?php
                                                        $code = "SELECT DISTINCT SUBSTRING(code,1,3) AS code FROM course WHERE department = '" . $_SESSION['department'] . "'";
                                                        $result = mysqli_query($connection, $code);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $name = "SELECT name FROM course_category WHERE code = '" . $row['code'] . "' AND department = '" . $_SESSION['department'] . "'";
                                                            $result2 = mysqli_query($connection, $name);
                                                            $coursename = mysqli_fetch_assoc($result2);
                                                            echo "<option value='" . $row['code'] . "'>" . $coursename['name'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>

                                                    <!-- Programme filtration-->
                                                    <label for="programme" class="form-label text-secondary mt-2 m-0">Programme</label>
                                                    <select class="form-select" id="programme">
                                                        <option selected disabled hidden>Programme</option>
                                                        <?php
                                                        $programme = "SELECT DISTINCT programme FROM course WHERE department = '" . $_SESSION['department'] . "'";
                                                        $result = mysqli_query($connection, $programme);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $programme = "SELECT name FROM programme WHERE code = '" . $row['programme'] . "'";
                                                            $result2 = mysqli_query($connection, $programme);
                                                            $programmename = mysqli_fetch_assoc($result2);
                                                            echo "<option value='" . $row['programme'] . "'>" . $programmename['name'] . "</option>";
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
                                        <!-- The saerch can work edi but the size of column will auto adjust -->
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
            $('#top-navbar').load('../program_leader/top-navbar.html');
            // Load side navbar content
            $('#side-navbar').load('../program_leader/side-navbar.html');
            // The Js that existed in top-navbar.html and side-navabr.html will also be loaded and bring effects to this document

            // Load student list
            $('#course-list').load('../program_leader/load-course.php');

            // Search bar functionality
            $(document).on('input', '#searchbar-input', function(e) {
                e.preventDefault();
                const query = $(this).val();

                if (query.length > 0) {
                    $.ajax({
                        type: 'POST',
                        url: '../program_leader/search-course.php',
                        data: {
                            search: 'search',
                            query: query
                        },
                        success: function(response) {
                            if (response == 'Unsuccessful') {
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
                                    $('#course-list').html(
                                        response.map(function(row) {
                                            return `<div class="col-12 col-md-6 col-xl-4 col-xxl-3 d-flex mb-3 align-items-center justify-content-center">
                                                        <div class="card" style="width: 21rem; height: 18rem;" role="button">
                                                            <img src="../media/${row.image}" class="card-img-top" alt="${row.name}">
                                                            <div class="card-body p-0 px-3 m-0 d-flex flex-column align-items-start">
                                                                <p class="card-text fs-6 text-body-secondary m-0 mt-1 p-0 text-start" id="code">${row.code}</p>
                                                                <p class="card-text fw-bold fs-6 m-0 p-0 text-start" id="name">${row.name}</p>
                                                                <p class="card-text m-0 mb-2 p-0 text-start position-absolute bottom-0" id="credit-hour" style="font-size: small;">Credit hours:&nbsp;${row.credit_hour}</p>
                                                            </div>
                                                        </div>
                                                    </div>`;
                                        }))
                                }
                            }
                        }
                    })
                } else {
                    // Load student list
                    $('#course-list').load('../program_leader/load-course.php');
                }
            })

            $(document).on("click", "#filter-submit", function(e) {
                e.preventDefault();
                let data = [];
                // Get the value for category
                const query1 = $('#category').val();
                if (query1) {
                    const category = `code LIKE '${query1}%'`;
                    data.push(category);    
                }
                // Get the value for programme
                const query2 = $('#programme').val();
                if (query2) {
                    const programme = `programme = '${query2}'`;
                    data.push(programme);
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
                        $('#filter-form')[0].reset();
                        $('#dropdown-menu').removeClass('show');
                        if (response == 'Unsuccessful') {
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
                                $('#course-list').html(
                                    response.map(function(row) {
                                        return `<div class="col-12 col-md-6 col-xl-4 col-xxl-3 d-flex mb-3 align-items-center justify-content-center">
                                                        <div class="card" style="width: 21rem; height: 18rem;" role="button">
                                                            <img src="../media/${row.image}" class="card-img-top" alt="${row.name}">
                                                            <div class="card-body p-0 px-3 m-0 d-flex flex-column align-items-start">
                                                                <p class="card-text fs-6 text-body-secondary m-0 mt-1 p-0 text-start" id="code">${row.code}</p>
                                                                <p class="card-text fw-bold fs-6 m-0 p-0 text-start" id="name">${row.name}</p>
                                                                <p class="card-text m-0 mb-2 p-0 text-start position-absolute bottom-0" id="credit-hour" style="font-size: small;">Credit hours:&nbsp;${row.credit_hour}</p>
                                                            </div>
                                                        </div>
                                                    </div>`;
                                    }))
                            }
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