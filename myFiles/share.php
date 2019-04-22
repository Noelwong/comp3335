<?php
require '../php-mailer-master/PHPMailerAutoload.php';
require_once "../config.php";
session_start();

if(isset($_POST['SubmitButton'])){ //check if form was submitted
  $otherUsername = $_POST['otherUsername']; //get input text
  $fileNumber = $_POST['fileNumber'] - 1 ;
  
  $counter = $_SESSION['counter'];
  try{
 

 
    $sql = "INSERT INTO `sharedFiles`( `owner_username`,`shared_username`, `file_name`,`file_hash`) VALUES ((:username),(:otherUsername),(:fileName),(:fileHash))";

    $stmt = $pdo->prepare($sql);
  
    // Bind parameters to statement


    $stmt->bindParam(':username', $_SESSION["username"]);
    $stmt->bindParam(':otherUsername', $otherUsername);
    $stmt->bindParam(':fileName',  $_SESSION['filename'][$fileNumber]);
    $stmt->bindParam(':fileHash',  $_SESSION['filehash'][$fileNumber]);

    
    // Execute the prepared statement
    $stmt->execute();
    // $_SESSION['requested'] =  true;
    header("Location: myFiles_page.php");

   exit;
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}

}  



// emmail
//========================================

?>

<!DOCTYPE html>
<html>
<head>
	<title>My files</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<style type="text/css">
	  body{ font: 14px sans-serif; }
	  .wrapper{ width: 350px; padding: 20px; }
	  .heading { padding: 20px; }
	  .btn_home:link { color: white; text-decoration: none; font-weight: normal }
	  .btn_home:visited { color: white; text-decoration: none; font-weight: normal }
	  .btn_home:active { color: white; text-decoration: none }
	  .btn_home:hover { color: white; text-decoration: none; font-weight: none }
	</style>
</head>
<body>
  <!--Nav Bar -->

  <nav class="navbar navbar-dark bg-dark sticky-top" >
      <div class="navbar-brand" >
        <a href="home.php" class="btn_home">
          <img src="photo/polyu.png" width="30" height="30" class="d-inline-block align-top" alt="">
      COMP3335 - Database Security 
        </a>
      </div>

       
 
    	</div> -->
    	<ul class="nav justify-content-end">
      	<li class="nav-item">
      	

 		 <a href="http://127.0.0.1:12345#userfiles" class="btn btn-info">Upload files</a>
       	 <a href="logout.php" class="btn btn-danger">Sign Out</a>
      	</li>
    	</ul>
  </nav>
  <!-- Nav Bar-->







<form action="" method="post">
  <div class="form-group">

     <input name="fileNumber" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter file number">

    <input name="otherUsername" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username">
    
  </div>
 
  <button type="submit" name="SubmitButton" class="btn btn-success btn-lg btn-block" >Submit</button>
</form>
 


<!-- <button type="button" onclick="window.location.href='./passenger/passenger_home.php'" class="btn btn-primary btn-lg btn-block">Passenger</button>
<button type="button" onclick="window.location.href='./driver/driver_home.php'" class="btn btn-secondary btn-lg btn-block">Driver</button> -->
</body>
</html>