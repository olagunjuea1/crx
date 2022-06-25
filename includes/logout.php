<?php
    session_start();
    session_destroy();
    header("Location:../auth/R4/login.php");
?>