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
        #top-navbar {
            min-height: 79px;
            max-height: 79px;
            background-color: transparent;
        }

        #content-container {
            height: calc(100% - 79px);
            overflow: hidden;
        }

        /* The container is not 100% width under full screen width */
        #content-holder {
            width: calc(100% - 256px);
            overflow: auto;
        }

        /* The container will be 100% width when screen width falls under lg */
        @media (max-width: 991px) {
            #content-holder {
                width: 100%;
            }

            #side-navbar {
                min-width: 100%;
                max-width: 100%;
            }
        }

        @media (min-width: 992px) {
            #side-navbar {
                min-width: 256px;
                max-width: 256px;
                background-color: transparent;
                /*background-color: #f8f9fa;*/
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid position-absolute h-100 p-0 m-0" id="main-container">
        <div class="row h-100 m-0 p-0">
            <!-- Top navbar -->
            <div class="row border-bottom border-2 m-0 p-0" id="top-navbar">
                <!-- Content in top-navbar.html will be loaded here -->
            </div>

            <!-- Container for side navbar and content -->
            <div class="row m-0 p-0" id="content-container">
                <!-- Side navabr -->
                <div class="border-end border-2 h-100 m-0 p-0 d-lg-flex justify-content-center collapse" id="side-navbar">
                    <!-- Content in side-navbar.html will be loaded here -->
                </div>
                <div class="container bg-danger h-100 m-0 p-0" id="content-holder"></div>
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
        })
    </script>
    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>