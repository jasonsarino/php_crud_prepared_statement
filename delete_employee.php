<?php 

require 'connect.php';

// Prepare statement 
$stmt = $mysqli->prepare("DELETE FROM `employees` WHERE `id`=?");

// bind param
$stmt->bind_param("i", $_GET['id']);

if( $stmt->execute() ) {
	echo "Employee has been deleted. <a href='index.php'>Back to Employee List</a>";
}  else {
	echo "There was an error in deleting the employee. Please try again.";
}

// clsoe prepare statement
$stmt->close();

// close connection
$mysqli->close();