<?php

require_once "Conn.php";

$conn = Conn::getInstance();

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_OBJ);


