<?php
require_once "connection.php";
    if (isset($_POST['submit'])) {
        $task = $_POST['task'];
        $date = $_POST['date'];
        
        $query = $dbconnect->query("INSERT INTO `task`(`task`, `date`) VALUES ('$task','$date')");
        if ($query) {
           header("Location: index.php?added=true");
        }
    }
?>