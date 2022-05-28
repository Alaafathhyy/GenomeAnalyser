
<html>
   <head>
   <link href="styling.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500&display=swap" rel="stylesheet">
    <title>Genome Analyser </title>
   </head>
   <body >
 <div class="all-body">
<?php

include("fastaAction.php");
session_start();

Main();

function Main()
{

   include("db.php");

   if ($conn->connect_error)
      die("Connection failed: " . $conn->connect_error);

   $sequence=null;
      if ($sequence == null&&getSeq()==false)
      $sequence = $_POST["GSeq"];
   else 
    $sequence = getSeq();

   if (isset($_POST['Biological_Functions'])) {
      echo '<h1> all the details of the current sequence </h1>';

      insertToDB($conn);
      getBioFunctions($sequence);
      echo " The Reroced inserted succefuly";
      die;
    
   }  if (isset($_POST['DBStat'])) {
      echo "<h1> all the statistics of the Data Base </h1>";

      DBStatistical($conn);
      die;
   } if (isset($_POST['GetDB'])) {
      echo "<h1> The data base </h1>";

      getDB($conn);
      die;

   }
   
    echo "<script>alert('No Thing selected to change!');
   window.location.href='main.html';
   </script>";
}
function GetMaxContributer($conn)
{
$sql="SELECT name from user right join genome on user.userID=genome.userID order by count(name) asc";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
echo "<br><h4>the most contributor was : " . $row["name"] ." </h4>";


}
function insertToDB($conn)
{
   $GName = $_POST["GName"];
   $sequence = $_POST["GSeq"];
   $GDisc = $_POST["GDes"];
   $Organ = $_POST["Organism"];
   $OrgDes = $_POST["OrgDes"];
   $userID=$_SESSION["userID"];
   $OrgID=null;
   
   $sql="select OrgID from organ where OrgName='$Organ'";
   $result=$conn->query($sql);  
   if($result->num_rows<=0)
   {
      $sql="INSERT INTO organ (OrgDes, OrgName) VALUES ('$OrgDes','$Organ')";
      $conn->query($sql);
   }
  
   $sql="select OrgID from organ where OrgName='$Organ'";
   $result = $conn->query($sql);  
   $row = $result->fetch_assoc();
   $OrgID=$row["OrgID"];

   $sql="INSERT INTO `genome`(GName, GSeq, UserID, OrgID, GDes) VALUES ('$GName','$sequence','$userID','$OrgID','$GDisc')";
   $conn->query($sql);

}
function getUsers($conn)
{
$sql="select name from user ";
$result= $conn->query($sql);
if ($result->num_rows > 0) {
   echo '<h3  style="color:#03e9f4;"> User Names that registerd : </h3>';
   echo '<table  style="border: 1px solid; margin:auto ; text-align:center;">
    <tr>
    <th style="border: 1px solid; padding:6px;">User Name  </th>
    </tr> ';
   while ($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["name"] ."</td></tr>";
   }
   echo "</table>";
}
}

function GroupByUser($conn)
{
   $sql = "select name , count(name) as UserCnt from genome inner join user on user.userID=genome.UserID group by (user.name)";

   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
      echo '<h3 style="color:#03e9f4;"> User Names that registerd : </h3>';
      echo '<table  style="border: 1px solid; margin:auto ; text-align:center;">
       <tr>
       <th style="border: 1px solid; padding:6px;">User Name  </th>
       </tr> ';
      while ($row = $result->fetch_assoc()) {
         echo "<tr><td>" . $row["name"] . "</td><td>" . $row["UserCnt"] . "</td></tr>";
      }
      echo "</table>";
   }
}
function GroupByOrgan($conn)
{

   $sql = "select OrgName , count(OrgName) as OrgCnt from organ inner join genome on organ.OrgID=genome.OrgID group by (OrgName)";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
      echo '<h3 style="color:#03e9f4;"> Organ Names and number of genes of each organ: </h3>';
      echo '<table style="border: 1px solid; margin:auto ; text-align:center;">
      <tr>
      <th style="border: 1px solid; padding:6px;">Organ Name </th>
      <th style="border: 1px solid; padding:6px;">Number of Genes </th>
      </tr> ';
      while ($row = $result->fetch_assoc()) {
         echo "<tr><td>" . $row["OrgName"] . "</td><td>" . $row["OrgCnt"] . "</td></tr>";
      }
      echo "</table>";
   }
}

