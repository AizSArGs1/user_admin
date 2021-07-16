<?php
require_once "Conn.php";
$conn = Conn::getInstance();


$ids = $_POST['ids'];
$status = $_POST['status'];


try{

    $stmt = $conn->prepare("UPDATE users SET  status=? WHERE id in ($ids)");
    $stmt->execute([
         $status
    ]);

    echo json_encode([
        'success'=> true,
        'msg'=> $stmt->rowCount() . " records UPDATED successfully"
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

