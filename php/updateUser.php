<?php
require_once "./connect.php";

// Function search user has account or has not account

function userFound($id)
{
    global $conn;
    $stmt   =   $conn->prepare("SELECT * FROM users WHERE  _id = '$id' ;");
    $stmt->execute();
    $c   =   $stmt->rowCount();
    if ($c == 0) return "not found";
    return "found";
}
// Function update user 
function updateUser($arrIndex)
{
    global $conn;
    $stmt   =   $conn->prepare("UPDATE `users` SET _f_name = ? , _l_name = ? , _email = ?  WHERE _id = ?");
    $stmt->bindValue(1, $arrIndex[0]);
    $stmt->bindValue(2, $arrIndex[1]);
    $stmt->bindValue(3, $arrIndex[2]);
    $stmt->bindValue(4, $arrIndex[3]);
    $stmt->execute();
    return "update";
}
try {
    $user = userFound($_POST["idUser"]);
    if ($user == "found") {
        echo json_encode(array("mes" => updateUser(array($_POST["firstName"], $_POST["lastName"], $_POST["email"], $_POST["idUser"]))));
    } else {
        echo json_encode(array("mes" => $user));
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
