<?php include 'header.php' ?>
<?php require 'mysql_connect.php'; ?>


<!-- Displaying results based on search -->



<div class="container col-lg-12 mt-4">
<h2>Recommended Hotels </h2>
	<div class="row">
        <?php
		function fetchlike($hotel_id){
			require 'mysql_connect.php';
			$sql = "SELECT * FROM likes WHERE hotel_id = '$hotel_id'";
			$result = $conn->query($sql);
			return $result->num_rows;
		}
		function likehotel($hotel_id, $user_id){
			require 'mysql_connect.php'; 
			$sql = "INSERT INTO likes (hotel_id, user_id)
					VALUES ('$hotel_id', '$user_id')";
			$result = $conn->query($sql);
			if($result==true){
				return true;
			}else{
				return false;
			}
	
		}
		function checklike($hotel_id, $user_id){
			require 'mysql_connect.php'; 
			$sql = "SELECT * FROM likes WHERE hotel_id = '$hotel_id' AND user_id = '$user_id'";
			$result = $conn->query($sql);
			$r = $result->num_rows;
			if($r > 0){
				return true;
			}else{
				return false;
			}
		}
		$city=strtolower($_POST['city']);
		$likez=$_POST['likes'];
		$star=$_POST['star'];
		$budget=$_POST['budgetmax'];
        $sql = "SELECT * FROM hotel WHERE location='$city' OR id IN (SELECT DISTINCT hotel_id FROM reviews WHERE rating='$star') OR id IN (SELECT hotel_id FROM likes GROUP BY hotel_id HAVING COUNT(*) >= '$likez')";
		//$sql = "SELECT * FROM hotel WHERE hotel_id = (SELECT DISTINCT hotel_id FROM reviews WHERE rating='$star') ";
		// $sql = "SELECT COUNT(DISTINCT) hotel_id FROM likes WHERE location='$city' ";
		$result = $conn->query($sql);
		if($result){
			if ($result->num_rows > 0){
			    // output data of each row
		    while($row = $result->fetch_assoc()) 
			    {   
			    	$name_slug=  preg_replace('#[ -]+#', '-', strtolower($row['name']));
					$hotel_id=$row['id'];
					$sql3 = "SELECT rating FROM reviews where hotel_id='$hotel_id' LIMIT 5";
					$result3 = $conn->query($sql3);

					$sum = 0;
					$usercount=0;
					while($row3 = $result3->fetch_assoc()) {
						
						$sum+=($row3['rating']);
						$usercount++;
					}


					if($usercount=='0'){
						$usercount=1;
					}
					$averating=round($sum/$usercount); 
		     	?>

		            
		<style>
			.fetchc{
				padding: 20px 15px;
				flex-direction: column;
				transition: 0.3s ease-in-out;
			}
			.container .row .fetchc .hotel-list-item-details:hover {
				color: blue;
			}
			.card {
			box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
			transition: 0.3s;
			width: 100%;
			border-radius: 15px 15px 0 0;
			}

			.card:hover {
			box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
			}

			img {
			border-radius: 15px 15px 0 0;
			}

			.hotel-list-item-details {
			padding: 2px 16px;
			}
		</style>
 		<div class="fetchc col-lg-3">
			<a href="hotel.php?id=<?php echo $row['id']; ?>" class="card" style="text-decoration: none; height: 370px;">

					<img src="assets/hotel_img/<?php echo $name_slug; ?>/<?php echo $row['img'];?>" style="width:100%;height:250px;text-align: center;"/>
				
				<div class="hotel-list-item-details" style="background-color: white; color: black;">
					<div class="row">
						<div class="col-lg-8"><b><?php echo $row['name']; ?></b><br><p style="float: left; color: lightgrey;"><?php echo ucwords($row['location']); ?></p></div>
						<div class="col-lg-3" style="color: green; font-size: 1em;"><p style="float: right; color: red;">$ <?php echo $row['price']; ?></p></div>
						<div class="col-lg-12"> 
						<span style="color: lightgrey; font-size: 0.8rem;">Rating:</span> <?php  $max=$averating; if($max==0){$max=1;} for($j=0;$j<$max;$j++){ ?> <img src="assets/star.png" style="width:15px;height:15px;"/><?php  }?>
						</div>
						<div class="col-lg-6"  style="color: lightgrey;"> <i class="fa fa-thumbs-up" style="color: blue; float: left;"> <?php echo fetchlike($row['id']); ?> </i> </div>
						<div class="col-lg-6"> 
						<?php
						$user_id = $_SESSION['userid'];
						$chk = checklike($hotel_id, $user_id);
						if($chk==true){
							echo '';
						}else{
							?>
							<form class="likethis" method="post" action='index.php' enctype="multipart/form-data">
								<input type="hidden" name="userid" value="<?php echo $user_id; ?>">
								<input type="hidden" name="hotelid" value="<?php echo $hotel_id; ?>">
							<button type="submit" class="btn btn-primary" style="width: 50px; border-radius: 25px 25px 25px 25px; float: right;"><i class="fa fa-thumbs-up"></i><input type="hidden" name="likethis" /></button>
							</form>
						<?php
						}
						?>
						</div>
					</div>
				</div>
		 	</a>
			
			 </div> 	
				<?php 
				}
			}
		
		else {
		    echo "<h2 style='color:red;'>No Hotels Found Matching Your requirements</div>";
			}
		} 
		
        ?>


</div>
</div>

<?php include 'footer.php' ?>