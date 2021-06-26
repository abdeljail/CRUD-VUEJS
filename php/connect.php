<?php
    $pdo        =   "mysql:host=localhost;dbname=crud_vuejs";
    $user       =   "root";
    $pass       =   "root";
    $options    =   array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    );
    try {
        $conn = new PDO($pdo, $user, $pass, $options);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
