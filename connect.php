<?php
    $connect = new mysqli("localhost", "root", "", "4tp_1-projektphp");

    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }
