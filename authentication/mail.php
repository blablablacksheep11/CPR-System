<?php
session_start();

// Generate 4 digits verification code
$code = rand(1000, 9999);
$_SESSION["code"] = $code;

require_once '../vendor/autoload.php';

// Import Symfony mailer
use Symfony\Component\Mailer\Exception\ExceptionInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

$transport = Transport::fromDsn('smtp://lamyongqin@gmail.com:idtzrezxwuvenggm@smtp.gmail.com:587');
$mailer = new Mailer($transport);

$email = (new Email())
    ->from('lamyongqin@gmail.com')
    ->to('lamyongqin@gmail.com')
    ->subject('Verification code for password reset')
    ->text('This is your verificatio code')
    ->html('<p>Only one step left to reset your password. Please use this verification code:</p><br> <b>'.$code.'<b>');

$mailer->send($email);
