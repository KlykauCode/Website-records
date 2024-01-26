<?php
    include "mysql.php";
    Connection();
    
    if(isset($_POST["username"])){
        if(CheckUser($_POST["username"])){
            echo "exists";
        } else {
            echo "not exists";
        }
    }
?>