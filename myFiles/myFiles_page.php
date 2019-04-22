
<?php
session_start();
require_once "../config.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
} 

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

       
  <!--     <div class="collapse navbar-collapse">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item active">
					  <a class="nav-link" href="history.php">History <span class="sr-only">(current)</span></a>
					</li>
					 <li class="nav-item active">
					  <a class="nav-link" href="profile.php">Profile <span class="sr-only">(current)</span></a>
					</li>
				</ul>
    	</div> -->
    	<ul class="nav justify-content-end">
      	<li class="nav-item">
      		<!-- <button onclick="window.location.href='./wallet/save-wallet.php'"type="button" class="btn btn-info">Wallet</button>
 -->

 		 <a href="http://127.0.0.1:12345#userfiles" class="btn btn-info">Upload files</a>
       	 <a href="logout.php" class="btn btn-danger">Sign Out</a>
      	</li>
    	</ul>
  </nav>
  <!-- Nav Bar-->
<div class="heading">
        <h1>My files</h1>
</div> 
<!-- Table -->

 <table class="table table-striped table-hover">
        <thead>
            <tr>
            	<th>File Number</th>
                <th>File Name</th>
                <th>File Hash</th>
                
            </tr>
<?php

$sql = "SELECT * FROM files WHERE username = (:username) ";

    if($stmt = $pdo->prepare($sql)){
  $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
    $param_username = $_SESSION["username"];


    if($stmt->execute())
    {
        if($stmt->rowCount() >= 1)
        {
            $counter = 1;
            $file_name = array();
            $file_hash = array();
            $records = $stmt->fetchAll();
       
            foreach ($records as $record) {
                
           
    			
    			

                echo "<tr>";

                echo "<td>";
                echo $counter;
                echo "</td>";
                echo "<td>";
                echo $record['name']; // It is a file naem
                $file_name[] = $record['name'];
                echo "</td>";

                echo "<td>";
                echo $record['hash'];
                $file_hash[] = $record['hash']; // It is a file hash
                echo "</td>";

                echo "<td>";
                
             
                echo "<form action='share.php' method='post'>";
                echo "<button type='submit' onclick='window.location.href='./share.php'' class='btn btn-primary'>Share</button>";
                echo "</form>";
 				echo "</td>";

               
 				echo "<td>";
 				// echo "<form action='email.php' method='post'>";
            	// echo "<input type='text' placeholder='Enter username/email' name='email' required>";
            	echo "<form action='email.php' method='post'>";
            	 echo "<button onclick='window.location.href='./email.php'' class='btn btn-primary'>Email</button>";
            	echo "</form>";
                echo "</td>";
              


                echo "<td>";
            	echo "<form action='delete.php' method='post'>";
                echo "<button type='submit' onclick='window.location.href='delete.php'' class='btn btn-primary'>Detele</button>";
                echo "</form>";


                
                echo "</td>";
                echo "</tr>";

                if (isset($_POST['submit'])){
                header("Location: 
                  driver_confirmed.php");
                }
                 $_SESSION['counter'] =  $counter;
                 $_SESSION["filename"] = $file_name;
                 $_SESSION["filehash"] = $file_hash;
                 $counter++;
                
            }
        
                
        }
    }
}
?>


        </thead>
  </table>
<!-- Table -->



<hr>
<hr>
<h2>Insert a file</h2>
<form action="addFiles.php" method="post">
  <div class="form-group">
    <input name="fileName" type="fileName" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="File name">
    <input name="fileHash" class="form-control" id="exampleInputPassword1" placeholder="Hash">
  </div>
 
  <button type="submit" class="btn btn-success btn-lg btn-block" >Add a file</button>
</form>
 


<!-- <button type="button" onclick="window.location.href='./passenger/passenger_home.php'" class="btn btn-primary btn-lg btn-block">Passenger</button>
<button type="button" onclick="window.location.href='./driver/driver_home.php'" class="btn btn-secondary btn-lg btn-block">Driver</button> -->
</body>
</html>