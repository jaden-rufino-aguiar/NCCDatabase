<?php
	if(isset($_POST["btnsubmit"]))
	{
		include "access.php";
		
		$date = $_POST["cyear"]."-".$_POST["cmonth"]."-".$_POST["cdate"];
               		
		$query = "select *from `students` ";
		$result = mysqli_query($con,$query)or die("select error");
		while($rec = mysqli_fetch_array($result))
		{
			$mno = $rec["id"];
			if(isset($_POST[$mno]))
			{
				$query1 = "INSERT INTO  `attendance`(`member_id` ,  `date` ,  `attendance`) VALUES('$mno','$date','0')";
			}
			else
			{
				$query1 = "INSERT INTO  `attendance`(`member_id` ,  `date` ,  `attendance`) VALUES('$mno','$date','1')";
			}
			mysqli_query($con,$query1)or die("insert error".$mno);
			print "<script>";
			print "alert('Parade Attendance marked for ".$date."');";
			print "self.location='att.php';";
			print "</script>";
		}
		
		
			
		
	}
	else
	{
		header("Location:index.php");
	}
?>

<?php include "footer.php"; ?>