<?php
require_once "./connect.php";

// Function search user has account or has not account
function userFound($email){
    global $conn;
    $stmt   =   $conn->prepare("SELECT * FROM users WHERE  _email = '$email' ;");
    $stmt->execute();
    $c      =   $stmt->rowCount();
    if ($c == 0) return "not found";
    return "found";
}
// Function add user 
function addUser($arrIndex){
    global $conn;
    $stmt   =   $conn->prepare("INSERT INTO users(_f_name,_l_name,_email) VALUES(?,?,?)");
    $stmt->bindValue(1, $arrIndex[0]);
    $stmt->bindValue(2, $arrIndex[1]);
    $stmt->bindValue(3, $arrIndex[2]);
    $stmt->execute();
    return "add";
}
try{
    $user = userFound($_POST["email"]);
    if($user == "not found"){
        echo json_encode(array("mes" => addUser(array($_POST["firstName"], $_POST["lastName"], $_POST["email"]))));
    }else{
        echo json_encode(array("mes" => $user));
    }
    
} catch (PDOException $e) {
    echo $e->getMessage();
}