<?php
   $connect = mysql_connect("localhost", "root", ""); // Establishing Connection with Server
   mysql_select_db("details") or die("Cant Connect to database"); // Selecting Database from Server
   
   
if(isset($_POST['submit']))
{ 
  
 $Name = $_POST['Fullname'];
 $Username = $_POST['Username'];
 $password = $_POST['Password'];
 $repassword = $_POST['repassword'];
 $Email = $_POST['Email'];
  $Question = $_POST['Question'];
   $Answer = $_POST['Answer'];
   $Branch = $_POST['Branch'];
  

 $check = mysql_query("SELECT * FROM hlogin WHERE Username='".$Username."'") or die("Check Query");
 if(mysql_num_rows($check) == 0) 
 {
  if($repassword == $password)
  {
    
    
    if($query = mysql_query("INSERT INTO hlogin(Name, Username ,Password,Email,Question,Answer,Branch) VALUES ('$Name', '$Username', '$password','$Email','$Question', '$Answer','$Branch')"))
    {
                       echo "<center> You have registered successfully...!! Go back to  </center>";
					             echo "<center><a href='index.php'>Login here</a> </center>";
					   
    }
  }
   else
    {
       echo "<center>Your password do not match</center>";
    }
   }
   else
   {
       echo "<center>This USN already exists</center>"; 
  }
}
?>