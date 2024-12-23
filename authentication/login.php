<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPR System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        #main-container {
            display: flex;
            align-items: center;
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

        #img-holder {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background-image: url('../media/segi-building.jpg');
            background-size: cover;
            background-position: center;
            opacity: 0.5;
        }
    </style>
</head>

<body>
    <div class="container-fluid bg-light position-absolute h-100 p-0" id="main-container">
        <div class="row bg-transparent h-75 w-100 m-0" id="secondary-container">
            <div class="col-md-12 col-lg-10 col-xl-8 bg-white shadow-lg" id="content-container">
                <div class="row bg-white h-100">
                    <div class="col-6 p-3" id="container-left">
                        <div class="row h-100 w-100 bg-primary" id="img-holder"></div>
                    </div>
                    <div class="col-6 bg-light" id="container-right">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>