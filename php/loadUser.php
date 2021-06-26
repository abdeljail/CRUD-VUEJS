<?php

require_once "./connect.php";

// Get all user 
function users(){
    global $conn;
    $stmt   =   $conn->prepare("SELECT * FROM users ;");
    $stmt->execute();
    $c      =   $stmt->rowCount();
    if ($c == 0) return "empty";
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
try {
    $users = users();
    if ($users == "empty") {
        echo json_encode(array("mes" => "null"));
    } else {
        echo json_encode(array("mes" => $users));
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}