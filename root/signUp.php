<?php
include("db.php");
$name=$_POST["name"];
$password=$_POST["password"];
$email=$_POST["email"];
$phone=$_POST["phone"];

$sql="SELECT `userID`, `name`, `email`, `password` FROM `user` WHERE email='$email'";

$result=$conn->query($sql);
if($result->num_rows > 0)
{
    echo "<script>alert('this email already existed!');
    window.location.href='signUp.html';
    </script>" ;
    exit();

}
$sql="INSERT INTO `user`( `name`, `email`, `password`,phone) VALUES ('$name','$email','$password','$phone')";
$res=$conn->query($sql);
if(!$res)
{
    echo mysqli_error($conn);
    die();
}
else
{
    $sql="SELECT `userID` ,`name` FROM `user` WHERE email='$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $ID=$row["userID"];
    $name=$row["name"];
        
    header("Location:index.html");
    
    exit();
} 
?>