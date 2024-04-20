<?php
// profile_functions.php
function getUserProfileData($userId) {

    require '_db_connection.php';
    
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        $stmt->close();
        return $user;
    } else {
        $stmt->close();
        return null;
    }
}
?>