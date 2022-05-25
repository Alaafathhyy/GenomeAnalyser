<?php


$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "biodb";
$conn = new mysqli($servername,$username,$password,$dbname);

$email=$_POST['email'];
$passworduser=$_POST['password'];

$sql="SELECT * FROM `user` WHERE email='$email' ";
$result = $conn->query($sql);



if(!$result||$result->num_rows==0)
{
    header("Location: index.html?error=User doesnot exists");
        exit();
}
else {
    $row = $result->fetch_assoc();
    $ID=$row["userID"];
        if($row["password"]!=$passworduser)
        {
            
            header("Location: index.html?error=User doesnot exists");
            exit();
        }
        header("Location:main.html?ID=".$ID);
        exit();
      
    exit();
}

?>