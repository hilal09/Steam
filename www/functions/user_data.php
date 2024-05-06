<?php
require 'db_connection.php';

$sql = "SELECT * FROM user_accounts WHERE id = 1";
//$stmt = $conn->prepare($sql);
//$stmt->bind_param("d", 1);
// $stmt->execute();
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $user_ID = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $avatar = $row['avatar'];
        //echo $user_ID." ". $name." ". $email." ". $avatar." ";
    }
}

function getUserID (){
    echo $user_ID;
}

function getUserName (){
    echo $name;
}

function getUserEmail (){
    echo $email;
}

function getUserAvatar (){
    echo $avatar;
}

?>