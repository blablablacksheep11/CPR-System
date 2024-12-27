<?php

//database connection
try {
    $connection = mysqli_connect('localhost', 'root', '', 'cpr-system');
} catch (mysqli_sql_exception) {
    echo "We're currently performing maintenance on our database. Please check back shortly for updates. Thank you for your patience!";
}
