<?php
include '../../server.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    $stmt = $conn->prepare("DELETE FROM `approve_user` WHERE `user_id` = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

} else {
    echo "invalid_request";
}
?>