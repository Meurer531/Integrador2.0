<?php
    session_start();
    //session_name('Login');
    session_destroy();
    header("location: ../../../index.php");
?>
