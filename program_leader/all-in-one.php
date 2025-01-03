<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPR System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        #top-navbar {
            min-height: 79px;
            max-height: 79px;
            background-color: transparent;
        }

        #side-navbar {
            min-width: 256px;
            max-width: 256px;
            background-color: transparent;
            /*background-color: #f8f9fa;*/
        }

        /* The container is not 100% width under full screen width */
        #content-holder {
            width: calc(100% - 256px);
            overflow: auto;
        }

        /* The container will be 100% width when screen width falls under lg */
        @media (max-width: 992px) {
            #content-holder {
                width: 100%;
            }
        }

        .nav-btn {
            border-radius: 12px;
        }

        .nav-btn:hover {
            background-color: rgb(225, 225, 230);
        }

        .nav-btn:focus {
            box-shadow: none;
        }

        .bi-caret-right-fill {
            font-size: 0.6rem;
        }

        .bi-caret-down-fill {
            font-size: 0.6rem;
        }

        #content-container {
            height: 90vh;
        }

        #btn-holder {
            width: 90%;
        }

        #logo-full {
            min-width: 178px;
            max-width: 178px;
        }

        #logo-partial {
            min-height: 78px;
            max-height: 78px;
        }

        #logo-holder {
            min-width: 256px;
            max-width: 256px;
            background-color: transparent;
        }
    </style>
</head>

<body>
    <div class="container-fluid position-absolute h-100 p-0 m-0" id="main-container">
        <div class="row h-100 m-0 p-0">
            <!-- Top navbar -->
            <div class="row border-bottom border-2 m-0 p-0" id="top-navbar">
                <!-- Content in top-navbar.html will be loaded here -->
                <div class="m-0 p-0 d-flex align-items-center justify-content-left justify-content-lg-center" id="logo-holder">
                    <!-- Only visible at lg or above -->
                    <img class="img-fluid d-none d-lg-block" src="../media/scpg-logo-transparent.png" alt="SEGi College Penang"
                        id="logo-full">
                    <!-- Only visible at below lg -->
                    <img class="img-fluid d-block d-lg-none ps-3" src="../media/scpg-logo-transparent-noword.png"
                        alt="SEGi College Penang" id="logo-partial">
                </div>
            </div>

            <!-- Container for side navbar and content -->
            <div class="row m-0 p-0" id="content-container">
                <!-- Side navabr -->
                <div class="border-end border-2 m-0 p-0 d-none d-lg-flex justify-content-center" id="side-navbar">
                    <!-- Content in side-navbar.html will be loaded here -->
                    <div class="row m-0 p-0" id="btn-holder">
                        <ul class="nav flex-column w-100 mt-2 p-0">
                            <li class="nav-item w-100 m-0 p-0">
                                <a class="btn w-100 nav-btn link-secondary d-flex align-items-center" data-bs-toggle="collapse"
                                    href="#user" role="button" aria-expanded="false" aria-controls="user">
                                    <i class="bi bi-caret-right-fill me-1 d-none d-md-block"></i>
                                    <i class="bi bi-people"></i>
                                    <p class="text-start ms-2 m-0 p-0 d-none d-md-block">User</p>
                                </a>
                            </li>
                            <!-- Only visible when 'User' btn clicked -->
                            <div class="collapse navbar-collapse" id="user">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="btn w-100 text-start nav-btn link-secondary ps-5" role="button">
                                            &nbsp;&nbsp;&nbsp;&nbsp;Student
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="btn w-100 text-start nav-btn link-secondary ps-5" role="button">
                                            &nbsp;&nbsp;&nbsp;&nbsp;Lecturer
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <li class="nav-item w-100 m-0 p-0">
                                <a class="btn w-100 nav-btn link-secondary d-flex align-items-center" data-bs-toggle="collapse"
                                    href="#course" role="button" aria-expanded="false" aria-controls="course">
                                    <i class="bi bi-caret-right-fill me-1 d-none d-md-block"></i>
                                    <i class="bi bi-book"></i>
                                    <p class="text-start ms-2 m-0 p-0 d-none d-md-block">Courses</p>
                                </a>
                            </li>
                            <!-- Only visible when 'Courses' btn clicked -->
                            <div class="collapse navbar-collapse" id="course">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="btn w-100 text-start nav-btn link-secondary ps-5" role="button">
                                            &nbsp;&nbsp;&nbsp;&nbsp;Create new
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="btn w-100 text-start nav-btn link-secondary ps-5" role="button">
                                            &nbsp;&nbsp;&nbsp;&nbsp;List
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <li class="nav-item w-100 m-0 p-0">
                                <a class="btn w-100 nav-btn link-secondary d-flex align-items-center" data-bs-toggle="collapse"
                                    href="#grade" role="button" aria-expanded="false" aria-controls="grade">
                                    <i class="bi bi-caret-right-fill me-1 d-none d-md-block"></i>
                                    <i class="bi bi-clipboard"></i>
                                    <p class="text-start ms-2 m-0 p-0 d-none d-md-block">Grades</p>
                                </a>
                            </li>
                            <!-- Only visible when 'Courses' btn clicked -->
                            <div class="collapse navbar-collapse" id="grade">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="btn w-100 text-start nav-btn link-secondary ps-5" role="button">
                                            &nbsp;&nbsp;&nbsp;&nbsp;Create new
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="btn w-100 text-start nav-btn link-secondary ps-5" role="button">
                                            &nbsp;&nbsp;&nbsp;&nbsp;List
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </ul>
                    </div>
                </div>
                <div class="container" id="content-holder"></div>
            </div>
        </div>
    </div>
    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- Functional script -->
    <script>
        const caretbtn = document.getElementsByClassName("nav-btn");
        const icons = document.getElementsByClassName("bi-caret-right-fill");

        for (let i = 0; i < caretbtn.length; i++) {
            // Add click event listener to each button
            caretbtn[i].addEventListener("click", (e) => {
                // Find the icon element within the clicked button
                const icon = e.target.querySelector(".bi-caret-right-fill, .bi-caret-down-fill");
                if (icon) {
                    // Toggle between the classes
                    if (icon.classList.contains("bi-caret-right-fill")) {
                        icon.classList.remove("bi-caret-right-fill");
                        icon.classList.add("bi-caret-down-fill");
                    } else {
                        icon.classList.remove("bi-caret-down-fill");
                        icon.classList.add("bi-caret-right-fill");
                    }
                }
            });
        }
    </script>
</body>

</html>