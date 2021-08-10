<?php

// configure
$from = 'Contact form <eager.baljeet2021@gmail.com>';
$sendTo = 'eager.baljeet2021@gmail.com';
$subject = 'New message from contact form';
$fields = array('name' => 'Name', 'mobile' => 'Email', 'message' => 'Message'); // array variable name => Text to appear in the email
$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';
$errorMessage = 'There was an error while submitting the form. Please try again later';

// let's do the sending

//if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
    //your site secret key
   // $secret = '6LdqmCAUAAAAANONcPUkgVpTSGGqm60cabVMVaON';
    //get verify response data

   // $c = curl_init('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
   // curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
  //  $verifyResponse = curl_exec($c);

   // $responseData = json_decode($verifyResponse);
   // if($responseData->success):

        try
        {
            $emailText = nl2br("You have new message from Contact Form\n");

            foreach ($_POST as $key => $value) {

                if (isset($fields[$key])) {
                    $emailText .= nl2br("$fields[$key]: $value\n");
                }
            }
            echo $fields;
            $headers = array('Content-Type: text/html; charset="UTF-8";',
                'From: ' . $from,
                'Reply-To: ' . $from,
                'Return-Path: ' . $from,
            );
            
            mail($sendTo, $subject, $emailText, implode("\n", $headers));

            $responseArray = array('type' => 'success', 'message' => $okMessage);
        }
        catch (\Exception $e)
        {
            $responseArray = array('type' => 'danger', 'message' => $errorMessage);
        }

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $encoded = json_encode($responseArray);

            header('Content-Type: application/json');

            echo $encoded;
        }
        else {
            echo $responseArray['message'];
        }

   


