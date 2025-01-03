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
            min-height: 80px;
            max-height: 80px;
            background-color: transparent;
        }

        #side-navbar {
            min-width: 256px;
            max-width: 256px;
            background-color: transparent;
            /*background-color: #f8f9fa;*/
        }

        #content-container {
            height: 90vh;
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
                <div class="border-end border-2 m-0 p-0 d-none d-lg-flex justify-content-center" id="side-navbar">
                    <!-- Content in side-navbar.html will be loaded here -->
                </div>
                <div class="container" id="content-holder"></div>
            </div>
        </div>
    </div>
    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Functional script -->
    <script>
        $(document).ready(function() {
            // Load top navbar content
            $('#top-navbar').load('../template/ttop-navbar.html');
            // Load side navbar content
            $('#side-navbar').load('../template/tside-navbar.html');
        })
    </script>
</body>

</html>