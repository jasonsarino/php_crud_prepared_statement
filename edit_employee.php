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
	$stmt = $mysqli->prepare("UPDATE `employees` SET `employee_number`=?, `firstname`=?, `lastname`=?, `position`=? WHERE `id`=?");

	// Bind params
	$stmt->bind_param( "ssssi", $employee_number, $firstname, $lastname, $position, $_GET['id'] );

	// Execute query
	if( $stmt->execute() ) {
		$alert_message = "Employee has been updated.";
	} else {
		$alert_message = "There was an error in saving the employee. Please try again.";
	}

	// Close prepare statement
	$stmt->close();

}

?>
<html>
	<head>
		<title>Edit Employee</title>
	</head>
	<body>
		<table width="50%" cellpadding="2" cellspacing="2" align="center">
			<tr>
				<td align="center"><h2>Edit Employee</h2></td>
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

					<?php 
					// Get employee details
					$stmt = $mysqli->prepare("SELECT `employee_number`, `firstname`, `lastname`, `position` FROM `employees` WHERE `id` = ?");
					$stmt->bind_param("i", $_GET['id']);
					$stmt->execute();
					$stmt->store_result();
					if( $stmt->num_rows == 1 ) {
						$stmt->bind_result($employee_number, $firstname, $lastname, $position);
						$stmt->fetch();
					?>
					<form method="post">
						<table width="60%" cellpadding="5" cellspacing="5" align="center">
						<tr>
							<td style="width:30%">Employee Number:</td>
							<td><input type="text" name="employee_number" style="width:100%;" placeholder="Enter Employee Number" value="<?=$employee_number?>"></td>
						</tr>
						<tr>
							<td style="width:30%">First Name:</td>
							<td><input type="text" name="firstname" style="width:100%;" placeholder="Enter First Name" value="<?=$firstname?>"></td>
						</tr>
						<tr>
							<td style="width:30%">Last Name:</td>
							<td><input type="text" name="lastname" style="width:100%;" placeholder="Enter Last Name" value="<?=$lastname?>"></td>
						</tr>
						<tr>
							<td style="width:30%">Position:</td>
							<td><input type="text" name="position" style="width:100%;" placeholder="Enter Position" value="<?=$position?>"></td>
						</tr>
						<tr>
							<td colspan="2" align="center"><button type="submit" name="btnSubmit">Submit</button></td>
						</tr>
						</table>
					</form>
					<?php } else {
						echo "Invalid employee";
					} ?>
				</td>
			</tr>
		</table>
	</body>
</html>