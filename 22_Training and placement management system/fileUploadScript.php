<?php
    $currentDirectory = getcwd();
    $uploadDirectory = "../../HODProfile/Upload/.images/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['pdf']; // These will be the only file extensions allowed 

    $fileName = $_FILES['fileToUpload']['name'];
    $fileSize = $_FILES['fileToUpload']['size'];
    $fileTmpName  = $_FILES['fileToUpload']['tmp_name'];
    $fileType = $_FILES['fileToUpload']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 

    if (isset($_POST['submit'])) {

      if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errors[] = "This file extension is not allowed. Please upload a PDF file";
      }

      if ($fileSize > 4000000) {
        $errors[] = "File exceeds maximum size (4MB)";
      }

      if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
          echo "The file " . basename($fileName) . " has been uploaded";
        } else {
          echo "An error occurred. Please contact the administrator.";
        }
      } else {
        foreach ($errors as $error) {
          echo $error . "These are the errors" . "\n";
        }
      }

    }
?>
<?php
  session_start();
  if($_SESSION["username"]){
    echo "Welcome, ".$_SESSION['username']."!";
  }
   else {
	   header("location: index.php");
}
   
?>
<?php
$connect = mysql_connect("localhost", "root", ""); // Establishing Connection with Server
mysql_select_db("details"); // Selecting Database from Server
if(isset($_POST['submit']))
{ 
$fname = $_POST['Fname'];
$lname = $_POST['Lname'];
$USN = $_POST['USN'];
$sun = $_SESSION["username"];
$phno = $_POST['phone'];
$email = $_POST['Email'];
$date = $_POST['DOB'];
$cursem = $_POST['Cursem'];
$branch = $_POST['Branch'];
$per = $_POST['Percentage'];
$puagg = $_POST['Puagg'];
$beaggregate = $_POST['Beagg'];
$back = $_POST['Backlogs'];
$hisofbk = $_POST['History']; 
$detyear = $_POST['Dety'];
if($USN !=''||$email !='')
{
	if($USN == $sun)
    {
    if($query = mysql_query("INSERT INTO `details`.`basicdetails` ( `FirstName`, `LastName`, `USN`, `Mobile`, `Email`, `DOB`, `Sem`, `Branch`, `SSLC`, `PU/Dip`, `BE`, `Backlogs`, `HofBacklogs`, `DetainYears`, `Approve`) 
          VALUES ('$fname', '$lname', '$USN', '$phno', '$email', '$date', '$cursem', '$branch', '$per', '$puagg', '$beaggregate', '$back', '$hisofbk', '$detyear', '0')"))
    {
				echo "<center>Details has been received successfully...!!</center>";
      }
	  
     
		else echo "FAILED";
}

else{
	  echo "<center>enter your USN only...!!</center>";
}
}
}
?>


<?php
$connect = mysql_connect("localhost", "root", ""); // Establishing Connection with Server
mysql_select_db("details"); // Selecting Database from Server
if(isset($_POST['update']))
{ 
$fname = $_POST['Fname'];
$lname = $_POST['Lname'];
$USN = $_POST['USN'];
$sun = $_SESSION["username"];
$phno = $_POST['phone'];
$email = $_POST['Email'];
$date = $_POST['DOB'];
$cursem = $_POST['Cursem'];
$branch = $_POST['Branch'];
$per = $_POST['Percentage'];
$puagg = $_POST['Puagg'];
$beaggregate = $_POST['Beagg'];
$back = $_POST['Backlogs'];
$hisofbk = $_POST['History']; 
$detyear = $_POST['Dety'];

if($USN !=''||$email !='')
{
	if($USN == $sun)
	{
		
	$sql = mysql_query("SELECT * FROM `details`.`basicdetails` WHERE `USN`='$USN'");
	if(mysql_num_rows($sql) == 1)
	{
  
		if($query = mysql_query("UPDATE `details`.`basicdetails` SET `FirstName`='$fname', `LastName`='$lname', `Mobile`='$phno', `Email`='$email', `DOB`='$date', `Sem`='$cursem', `Branch`= '$branch', `SSLC`='$per', `PU/Dip`='$puagg', `BE`='$beaggregate', `Backlogs`='$back', `HofBacklogs`='$hisofbk', `DetainYears`='$detyear' ,`Approve`='0'
           WHERE `basicdetails`.`USN` = '$USN'"))
               {
				echo "<center>Data Updated successfully...!!</center>";
               }
	  
            else echo "<center>FAILED</center>";
		
	}	
	else echo "<center>NO record found for update</center>";
	}
else
	echo "<center>enter your usn only</center>";
}
}
?>