<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: home/dashboard.php");
} else {
    // Si no está logueado, va al login
    header("Location: auth/login.php");
}
exit();

?>