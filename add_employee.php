<?php
require 'connect.php';

// Form click or submit
if( isset($_POST['btnSubmit']) ) {

	// Fetch input $_POST
	$employee_number = $mysqli->real_escape_string( $_POST['employee_number'] );
	$firstname = $mysqli->real_escape_string( $_POST['firstname'] );
	$lastname = $mysqli->real_escape_string( $_POST['lastname'] );
	$position = $mysqli->real_escape_string( $_POST['position'] );

	// Prepared statement
	$stmt = $mysqli->prepare("INSERT INTO `employees` (`employee_number`, `firstname`, `lastname`, `position`) VALUES(?, ?, ?, ?)");

	// Bind params
	$stmt->bind_param( "ssss", $employee_number, $firstname, $lastname, $position );

	// Execute query
	if( $stmt->execute() ) {
		$alert_message = "Employee has been saved.";
	} else {
		$alert_message = "There was an error in saving the employee. Please try again.";
	}

	// Close prepare statement
	$stmt->close();

	// Close database connection
	$mysqli->close();

}


?>
<html>
	<head>
		<title>Add New Employee</title>
	</head>
	<body>
		<table width="50%" cellpadding="2" cellspacing="2" align="center">
			<tr>
				<td align="center"><h2>Add New Employee</h2></td>
			</tr>
			<tr>
				<td align="center"><a href="index.php">Back to employee list</a></td>
			</tr>
			<tr>
				<td>
					<?php 
					if( isset( $alert_message ) AND !empty( $alert_message )) {
						echo "<center>".$alert_message."</center>";
					}
					?>
					<form method="post">
						<table width="60%" cellpadding="5" cellspacing="5" align="center">
						<tr>
							<td style="width:30%">Employee Number:</td>
							<td><input type="text" name="employee_number" style="width:100%;" placeholder="Enter Employee Number"></td>
						</tr>
						<tr>
							<td style="width:30%">First Name:</td>
							<td><input type="text" name="firstname" style="width:100%;" placeholder="Enter First Name"></td>
						</tr>
						<tr>
							<td style="width:30%">Last Name:</td>
							<td><input type="text" name="lastname" style="width:100%;" placeholder="Enter Last Name"></td>
						</tr>
						<tr>
							<td style="width:30%">Position:</td>
							<td><input type="text" name="position" style="width:100%;" placeholder="Enter Position"></td>
						</tr>
						<tr>
							<td colspan="2" align="center"><button type="submit" name="btnSubmit">Submit</button></td>
						</tr>
						</table>
					</form>
				</td>
			</tr>
		</table>
	</body>
</html>