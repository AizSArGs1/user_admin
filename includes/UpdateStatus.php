<?php
require_once "Conn.php";
$conn = Conn::getInstance();


$ids = $_POST['ids'];
$status = $_POST['status'];


try{

    $stmt = $conn->prepare("UPDATE users SET  status=? WHERE id in ($ids)");
    $querySuccess = $stmt->execute([
         $status
    ]);

    $updatedStatus = [];
    if ($querySuccess){
        $getUser = $conn->prepare("SELECT * FROM users WHERE id in ($ids)");
        $getUser->execute();
        $updatedStatus = $getUser->fetchAll(PDO::FETCH_OBJ);
    }

    echo json_encode([
        'success' => $querySuccess,
        'updatedUsers' => $updatedStatus,
        'msg' => $stmt->rowCount() . " records UPDATED successfully"
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

