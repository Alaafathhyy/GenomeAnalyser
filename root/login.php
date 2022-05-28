<?php
session_start();
include("db.php");

$email = $_POST['email'];
$passworduser = $_POST['password'];

$sql = "SELECT * FROM `user` WHERE email='$email' ";
$result = $conn->query($sql);



if (!$result || $result->num_rows == 0) {
    echo "<script>alert('Failed to login!');
    window.location.href='index.html';
    </script>";

    exit();
} else {
    $row = $result->fetch_assoc();
    $ID = $row["userID"];
    $name = $row["name"];
    $_SESSION['userID'] = $ID;
    if ($row["password"] != $passworduser) {

        echo "<script>alert('Failed to login!');
        window.location.href='index.html';
        </script>";
    
        exit();
    }
    

    header("Location:main.html?ID=$ID&name=$name");

    exit();
}
