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

        #content-container {
            border-radius: 15px;
            overflow: hidden;
        }

        #container-left {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #container-right {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #img-holder {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background-image: url('../media/scpg-building.png');
            background-size: cover;
            background-position: center;
            overflow: hidden;
            z-index: 1;
        }

        #form-holder {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #show-pass-btn {
            float: right;
            position: relative;
            right: 10px;
            margin-top: -35px;
            z-index: 5;
        }
    </style>
</head>

<body>
    <div class="container-fluid position-absolute h-100 p-0" id="main-container">
        <div class="row bg-transparent h-75 w-100 m-0" id="secondary-container">
            <div class="col-md-12 col-lg-10 col-xl-8 bg-white shadow-lg" id="content-container">
                <div class="row bg-white h-100">
                    <div class="col-6 p-3" id="container-left">
                        <div class="row h-100 w-100" id="img-holder">
                            <img src="../media/scpg-logo-transparent.png" alt="SEGi College Penang" id="logo">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 bg-transparent p-3" id="container-right">
                        <div class="row h-100 w-100" id="form-holder">
                            <div class="container h-75 w-75">
                                <p class="display-5 text-center fw-normal">Sign In</p>
                                <div class="container w-100 h-75 mt-5 pt-2">
                                    <form class="needs-validation" action="login.php" method="post" autocomplete="off">
                                        <!-- get email address -->
                                        <label for="email" class="form-label">Email address:</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">
                                                <i class="bi bi-envelope-fill"></i>
                                            </span>
                                            <input type="email" class="form-control" placeholder="Email address:" id="email" name="email" required>
                                        </div>
                                        <!-- get password -->
                                        <label for="password" class="form-label">Password:</label>
                                        <div class="input-group mb-1">
                                            <span class="input-group-text">
                                                <i class="bi bi-lock-fill"></i>
                                            </span>
                                            <input type="password" class="form-control" placeholder="Password:" id="password" name="password" required>
                                        </div>
                                        <i class="bi bi-eye-slash-fill" id="show-pass-btn"></i>
                                        <div class="row text-end">
                                            <a href="login.php" class="link-primary">Recovery Password</a>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100 mt-3">Sign In</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        const showpassbtn = document.getElementById("show-pass-btn");
        const password = document.getElementById("password");

        showpassbtn.addEventListener("click", (e) => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            const currentClass = e.target.classList.contains('bi-eye-slash-fill') ? 'bi-eye-slash-fill' : 'bi-eye-fill';
            const newClass = currentClass === 'bi-eye-slash-fill' ? 'bi-eye-fill' : 'bi-eye-slash-fill';

            e.target.classList.remove(currentClass);
            e.target.classList.add(newClass);
        });
    </script>
</body>

</html>