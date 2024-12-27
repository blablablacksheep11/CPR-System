<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPR System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .number-field{
            width: 18%;
            height: 75px;
        }

        #main-container {
            display: flex;
            align-items: center;
            background-color: #F0F8FF;
            overflow: hidden;
        }

        #secondary-container {
            display: flex;
            justify-content: center;
        }

        #tertiary-container {
            display: flex;
            align-items: center;
        }

        #fourth-container {
            display: flex;
            justify-content: center;
        }

        #content-container {
            width: 420px;
        }

        #main-logo-container {
            display: flex;
            align-items: center;
        }

        #secondary-logo-container {
            display: flex;
            justify-content: center;
        }

        #logo-holder {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border: solid 2px #6c757d;
            border-radius: 15px;
        }

        #hypertext-holder {
            display: flex;
            justify-content: center;
        }

        #resend-hypertext {
            text-decoration: none;
        }

        #back-hypertext {
            text-decoration: none;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid position-absolute h-100 p-0" id="main-container">
        <div class="row h-75 w-100 bg-transparent m-0" id="secondary-container">
            <div class="col-sm-10 col-md-6 p-0 bg-transparent" id="tertiary-container">
                <div class="row w-100 h-75 bg-transparent m-0 p-0" id="fourth-container">
                    <div class="p-0 m-0" id="content-container">
                        <!-- Logo holder -->
                        <div class="row w-100 h-25 bg-transparent p-0 m-0" id="main-logo-container">
                            <div class="row w-100 h-50 bg-transparent p-0 m-0" id="secondary-logo-container">
                                <div class="container p-0 m-0" id="logo-holder">
                                    <i class="bi bi-inbox h2 text-secondary m-0 p-0" id="logo"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Content holder -->
                        <div class="row h-75 w-100 bottom-0 p-0 m-0">
                            <div class="container h-100 w-100 m-0 p-0">
                                <!-- Heading & description -->
                                <p class="display-6 text-center fw-normal m-0 p-0">Enter verification code</p>
                                <p class="fs-6 text-center fw-normal m-0 mt-3 p-0">We send a code to name@segi4u.my.</p>
                                <!-- Form holder -->
                                <div class="container w-100 h-50 px-4 mt-3">
                                    <!-- Form content -->
                                    <form action="forgot-pass.php" method="post">
                                        <div class="container-fluid m-0 p-0 d-flex justify-content-between">
                                            <input type="number" class="form-control text-center fs-2 number-field">
                                            <input type="number" class="form-control text-center fs-2 number-field">
                                            <input type="number" class="form-control text-center fs-2 number-field">
                                            <input type="number" class="form-control text-center fs-2 number-field">
                                        </div>
                                        <button class="btn btn-primary w-100 mt-4" type="submit">Continue</button>
                                    </form>
                                    <!-- Resend hypertext -->
                                    <div class="row w-100 p-0 m-0 bottom-0 mt-3 text-center" id="hypertext-holder">
                                        <div class="col-12 m-0 p-0 d-flex justify-content-center">
                                            <p class="m-0 p-0">Didn't receive the email?&nbsp;</p>
                                            <a class="m-0 p-0" href="login.php" id="resend-hypertext">Click here</a>
                                        </div>
                                    </div>
                                    <!-- Back hypertext -->
                                    <div class="row w-100 p-0 m-0 bottom-0 mt-3 text-center" id="hypertext-holder">
                                        <div class="col-6 m-0 p-0">
                                            <a class="bi bi-arrow-left" href="login.html" id="back-hypertext">&nbsp;Back to Sign In</a>
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
    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>