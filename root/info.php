<?php
session_start();

include ("db.php");

$newName=$_POST["name"];
$newPassword=$_POST["password"];
$newEmail=$_POST["email"];
$userID=$_SESSION["userID"];
$oldPass=$_POST["oldpassword"];

if(isset($_POST["delAcc"]))
 {
     $sql="DELETE FROM `user` WHERE userID='$userID'";
     $res=$conn->query($sql);
     if(!$res)
     {
        echo "<script>alert('Failed to delete the account!');
        window.location.href='info.html';
        </script>";
    
     }
     else {
        echo "<script>alert('Account deleted Successfuly!');
        window.location.href='index.html';
        </script>";
     }

 }
$sql="select password from user WHERE userID='$userID' ";
$res=$conn->query($sql);
$row=$res->fetch_assoc();

if($row["password"]!=$oldPass&&$newPassword!='')
{
    echo "<script> alert('please enter the old password correctly');
        window.location.href='info.html';
        </script>";
}
if($newName!="")
{
    $sql="UPDATE `user` SET `name`='$newName' WHERE userID='$userID' ";
    $res=$conn->query($sql);
    if(!$res)
    {
        echo "<script> alert('cant change the name');
        window.location.href='info.html';
        </script>";
    }

}
if($newEmail!="")
{
    $sql="UPDATE `user` SET `email`='$newEmail' WHERE userID='$userID' ";
    $res=$conn->query($sql);
    if(!$res)
    {
        echo "<script> alert('cant change the password');
        window.location.href='info.html';
        </script>";

    }

}
if($newPassword!="")
{
    $sql="UPDATE `user` SET `password`='$newPassword' WHERE userID='$userID' ";
    $res=$conn->query($sql);
    if(!$res)
    {
        echo "<script> alert('cant change the password');
        window.location.href='info.html';
        </script>";

    }

}
if($newPassword!=""||$newEmail!=""||$newName!=""){
    echo "<script> alert('the info updated successfuly !');
    window.location.href='info.html';
    </script>";
}
else if(!isset($_POST["delAcc"]))
{
    echo "<script>alert('Please enter the field that you want to update !');
    window.location.href='info.html';
    </script>";

}
 

?>
