<?php
    session_start();
    $_SESSION['user'] = $_POST['ID'];
    $_SESSION['rank'] = $_POST['RANK'];
?>