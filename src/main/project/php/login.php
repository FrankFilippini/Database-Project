<?php
    require_once('config.php');
    if (!isset($_GET['page'])
    || count($_GET) != 1
    || ($_GET['page'] !== 'signin' && $_GET['page'] !== 'signup')) {
        header('Location: '.DIR_BASE.'');
    }
    if ($_GET['page'] === 'signin') {
        $templateParams['title'] = 'Sign In';
        $templateParams['css'][] = 'signin.css';
        $templateParams['page'] = 'signin.php';
    } else /* if ($_GET['page'] === 'signup') */ {
        $templateParams['title'] = 'Sign Up';
        $templateParams['css'][] = 'signup.css';
        $templateParams['page'] = 'signup.php';
    }

    require('templates/base.php');
?>