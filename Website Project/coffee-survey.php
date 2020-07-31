<?php
$name = $_POST['name'];
$email = $_POST['email'];
$preparation = $_POST['preparation'];
$grind = $_POST['grind'];
$drink = $_POST['drink'];
$favorite = $_POST['favorite'];


if (!empty($name) || !empty($email)) {
	$host ="localhost";
	$dbUsername = "root";
	$dbpassword = "";
	$dbname = "survey";
	
	// Create connection
    $conn = new mysqli($host,$dbUsername,$dbpassword,$dbname);
	
	if (mysqli_connect_error())  {
		die('Connect Error('.mysqli_connect_errno().')'. mysqli_connect_error());
		
	} else {
		$SELECT = "SELECT email FROM coffee Where email = ? Limit 1";
		$INSERT = "INSERT INTO coffee (name , email , preparation , grind , drink ,favorite) values('$name','$email' ,'$preparation' ,'$grind','$drink','$favorite')";
        $stmt = $conn->prepare($SELECT);
		$stmt->bind_param("s",$email);
		$stmt->execute();
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		
		if ($rnum==0) {
			$stmt->close();
			
			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("issssss",$id,$name ,$email, $preparation ,$grind ,$drink ,$favroite );
			$stmt->execute();
			echo "New record inserted successfully";
			
			
		}  else {
			echo "someone already registered using this email";
			
			
		}
		$stmt->close();
		$conn->close();
		
	  }
		
		
		
	
	
} else {
	echo " Required Fields Are Not Filled ";
	die();
}

?>