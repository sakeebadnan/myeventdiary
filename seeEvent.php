<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <title>Document</title>
</head>
<?php
	include_once("auth.php");
	require('src/data.php');
	$db = new data;  
	$returnValue=$db->CityList($_SESSION['Id']);
	
        
?>



	<div class="content">
		<div class='inner-menu registrtionform'>
			<h1>See Your Event </h1>

			<form method="post" class="seeEvent">						
				<span class="formelementc">
					<label>Select Category</label>
				</span>
					<span class="formelementc">
					<select class='formelement' name="Category" required>
						<option value="not">--Select--</option>
						<option value="sports">Sports</option>
						<option value="music">Music</option>
						<option value="food">Food</option>
						<option value="all">Rest</option>
						
					</select>
</span>
<span class="formelementc">
					<label >Choose a City:</label>
					</span>
					<span class="formelementc">
					<select class='formelement' name="City" required>
						<option value="all">All</option>
<?php
						for($x = 0; $x < count($returnValue); $x++)
							echo "<option value='".$returnValue[$x]."'>".$returnValue[$x]."</option>";
						
?>						
					</select>
					</span>

					<span class="formelementc">
						<input class='formelement' type="submit" name="submit" value="Submit">	
						</span>
					</form>
		</div>
		<div class='clearboth'>&nbsp;
	</div>
		<div class='see-event-table'>
<?php

if(isset($_POST['delete'])){
	$count=0;
	
	for($x = 1; $x <=$_SESSION['y']; $x++){
		if(isset($_POST[$x])){
			$delRet=$db->delEvent($_POST[$x],$_SESSION['Id']);
			if($delRet==true){
				$count++;
			}
		}		
	}if($count==$_SESSION['y']){
		unset($_POST);
		echo "<script> alert('Delete Successful.');</script>" ;
		header("Location: index.php");
	}else {
		echo "<script> alert('Somthing went wrong.');</script>" ;
		header("Location: index.php");
		unset($_POST['delete']);
	}
}	
				$colorIndex=0;
				$alterNativeColor='even';
if(isset($_POST['submit'])){
	if(($_POST["Category"]=='not')){
		echo '<script>alert("You need to Select a Category")</script>';
	}else{
		$events=$db->seeEvents($_POST["Category"],$_SESSION['Id']);
		$y=0;
		     
		foreach($events as $row){
			if($_POST['City']!='all'){
				if($_POST['City']==$row->CityName){
					$y++;
					$colorIndex++;
					if($colorIndex%2==0){
						$alterNativeColor='odd';
					}else{
						$alterNativeColor='even';
					}
					$db->tableSeeEvent($row,$colorIndex,$alterNativeColor,$y);
				}
			}
			else{
				$y++;
				$colorIndex++;
				if($colorIndex%2==0){
					$alterNativeColor='odd';
				}else{
					$alterNativeColor='even';
				}
				$db->tableSeeEvent($row,$colorIndex,$alterNativeColor,$y);
			}
		}
		if($y==0) echo "<h3>No Event Found in databse.<h3>";
		else {$_SESSION['y']=$y;
			echo '</table>';
			echo '<div class="registrtionform"><span class="formelementc"><input class="formelement formundelete" type="submit" name="delete" value="Delete"></span></div>';	
			echo "</form>";
		}
	}
	unset($_POST);		
}
?>

		</div>
<?php
					include('footer.php');
?>	
	</body>
</html>