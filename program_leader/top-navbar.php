<?php
session_start();
include("../include/database.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPR System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
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

        #profile-holder {
            min-width: 220px;
            max-width: 220px;
            background-color: transparent;
        }

        #burger-btn {
            border-radius: 12px;
        }

        #burger-btn:hover {
            background-color: rgb(225, 225, 230);
        }

        #burger-btn:focus {
            box-shadow: none;
        }
    </style>
</head>

<body>
    <!-- Logo holder -->
    <div class="m-0 p-0 d-flex align-items-center justify-content-left justify-content-lg-center" id="logo-holder">
        <!-- Hamburger menu -->
        <!-- The hamburger menu only visible when screen width falls below lg -->
        <!-- The hamburger menu btn doesn't include class 'nav-btn' and 'primary-btn' like those in side-navbar.html to prevent CSS and JS conflicts -->
        <a class="btn link-secondary d-flex d-lg-none align-items-center ms-2" value="side-navbar" id="burger-btn">
            <i class="bi bi-list fs-3"></i>
        </a>
        <!-- SEGi logo -->
        <!-- Only visible at lg or above -->
        <img class="img-fluid d-none d-lg-block" src="../media/scpg-logo-transparent.png" alt="SEGi College Penang"
            id="logo-full">
        <!-- Only visible at below lg -->
        <img class="img-fluid d-block d-lg-none ps-3" src="../media/scpg-logo-transparent-noword.png"
            alt="SEGi College Penang" id="logo-partial">
    </div>

    <div class="m-0 p-0 d-flex align-items-center justify-content-center" id="profile-holder">
        <i class="bi bi-person-circle fs-2 text-body-tertiary"></i>
        <div class="dropdown">
            <button class="btn bg-transparent dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $_SESSION["name"]; ?>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item">Profile</a></li>
              <li><a class="dropdown-item" id="logout-btn">Logout</a></li>
            </ul>
          </div>
    </div>

    <!-- Functional script -->
    <!-- This script is specially defined to prevent js conflict with side-navbar.html -->
    <script>
        const burgerbtn = document.getElementById("burger-btn");

        burgerbtn.addEventListener("click", function (e) {
            let collapseElement = e.target.getAttribute('value');
            let collapseItem = document.getElementById(collapseElement);
            if (collapseItem.classList.contains("show")) {
                collapseItem.classList.remove("show"); // Hide
                collapseItem.style.display = "none";
            } else {
                collapseItem.classList.add("show"); // Show
                collapseItem.style.display = "flex"; // Enable the justify-content-center
            }
        });

        $(document).ready(function () {
            $(document).on("click", "#logout-btn", function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../include/logout.php",
                    data: {
                        logout: true
                    },
                    success: function (response) {
                        if (response == "success") {
                            window.location.replace('../authentication/login.html');
                        }
                    }
                });
            });
        });
    </script>
    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>