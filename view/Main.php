<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../view/home.php";
?>