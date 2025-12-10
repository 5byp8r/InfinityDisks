<?php
require_once "view/home.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>