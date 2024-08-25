<?php
    require_once('config.php');

    if (isset($_POST['email'])) {
        link_to('reservation.php');
    }
    if ($_GET['page'] === 'signin-client') {
        $templateParams['title'] = 'Sign In - Client';
        $templateParams['css'][] = 'signin.css';
        $templateParams['page'] = 'signin_client.php';
    } else if($_GET['page'] === 'signup-client') {
        $templateParams['title'] = 'Sign Up - Client';
        $templateParams['css'][] = 'signup.css';
        $templateParams['page'] = 'signup_client.php';
    }  else if($_GET['page'] === 'signin-staff') {
        $templateParams['title'] = 'Sign In - Staff';
        $templateParams['css'][] = 'signin.css';
        $templateParams['page'] = 'signin_staff.php';
    }  else if($_GET['page'] === 'signup-staff') {
        $templateParams['title'] = 'Sign Up - Staff';
        $templateParams['css'][] = 'signup.css';
        $templateParams['page'] = 'signup_staff.php';
    } 

    require('templates/base.php');
?>