<?php
    require_once('config.php');
    if (!isset($_GET['page'])
    || count($_GET) != 1
    || ($_GET['page'] !== 'signin' && $_GET['page'] !== 'signup')) {
       
    }

    if (isset($_POST['email'])) {
        link_to('reservation.php');
    }
    if ($_GET['page'] === 'signin') {
        $templateParams['title'] = 'Sign In';
        $templateParams['css'][] = 'signin.css';
        $templateParams['page'] = 'signin_client.php';
    } else /* if ($_GET['page'] === 'signup') */ {
        $templateParams['title'] = 'Sign Up';
        $templateParams['css'][] = 'signup.css';
        $templateParams['page'] = 'signup_client.php';
    }

    require('templates/base.php');
?>