<?php
require '../php-mailer-master/PHPMailerAutoload.php';
session_start();

if(isset($_POST['SubmitButton'])){ //check if form was submitted
  $email = $_POST['email']; //get input text
  // $message = "Success! You entered: ".$input;
  $fileNumber = $_POST['fileNumber'] - 1 ;

  $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'comp3335.database@gmail.com';                 // SMTP username
$mail->Password = 'Securityisgood';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('comp3335.database@gmail.com', 'Comp33335-DatabaseSecurityProject');
$mail->addAddress($email, $_SESSION['username']);     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Sharing files with you';
$mail->Body    = 'There is a link that you can download it: https://ipfs.io/ipfs/'.$_SESSION['filehash'][$fileNumber];


if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
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
      	

 		 <a href="http://127.0.0.1:12345#userfiles" class="btn btn-info">Add files</a>
       	 <a href="logout.php" class="btn btn-danger">Sign Out</a>
      	</li>
    	</ul>
  </nav>
  <!-- Nav Bar-->







<form action="" method="post">
  <div class="form-group">
  	  <input name="fileNumber" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter file number">
    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
     
  </div>
 
  <button type="submit" name="SubmitButton" class="btn btn-success btn-lg btn-block" >Submit</button>
</form>
 


<!-- <button type="button" onclick="window.location.href='./passenger/passenger_home.php'" class="btn btn-primary btn-lg btn-block">Passenger</button>
<button type="button" onclick="window.location.href='./driver/driver_home.php'" class="btn btn-secondary btn-lg btn-block">Driver</button> -->
</body>
</html>