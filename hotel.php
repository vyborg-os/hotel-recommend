<?php include 'header.php' ?>
<?php require 'mysql_connect.php'; ?>

<?php $id=$_GET['id'];

/* Fetching data from database based on selected id*/

$sql = "SELECT * FROM hotel where id=".$id;
$result = $conn->query($sql);
if ($result->num_rows > 0) { 
$row = $result->fetch_assoc();
$name_slug=  preg_replace('#[ -]+#', '-', strtolower($row['name']));
?>
<div class="container">
	 
	<div style="width:50%;float:left;text-align: center;">
		<img src="assets/hotel_img/<?php echo $name_slug; ?>/<?php echo $row['img'];?>" style="height:300px;width:300px;"/>
	</div>
	<div style="width:50%;float:left">

  
	<?php
		

		
		 ?>
		     	
	     	<p>Hotel Name : <?php echo $row['name'];?></p>
			<p>Price : Under $<?php echo $row['price'];?></p>
			<p>Description : <?php echo $row['description'];?></p>
			<p>Facility : <?php echo $row['facility'];?> </p>
			<p>Location : <?php echo ucfirst($row['location']);?> </p>



		<?php if($_SESSION['is_logged_in']=="true"){ ?>
		<div >
			<h4> Write a review about hotel </h4>
	        <form class="reviewform" method=POST action='review.php'>

				<label style="float:left;">Rate this Hotel :</label>
				<div style="margin-top:-20px;float:left;">

				<input class="star star-5" id="star-5" type="radio" name="rating" value='5'/>
				<label class="star star-5" for="star-5"></label>
				<input class="star star-4" id="star-4" type="radio" name="rating" value='4'/>
				<label class="star star-4" for="star-4"></label>
				<input class="star star-3" id="star-3" type="radio" name="rating" value='3'/>
				<label class="star star-3" for="star-3"></label>
				<input class="star star-2" id="star-2" type="radio" name="rating" value='2'/>
				<label class="star star-2" for="star-2"></label>
				<input class="star star-1" id="star-1" type="radio" name="rating" value='1'/>
				<label class="star star-1" for="star-1"></label>
				</div>


				<div style="clear:both;"></div>
		        <input type='hidden' name="hotelid" value="<?php echo $id;?>"/>
		        <input type='hidden' name="username" value="<?php echo $_SESSION['userid'];?>"/>
	          
			  <textarea rows="4" cols="50" name="reviews" placeholder="Write something"></textarea> 
			  <br/>
			  <input type="submit" value="Submit" style="background:green;height:20px;background: #120c4e;height: 30px;color: white;"> 
			</form> 
		</div>
		<?php } ?>
		



		
		<?php

		/* Fetching reviews based on id */

		$hotel_id=$row['id'];
		$sql1 = "SELECT * FROM reviews where hotel_id='$hotel_id' ORDER BY id desc" ;
		$result1 = $conn->query($sql1);

		if ($result1->num_rows > 0){ ?>
		<h3>Reviews by users : </h3>	
		<?php } else{ ?>
        <h4 style="color:red;"> No reviews available</h4>     

		<?php	}  

		if ($result1->num_rows > 0) { 


			 $i=0;
			while($row1 = $result1->fetch_assoc()) { 

	 	    $userid=$row1['username'];
			$sql2 = "SELECT username FROM users where id='$userid' LIMIT 1 "; 	
			$result3 = $conn->query($sql2);
			$row2 = $result3->fetch_assoc();

	 	?>	
		
		
		<div style="clear:both;width:100%;">
		
          
 		<div style="float:left;margin-right:5px;"><?php  $max=$row1['rating']; if($max==0){$max=1;} for($j=0;$j<$max;$j++){ ?> <img src="assets/star.png" style="width:15px;height:15px;"/><?php  }?></div>
       
		<p>  <?php echo $row1['reviews'];?>.  User : <b style="color:#003171;"><?php echo ucwords($row2['username']);?></b></p>


		 

		</div>


         

 	<?php if($i>=4)  break;  


 	      $i++; } 


        } 
		} else {
		    echo "0 results";
		}
	?>




 </div>

	

</div>

<!-- Hotel suggestions based on location and price selected by user -->

<div class="container col-lg-12 mt-4">
	
<h3>Recommended Hotels : </h3>
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
        $location=strtolower($row['location']);
        $sugg_price=$row['price'];
        $sql = "SELECT * FROM hotel where id!='$id' AND location='$location' AND price < '$sugg_price' LIMIT 5";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {

		?>
		<?php
		    // output data of each row
		    while($row = $result->fetch_assoc()) {   

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
						<div class="col-lg-6"  style="color: lightgrey;"> <i class="fa fa-thumbs-up" style="color: blue; float: left;"> <?php echo fetchlike($hotel_id); ?> </i> </div>
						<div class="col-lg-6"> 
						<span style="color: lightgrey; font-size: 0.8rem;">Rating:</span> <?php  $max=$averating; if($max==0){$max=1;} for($j=0;$j<$max;$j++){ ?> <img src="assets/star.png" style="width:15px;height:15px;"/><?php  }?>
						</div>
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
							<button type="submit" class="btn btn-primary" style="width: 50px; border-radius: 25px 25px 25px 25px; float: left;"><i class="fa fa-thumbs-up"></i><input type="hidden" name="likethis" /></button>
							</form>
						<?php
						}
						?>
						</div>
					</div>
				</div>
		 	</a>
			
			 </div> 
	         	
		<?php }
		} else {
		    echo "<h2 style='color:red;''>No results found </h2>";
		}

        ?>


</div>
</div>

<?php include 'footer.php' ?>