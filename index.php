<?php 
require 'connect.php';
?>
<html>
	<head>
		<title>Employee List</title>
	</head>
	<body>
		<table width="50%" cellpadding="2" cellspacing="2" align="center">
			<tr>
				<td align="center"><h2>Employee List</h2></td>
			</tr>
			<tr>
				<td><a href="add_employee.php">Add New Employee</a></td>
			</tr>
			<tr>
				<td>
					<table width="100%" border="1" cellpadding="2" cellspacing="3">
						<thead>
							<tr>	
								<th>Employee Number</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Position</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$stmt = $mysqli->prepare("SELECT `id`, `employee_number`, `firstname`, `lastname`, `position` FROM `employees` ORDER BY `employee_number` ASC");
							$stmt->execute();
							$stmt->store_result();
							if( $stmt->num_rows > 0 ) {
								$stmt->bind_result($id, $employee_number, $firstname, $lastname, $position);
								while( $stmt->fetch() ) {
							?>
							<tr>
								<td><?=$employee_number?></td>
								<td><?=$firstname?></td>
								<td><?=$lastname?></td>
								<td><?=$position?></td>
								<td align="center">
									<a href="edit_employee.php?id=<?=$id?>">Edit</a> |
									<a href="delete_employee.php?id=<?=$id?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a> 
								</td>
							</tr>
							<?php } } else {?>
							<tr>
								<td colspan="5" align="center">No student found.</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>