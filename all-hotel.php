<?php include 'header.php'; ?>
<?php require 'mysql_connect.php'; ?>

<?php include 'sidebar.php'; ?>
<div class="col-lg-12 mt-4">
	<div class="row">


	<?php
	function fetchlike($hotel_id){
		require 'mysql_connect.php';
		$sql = "SELECT * FROM likes WHERE hotel_id = '$hotel_id'";
		$result = $conn->query($sql);
		return $result->num_rows;
	}
	/* Displaying all hotels */

        $sql = "SELECT * FROM hotel ORDER BY id desc";
		$result = $conn->query($sql);
		if($result){
		if ($result->num_rows > 0){
		    // output data of each row
		    while($row = $result->fetch_assoc()) {   
				$hotel_id = $row['id'];
 				$name_slug=  preg_replace('#[ -]+#', '-', strtolower($row['name']));
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
			<div class="fetchc col-lg-4">
					<a href="hotel.php?id=<?php echo $row['id']; ?>" class="card" style="text-decoration: none;">
							<img src="assets/hotel_img/<?php echo $name_slug; ?>/<?php echo $row['img'];?>" style="width:100%;height:300px;text-align: center;"/>
						
						<div class="hotel-list-item-details" style="background-color: white; color: black;">
							<div class="row">
								<div class="col-lg-8"><b><?php echo $row['name']; ?></b><br><p style="float: left; color: lightgrey;"><?php echo ucwords($row['location']); ?></p></div>
								<div class="col-lg-3" style="color: green; font-size: 1.2em;"><p style="float: right; color: red;">$ <?php echo $row['price']; ?></p></div>
								<div class="col-lg-6"  style="color: lightgrey;"> <i class="fa fa-thumbs-up" style="color: blue; float: left;"> <?php echo fetchlike($hotel_id); ?> </i> </div>
							</div>
						</div>
					</a>
					<div class="col-lg-6"><a href="hoteledit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a> <a class="btn btn-danger" href="hoteldelete.php?id=<?php echo $row['id']; ?>">Delete</a></div>
			</div>

	 	 

	 			<?php 
	 			}
	 		}
		} else 
		{
		    echo "<h2 style='color:red;'>No Hotels Found</div>";
		}
		
        ?>


	</div>
</div>

<?php include 'footer.php' ?>