<?php 
    if (!isset($_SESSION['admin_userid'])) {
        header("location: includes/logout.php");
    }
?>