function DBStatistical($conn)
{
   GroupByUser($conn);
   GroupByOrgan($conn);
   GetUsers($conn);
   GetMaxContributer($conn);
}
function getDB($conn)
{

   $sql = "SELECT *
   FROM genome
   INNER JOIN organ ON genome.OrgID = organ.OrgID
   INNER JOIN user ON user.userID = genome.userID ";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
      echo '<h3 style="color:#03e9f4;"> SQL Select Results: </h3>';
      echo
      ' <table style="border: 1px solid; margin:auto ; text-align:center;">
       <tr>
       <th  style="border: 1px solid; padding:6px;">Gene Name</th>
       <th  style="border: 1px solid; padding:6px;">Gene Sequence</th> 
      <th  style="border: 1px solid; padding:6px;">Genome Discription </th> 
      <th  style="border: 1px solid; padding:6px;">Organ Name </th> 
      <th  style="border: 1px solid; padding:6px;">Sumbited By</th> 
      </tr> ';
      while ($row = $result->fetch_assoc()) {
         echo "<tr><td>" . $row["GName"] . "</td><td>" . $row["GSeq"] . "</td>
         <td>" . $row["GDes"] . "</td>
         <td>" . $row["OrgName"] . "</td>
         <td>" . $row["name"] . "</td>
         </tr>";
      }
      echo "</table>";
   }
}
function printTable($GName, $sequence, $GDisc, $Organ, $OrgDes, $percent, $Temperature, $Reverse, $RNA, $Portein, $Complement, $Reverse_complement)
{
   echo '<table id="t1" style="border: 1px solid; margin:auto ; text-align:center; width:100%;" >
   <h1><u>Sequence info</u></h1>';


   echo '<tr>';
   echo ' <td  style="border: 1px solid; padding:6px;">Sequence Name</td>';
   echo "<td>  $GName</td>";
   echo '</tr>';


   echo '<tr>';
   echo ' <td  style="border: 1px solid; padding:6px;">Sequence</td>';
   echo "<td>  $sequence</td>";
   echo '</tr>';

   echo '<tr>';
   echo ' <td  style="border: 1px solid; padding:6px;">Genome Discription </td>';
   echo "<td> $GDisc</td>";
   echo '</tr>';


   echo '<tr>';
   echo ' <td  style="border: 1px solid; padding:6px;">Organ</td>';
   echo "<td> $Organ</td>";
   echo '</tr>';

   echo '<tr>';
   echo ' <td  style="border: 1px solid; padding:6px;">Organ Discription</td>';
   echo "<td> $OrgDes</td>";
   echo '</tr>';


   echo '<tr>';
   echo ' <td  style="border: 1px solid; padding:6px;">GC percent</td>';
   echo "<td>  $percent</td>";
   echo '</tr>';

   echo '<tr>';
   echo ' <td  style="border: 1px solid; padding:6px;">Reversee</td>';
   echo "<td>  $Reverse</td>";
   echo '</tr>';

   echo '<tr>';
   echo ' <td  style="border: 1px solid; padding:6px;">Complement</td>';
   echo "<td>  $Complement</td>";
   echo '</tr>';

   echo '<tr>';
   echo ' <td  style="border: 1px solid; padding:6px;">Reverse Complement</td>';
   echo "<td>  $Reverse_complement</td>";
   echo '</tr>';

   echo '<tr>';
   echo ' <td  style="border: 1px solid; padding:6px;">Temperature</td>';
   echo "<td> $Temperature</td>";
   echo '</tr>';

   echo '<tr>';
   echo ' <td  style="border: 1px solid; padding:6px;">RNA</td>';
   echo "<td>  $RNA</td>";
   echo '</tr>';

   echo '<tr>';
   echo ' <td  style="border: 1px solid; padding:6px;">Portein</td>';
   echo "<td> $Portein</td>";
   echo "</tr></table>";
}

function getBioFunctions($sequence)
{

   include("bioFunctions.php");
   $Biological_Functions = $_POST['Biological_Functions'];

   $percent = $Temperature = $Reverse = $RNA = $Portein = $Complement = $Reverse_complement = NULL;
   foreach ($Biological_Functions as $BF) {
      if ($BF == 'GC') {
         $percent = GC($sequence);
      }
      if ($BF == 'Reversee') {
         $Reverse = revcomp($sequence, "rev");
      }
      if ($BF == 'Complement') {
         $Complement = revcomp($sequence, "comp");
      }
      if ($BF == 'Reverse_complement') {
         $Reverse_complement = revcomp($sequence, "revcomp");
      }
      if ($BF == 'Temperature') {
         $Temperature = DNAMeltingTemperature($sequence);
      }
      if ($BF == 'RNA') {
         $RNA = Transcribe($sequence);
      }
      if ($BF == 'Portein') {
         $Portein = Translate($sequence);
      }
   }

   $GName = $_POST["GName"];
   $sequence = $_POST["GSeq"];
   $GDisc = $_POST["GDes"];
   $Organ = $_POST["Organism"];
   $OrgDes = $_POST["OrgDes"];
   printTable($GName, $sequence, $GDisc, $Organ, $OrgDes, $percent, $Temperature, $Reverse, $RNA, $Portein, $Complement, $Reverse_complement);
}
?>
</div> 
   </body>
</html>
