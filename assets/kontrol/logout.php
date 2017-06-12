<?php
include_once('../connt.php');
session_start();

unset($_SESSION['id_user']);

header('Location: ../');

?>