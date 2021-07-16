<?php
require_once "Conn.php";

$conn=Conn::getInstance();
$firstname = $_POST['firstName'];
$lastname = $_POST['lastName'];
$role = $_POST['role'];

try {
    array_map(function ($item) {
        if (!isset($_POST[$item]) || empty($_POST[$item])) die();
    }, ['firstName', 'lastName', 'role']);
    $status = isset($_POST['status']) && !empty($_POST['status']) && $_POST['status'] === 'on' ? 1 : 0;
    // language=MySQL;
    $stmt = $conn->prepare("INSERT INTO `users`(`firstname`, `lastname`, `role`, `status`) VALUES (?, ?,'$role','$status')");
    $stmt->execute([
        $firstname, $lastname
    ]);
//    var_dump($stmt);
    echo json_encode([
        'success'=> (bool)$stmt
    ]);
} catch(PDOException $e) {
    echo json_encode([
            'success'=> false,
            'msg'=> $e->getMessage()
        ]);
}

?>
