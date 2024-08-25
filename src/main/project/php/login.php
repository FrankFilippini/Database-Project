<?php
    require_once('config.php');

    if ($_GET['page'] === 'signin-client') {
        $templateParams['title'] = 'Sign In - Client';
        $templateParams['css'][] = 'signin.css';
        $templateParams['page'] = 'signin_client.php';
        if(isset($_POST['email'])) {
            if($db->userLogin($_POST['email'], $_POST['pwd'])) {
                link_to('reservation.php');
            }
        }
    } else if($_GET['page'] === 'signup-client') {
        $templateParams['title'] = 'Sign Up - Client';
        $templateParams['css'][] = 'signup.css';
        $templateParams['page'] = 'signup_client.php';
        if (isset($_POST['pwd1'])) {
            if($db->clientRegister($_POST['CF'],$_POST['name'],$_POST['surname'],$_POST['email'],$_POST['phone'],$_POST['pwd1'])) {
                link_to('reservation.php');
            }
        }
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