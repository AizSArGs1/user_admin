<?php
require_once "Conn.php";

$conn=Conn::getInstance();

/*echo var_dump($conn);*/

try {
    array_map(function ($item) {
        if (!isset($_POST[$item]) || empty($_POST[$item])) die();
    }, ['firstName', 'lastName']);
    $status = isset($_POST['status']) && !empty($_POST['status']) && $_POST['status'] === 'on' ? 1 : 0;
    // language=MySQL;
    $stmt = $conn->prepare("INSERT INTO `users`(`id`, `firstname`, `lastname`, `role`, `status`) VALUES (default,'{$_POST['firstName']}','{$_POST['lastName']}','default','$status')");
    $stmt->execute();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
