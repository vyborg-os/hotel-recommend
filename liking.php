<?php
require 'mysql_connect.php';
 
if(isset($_POST['likethis'])){
    require 'mysql_connect.php';
    $hotel_id = $_POST['hotelid'];
    $user_id = $_POST['userid'];
    $sql = "SELECT * FROM likes WHERE hotel_id = '$hotel_id' AND user_id = '$user_id'";
	$result = $conn->query($sql);
	$r = $result->num_rows;
		if($r > 0){
			echo 'Cannot like this hotel twice';
		}else{
            require 'mysql_connect.php';
            $stmt = $conn->prepare("INSERT INTO likes(hotel_id, user_id) VALUES(?,?)");
            $stmt->bind_param("ii",$hotel_id,$user_id);
            if($stmt->execute()){
                echo 'liked';
            }else{
                echo 'not liked';
            }
		}
}

?>