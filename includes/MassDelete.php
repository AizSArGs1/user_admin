<?php

require_once "Conn.php";

$conn = Conn::getInstance();
$ids = $_POST['ids'];

if ($ids){
    try {
        $stmt = $conn->prepare("DELETE FROM users WHERE id in ($ids)");
        $result = $stmt->execute();
        echo json_encode([
            'success' => true,
            'msg' => $stmt->rowCount() . " records DELETED successfully"
        ]);
        die;
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'msg' => $e->getMessage()
        ]);
        die;
    }
} else {
    echo json_encode([
        'success' => false,
        'msg' => 'no data found'
    ]);
    die;
}