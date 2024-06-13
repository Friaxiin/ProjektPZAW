<?php
    $connect = new mysqli("localhost", "root", "", "4tp_1-projektphp");
    error_reporting(1);
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }
