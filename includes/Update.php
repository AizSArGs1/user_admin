<?php
require_once "Conn.php";
$conn = Conn::getInstance();
//var_dump($_POST);

$id = $_POST['id'];
$firstname = $_POST['firstName'];
$lastname = $_POST['lastName'];
$role = $_POST['role'];


try{
    array_map(function ($item) {
        if (!isset($_POST[$item]) || empty($_POST[$item])) die();
    }, ['firstName', 'lastName', 'role']);
    $status = isset($_POST['status']) && !empty($_POST['status']) && $_POST['status'] === 'on' ? 1 : 0;
//    $role = isset($_POST['role']) && !empty($_POST['role']) && $_POST['role'] === 'on' ? 1 : 0;
//var_dump($role);
    $stmt = $conn->prepare("UPDATE users SET `firstname`=?, `lastname`=?, status=?, role=? WHERE id=?");
    $querySuccess = $stmt->execute([
         $firstname, $lastname, $status, $role, $id
    ]);

    $updatedUser = [];
    if ($querySuccess){
        $getUser = $conn->prepare("SELECT * FROM users WHERE id=?");
        $getUser->execute([$id]);
        $updatedUser = $getUser->fetch(PDO::FETCH_OBJ);
    }
    echo json_encode([
        'success' => true,
        'msg' => $stmt->rowCount() . " records UPDATED successfully",
        'updatedUser' => $updatedUser
    ]);
    die;
}catch(PDOException $e) {
    echo json_encode([
        'success'=> false,
        'msg'=> $e->getMessage()
    ]);
    die;
}

//$result = $stmt->fetchAll(PDO::FETCH_OBJ);}

