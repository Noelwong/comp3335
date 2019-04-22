<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
require_once "../config.php";
session_start();

 
// Attempt insert query execution
try{
    // Create prepared statement
    // $sql = "INSERT INTO persons (first_name, last_name, email) VALUES (:first_name, :last_name, :email)";

    // INSERT INTO `files`(`id`, `name`, `hash`) VALUES ([value-1],[value-2],[value-3])
    $sql = "INSERT INTO `files`( `username`,`name`, `hash`) VALUES ((:username),(:fileName),(:fileHash))";
    $stmt = $pdo->prepare($sql);
    

    // Bind parameters to statement


    $stmt->bindParam(':username', $_SESSION["username"]);
    $stmt->bindParam(':fileName', $_POST["fileName"]);
    $stmt->bindParam(':fileHash', $_POST["fileHash"]);

    
    // Execute the prepared statement
    $stmt->execute();
    // $_SESSION['requested'] =  true;
    header("Location: myFiles_page.php");

   exit;
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}