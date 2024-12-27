<?php
session_start();
include("../include/database.php");

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

function send()
{
    $transport = Transport::fromDsn('smtp://localhost');
    $mailer = new Mailer($transport);

    $email = (new Email())
        ->from('hello@example.com')
        ->to('you@example.com')
        ->subject('Time for Symfony Mailer!')
        ->text('Sending emails is fun again!')
        ->html('<p>See Twig integration for better HTML integration!</p>');

    $mailer->send($email);
}

if (isset($_POST["submit"])) {
    $email = $_POST["email"];

    // Email address validation
    if (str_contains($email, "@segi.edu.my")) {
        // Check lecturer table
        $account = "SELECT * FROM lecturer WHERE email = '$email'";
        $lecturer = mysqli_query($connection, $account);
        $lecturerinfo = mysqli_fetch_assoc($lecturer);

        // Check program_leader table
        $account = "SELECT * FROM program_leader WHERE email = '$email'";
        $programleader = mysqli_query($connection, $account);
        $programleaderinfo = mysqli_fetch_assoc($programleader);

        // If is lecturer
        if (mysqli_num_rows($lecturer) > 0) {
            $_SESSION["entity"] = "lecturer";
            $_SESSION["id"] = $lecturerinfo["id"];
            echo "success";  // "success" statement will be returned to forgot-pass.html
        }
        // If is program leader
        else if (mysqli_num_rows($programleader) > 0) {
            $_SESSION["entity"] = "programleader";
            $_SESSION["id"] = $programleaderinfo["id"];
            echo "success";  // "success" statement will be returned to forgot-pass.html
        }
        //If account doesn't existed
        else {
            echo "Account not found.";  // Return error messages to forgot-pass.html
        }
    } else {
        echo "Invalid email address.";  // Return error messages to forgot-pass.html
    }
}
