<?php
    require_once('config.php');

    if ($_GET['page'] === 'signin-client') {
        $templateParams['title'] = 'Sign In - Client';
        $templateParams['css'][] = 'signin.css';
        $templateParams['page'] = 'signin_client.php';
        if(isset($_POST['email'])) {
            $templateParams['email'] = $_POST['email'];
            if($db->clientLogin($_POST['email'], $_POST['pwd'])) {
                $templateParams['clientId'] = $db->getClientId($templateParams['email']);
                session_start();
                $_SESSION['clientId'] = $templateParams['clientId'];
                echo $_SESSION['clientId'];
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
        if(isset($_POST['email'])) {
            if(str_contains($_POST['email'], "admin")) {
                link_to('best_rated_members.php');
            }
            $templateParams['email'] = $_POST['email'];
            if($db->staffLogin($_POST['email'], $_POST['pwd'])) {
                $templateParams['staffId'] = $db->getStaffId($templateParams['email']);
                session_start();
                $_SESSION['staffId'] = $templateParams['staffId'];
                echo $templateParams['staffId'];
                link_to('list_reservations.php');
            }
        }
    }  else if($_GET['page'] === 'signup-staff') {
        $templateParams['title'] = 'Sign Up - Staff';
        $templateParams['css'][] = 'signup.css';
        $templateParams['page'] = 'signup_staff.php';
        if (isset($_POST['pwd1'])) {
            if($db->staffRegister($_POST['CF'], $_POST['name'], $_POST['surname'], $_POST['email'], $_POST['pwd1'])) {
                link_to('list_reservations.php');
            }
        }
    } 

    require('templates/base.php');
?>