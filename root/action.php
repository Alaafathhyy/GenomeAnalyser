<?php

$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "biodb";
$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn->connect_error)
{
   die("Connection failed: " . $conn->connect_error);
}
else 
{
	echo "<div align='center'><h1> Bio Database Connected successfully</h1> </div>";
   if (isset($_POST['Insert']))
   {
      //echo "aaa";
     InsertToDB($conn);
   }
   if (isset($_POST['getGenomes']))
   {
     

      getDB($conn);
     
   }
  
  

}
function getDB($conn)
{
  
   $sql="SELECT GSeq,GName FROM genome ";
   $result = $conn->query($sql);

  if ($result->num_rows > 0) 
  {
    echo "<h3> SQL Select Results: </h3>";  
    echo "<table> <tr><th>Gene Name</th><th>Gene Sequence</th></tr> ";
    while($row = $result->fetch_assoc()) 
    {
    echo "<tr><td>".$row["GName"]."</td><td>".$row["GSeq"]."</td></tr>";
    }
    echo "</table>";
} 
}
function InsertToDB($Conn)
{
  

    $GName = $_POST['GName'];
    $GSeq = $_POST['GSeq'];
    $GDisc = $_POST['GDes'];
    $Organ=$_POST['Organism'];
    $OrgDes=$_POST['OrgDes'];
    $UserID=$_POST['userID'];
    echo $UserID;
    $OrgID=NULL;
  

   $sql="SELECT `OrgID` FROM `organ` WHERE OrgName='$Organ' ";
   $result = $Conn->query($sql);
   if ($result->num_rows > 0) 
   {
      $row = $result->fetch_assoc();
   
     $OrgID= $row["OrgID"];
   } 
   
    

}



?>