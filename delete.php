<?php
    require_once "connection.php";
    if (isset($_GET['dlt'])) {
        $delete = $_GET['dlt'];
        
        $query = $dbconnect->query("DELETE FROM `task` WHERE `id` = '$delete'");
        if ($query) {
           header("Location: index.php?deleted=true");
        }
    }
?>