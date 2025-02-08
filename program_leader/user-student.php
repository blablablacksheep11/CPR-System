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

        #table-container {
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
                                            <li class="breadcrumb-item active">People</li>
                                            <li class="breadcrumb-item active"><a href="user-student.php">Student</a></li>
                                        </ol>
                                    </nav>
                                    <h2 class="m-0 ps-4">Student</h2>
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
                                <div class="row w-100 h-50 p-0 m-0 d-flex align-items-center justify-content-evenly justify-content-xl-center">
                                    <div class="col-6 col-md-5 p-0 me-xl-1 m-0 d-flex align-items-center justify-content-end">
                                        <i class="bi bi-sort-down fs-5 me-1 d-none d-md-block"></i>
                                        <!-- Sort dropdown -->
                                        <div class="dropdown">
                                            <button class="btn bg-white border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Sort
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item sort-option" role="button" data-value="CAST(SUBSTRING(student.student_id, 5) AS INT)">ID: Ascending</a></li>
                                                <li><a class="dropdown-item sort-option" role="button" data-value="CAST(SUBSTRING(student.student_id, 5) AS INT) DESC">ID: Descending</a></li>
                                                <li><a class="dropdown-item sort-option" role="button" data-value="student.name">Name: A to Z</a></li>
                                                <li><a class="dropdown-item sort-option" role="button" data-value="student.name DESC">Name: Z to A</a></li>
                                                <li><a class="dropdown-item sort-option" role="button" data-value="student.email">Email: A to Z</a></li>
                                                <li><a class="dropdown-item sort-option" role="button" data-value="student.email DESC">Email: Z to A</a></li>
                                                <li><a class="dropdown-item sort-option" role="button" data-value="student.intake">Intake: Ascending</a></li>
                                                <li><a class="dropdown-item sort-option" role="button" data-value="student.intake DESC">Intake: Descending</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-4 p-0 m-0 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-funnel fs-5 me-1 d-none d-md-block"></i>
                                        <!-- Filter dropdown -->
                                        <div class="dropdown">
                                            <button class="btn bg-white border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Filter
                                            </button>
                                            <div class="dropdown-menu p-3" id="dropdown-menu">
                                                <form autocomplete="off" id="filter-form">
                                                    <!-- Name filtration-->
                                                    <label class="form-label text-secondary m-0 mb-1">Name</label>
                                                    <div class="m-0 p-0 d-flex justify-content-start">
                                                        <div class="me-3">
                                                            <label for="name-start" class="form-label m-0">Start with:</label>
                                                            <input type="text" class="form-control" id="name-start">
                                                        </div>
                                                        <div>
                                                            <label for="name-end" class="form-label m-0">End with:</label>
                                                            <input type="text" class="form-control" id="name-end">
                                                        </div>
                                                    </div>

                                                    <!-- Gender filtration-->
                                                    <div class="mt-2 m-0 d-flex justify-content-start">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="gender" id="male-radio" value="male">
                                                            <label class="form-check-label" for="male-radio">
                                                                Male
                                                            </label>
                                                        </div>
                                                        <div class="form-check ms-3">
                                                            <input class="form-check-input" type="radio" name="gender" id="female-radio" value="female">
                                                            <label class="form-check-label" for="female-radio">
                                                                Female
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <!-- Email filtration-->
                                                    <label class="form-label text-secondary m-0 mt-2 mb-1">Email</label>
                                                    <div class="m-0 p-0 d-flex justify-content-start">
                                                        <div class="me-3">
                                                            <label for="email-start" class="form-label m-0">Start with:</label>
                                                            <input type="text" class="form-control" id="email-start">
                                                        </div>
                                                        <div>
                                                            <label for="email-end" class="form-label m-0">End with:</label>
                                                            <input type="text" class="form-control" id="email-end">
                                                        </div>
                                                    </div>

                                                    <!-- Intake filtration-->
                                                    <label for="intake" class="form-label text-secondary mt-2 m-0">Intake</label>
                                                    <select class="form-select" id="intake">
                                                        <option selected disabled hidden>Intake</option>
                                                        <?php
                                                        $programmeCode = [];

                                                        // Get the programme the register under the program leader
                                                        $programme = "SELECT * FROM programme WHERE program_leader = '" . $_SESSION['id'] . "' ORDER BY name";
                                                        $result = mysqli_query($connection, $programme);

                                                        while ($programmeinfo = mysqli_fetch_assoc($result)) {
                                                            $programmeCode[] = $programmeinfo['code']; // Store the programme code in an array
                                                        }

                                                        // Convert the array into a string format for SQL
                                                        $programList = "'" . implode("', '", $programmeCode) . "'";

                                                        $intake = "SELECT DISTINCT intake FROM student WHERE programme IN ($programList) ORDER BY intake";
                                                        $result = mysqli_query($connection, $intake);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo "<option value='" . $row['intake'] . "'>" . $row['intake'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>

                                                    <!-- Programme filtration-->
                                                    <label for="programme" class="form-label text-secondary mt-2 m-0">Programme</label>
                                                    <select class="form-select" id="programme">
                                                        <option selected disabled hidden>Programme</option>
                                                        <?php
                                                        $programme = "SELECT * FROM programme WHERE program_leader = '" . $_SESSION['id'] . "' ORDER BY name";
                                                        $result = mysqli_query($connection, $programme);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo "<option value='" . $row['code'] . "'>" . $row['name'] . "</option>";
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
                        <div class="row m-0 p-0 pt-1 d-flex align-items-center bg-white" id="table-container">
                            <div class="col-12 px-4 m-0 h-100">
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
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        <!-- Student list will be loaded here -->
                                    </tbody>
                                </table>
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
            // Function to load student list
            function loadStudent() {
                $.ajax({
                    type: 'POST',
                    url: '../program_leader/action.php',
                    data: {
                        student: "student"
                    },
                    success: function(response) {
                        if (response == 'error') {
                            $('#tbody').html(failedMessage); // Display failed message
                        } else {
                            if (response == 'empty') {
                                $('#tbody').html(emptyMessage); // Display empty message
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
                                                    <td class="py-3">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option value="${row.id}" selected>View</option>
                                                            <option value="${row.id}">Edit</option>
                                                            <option value="${row.id}">Delete</option>
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
            loadStudent(); // Load student list


            let failedMessage = `<tr><td colspan="7" class="text-center py-3 border border-0">Search failed. Please try again later.</td></tr>`; // Message to display when search failed
            let emptyMessage = `<tr><td colspan="7" class="text-center py-3 border border-0">No student found.</td></tr>`; // Message to display when no student found

            // Event listener for search bar
            $(document).on('input', '#searchbar-input', function(e) {
                e.preventDefault();
                const query = $(this).val(); // Get search query

                if (query.length > 0) {
                    $.ajax({
                        type: 'POST',
                        url: '../program_leader/action.php',
                        data: {
                            student: "student",
                            search: 'search',
                            query: query
                        },
                        success: function(response) {
                            if (response == 'error') {
                                $('#tbody').html(failedMessage); // Display failed message
                            } else {
                                if (response == 'empty') {
                                    $('#tbody').html(emptyMessage); // Display empty message
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
                                                    <td class="py-3">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option value="${row.id}" selected>View</option>
                                                            <option value="${row.id}">Edit</option>
                                                            <option value="${row.id}">Delete</option>
                                                        </select>
                                                    </td>
                                                </tr>`;
                                        }))
                                }
                            }
                        }
                    })
                } else {
                    loadStudent(); // Load student list
                }
            })

            // Event listener for sort dropdown
            $(document).on("click", ".sort-option", function(e) {
                e.preventDefault();
                const query = $(this).data('value'); // Get sort query

                $.ajax({
                    type: "POST",
                    url: "../program_leader/action.php",
                    data: {
                        student: "student",
                        sort: "sort",
                        query: query
                    },
                    success: function(response) {
                        if (response == 'error') {
                            $('#tbody').html(failedMessage); // Display failed message
                        } else {
                            if (response == 'empty') {
                                $('#tbody').html(emptyMessage); // Display empty message
                            } else {
                                let counter = 1;
                                $('#tbody').html(
                                    response.map(function(row) { // Display sort result
                                        return `<tr>
                                                    <th class='py-3' scope='row'>${counter++}</th>;
                                                    <td class='py-3'>${row.student_id}</td>
                                                    <td class='py-3'>${row.name}&nbsp;<i class="bi ${row.gender === 'female' ? 'bi-gender-female' : 'bi-gender-male'} ps-1"></i></td>
                                                    <td class='py-3'>${row.email}</td>
                                                    <td class='py-3'>${row.intake}</td>
                                                    <td class='py-3'>${row.programme}</td>
                                                    <td class="py-3">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option value="${row.id}" selected>View</option>
                                                            <option value="${row.id}">Edit</option>
                                                            <option value="${row.id}">Delete</option>
                                                        </select>
                                                    </td>
                                                </tr>`;
                                    }))
                            }
                        }
                    }
                })
            })

            // Event listener for filter dropdown
            $(document).on("click", "#filter-submit", function(e) {
                e.preventDefault();
                let data = [];

                // Get all filter values, format them into SQL query
                const filters = [{
                        id: '#name-start',
                        format: val => `student.name LIKE '${val}%'`
                    },
                    {
                        id: '#name-end',
                        format: val => `student.name LIKE '%${val}'`
                    },
                    {
                        id: 'input[name="gender"]:checked',
                        format: val => `student.gender = '${val}'`
                    },
                    {
                        id: '#email-start',
                        format: val => `student.email LIKE '${val}%'`
                    },
                    {
                        id: '#email-end',
                        format: val => `student.email LIKE '%${val}'`
                    },
                    {
                        id: '#intake',
                        format: val => `student.intake = ${val}`
                    },
                    {
                        id: '#programme',
                        format: val => `student.programme = '${val}'`
                    }
                ];

                // Loop through filters, append to data array if value is not empty
                filters.forEach(filter => {
                    const value = $(filter.id).val();
                    if (value) data.push(filter.format(value));
                });

                $.ajax({
                    type: "POST",
                    url: "../program_leader/action.php",
                    data: {
                        student: "student",
                        filter: "filter",
                        data: data
                    },
                    success: function(response) {
                        $('#filter-form')[0].reset(); // Reset filter form
                        $('#dropdown-menu').removeClass('show'); // Hide filter dropdown
                        if (response == 'error') {
                            $('#tbody').html(failedMessage); // Display failed message
                        } else {
                            if (response == 'empty') {
                                $('#tbody').html(emptyMessage); // Display empty message
                            } else {
                                let counter = 1;
                                $('#tbody').html(
                                    response.map(function(row) { // Display filter result
                                        return `<tr>
                                                    <th class='py-3' scope='row'>${counter++}</th>;
                                                    <td class='py-3'>${row.student_id}</td>
                                                    <td class='py-3'>${row.name}&nbsp;<i class="bi ${row.gender === 'female' ? 'bi-gender-female' : 'bi-gender-male'} ps-1"></i></td>
                                                    <td class='py-3'>${row.email}</td>
                                                    <td class='py-3'>${row.intake}</td>
                                                    <td class='py-3'>${row.programme}</td>
                                                    <td class="py-3">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option value="${row.id}" selected>View</option>
                                                            <option value="${row.id}">Edit</option>
                                                            <option value="${row.id}">Delete</option>
                                                        </select>
                                                    </td>
                                                </tr>`;
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