<?php
require_once "./connect.php";

// Function search user has account or has not account

function userFound($id)
{
    global $conn;
    $stmt   =   $conn->prepare("SELECT * FROM users WHERE  _id = '$id' ;");
    $stmt->execute();
    $c      =   $stmt->rowCount();
    if ($c == 0) return "not found";
    return "found";
}
// Function delete user 
function deleteUser($id)
{
    global $conn;
    $stmt   =   $conn->prepare("DELETE FROM `users` WHERE _id = ? ");
    $stmt->bindValue(1, $id);
    $stmt->execute();
    return "delete";
}
try {
    $user = userFound($_POST["idUser"]);
    if ($user == "found") {
    echo json_encode(array("mes" => deleteUser($_POST["idUser"])));
    } else {
        echo json_encode(array("mes" => $user));
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
