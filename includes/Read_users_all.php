<?php

require_once "Conn.php";

$conn = Conn::getInstance();

try {
    $stmt = $conn->prepare("SELECT * FROM users");

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

    echo json_encode([
        'success'=> (bool)$stmt,
        'result'=> $result
    ]);

} catch(PDOException $e) {
    echo json_encode([
        'success'=> false,
        'msg'=> $e->getMessage()
    ]);
}


