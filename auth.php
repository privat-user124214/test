<?php
session_start();
function check_login() {
    if (!isset($_SESSION['user'])) {
        header("Location: /login.php");
        exit;
    }
}
 
