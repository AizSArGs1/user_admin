<?php
require_once "Conn.php";

$conn = Conn::getInstance();
$id = $_POST['id'];
try {
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $result = $stmt->execute([
        $id
    ]);
    echo json_encode([
        'success'=> true,
        'msg'=> $stmt->rowCount() . " records DELETED successfully"
    ]);
    die;
} catch(PDOException $e) {
    echo json_encode([
        'success'=> false,
        'msg'=> $e->getMessage()
    ]);
    die;
}
