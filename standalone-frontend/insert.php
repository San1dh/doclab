<!DOCTYPE html>
<html>

<head>
	<title>Insert Page page</title>
</head>

<body>
	<center>
		<?php

		// servername => localhost
		// username => root
		// password => empty
		// database name => hsopital
		$conn = mysqli_connect("localhost", "root", "", "hsopital");
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
		
		// Taking all 5 values from the form data(input)
		$first_name = $_REQUEST['first_name'];
		$last_name = $_REQUEST['last_name'];
		$gender = $_REQUEST['gender'];
		$address = $_REQUEST['address'];
		$email = $_REQUEST['email'];
		$health_issue_description = $_REQUEST['health_issue_description'];

		// Performing insert query execution
		// here our table name is college
		$sql = "INSERT INTO patients VALUES ('$first_name',
			'$last_name','$gender','$address','$email','$health_issue_description')";
		
		if(mysqli_query($conn, $sql)){
			echo "<h3>Registered successfully.</h3>";

			echo nl2br("\n$first_name\n $last_name\n "
				. "$gender\n $address\n $email\n $health_issue_description");
		} else{
			echo "ERROR: Hush! Sorry $sql. "
				. mysqli_error($conn);
		}
		
		// Close connection
		mysqli_close($conn);
		?>
	</center>
</body>

</html>
