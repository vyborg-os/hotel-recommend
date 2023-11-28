<?php include 'header.php' ?>
<?php require 'mysql_connect.php'; ?>
<?php include 'sidebar.php' ?>


<!-- Updating hotel information -->

<?php $id=$_GET['id'];
		$sql = "SELECT * FROM hotel where id=".$id;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) { 
		$row = $result->fetch_assoc();
	}

?>


<center><div class="col-lg-8 mt-4" style="background-color: lightgrey;">
<!-- Form to edit hotel -->
<h2>Edit hotel Info</h2>
<form class="form-group" method="post" action='addnewhotel.php' enctype="multipart/form-data">
<div class="row">
	<input type="hidden" name="id"  value='<?php echo $row['id'];?>'/><br/>
	<div class="col-lg-4">
	<input type="text" class="form-control mb-2" name="name" placeholder="Hotel name" value='<?php echo $row['name'];?>' />
	</div>
	<div class="col-lg-4">
	<input type="text" class="form-control mb-2" name="price" placeholder="Min price" value='<?php echo $row['price'];?>'/>
	</div>
	<div class="col-lg-4">
	<input type="text" class="form-control mb-2" name="pricemax" placeholder="Max price" value='<?php echo $row['pricemax'];?>' />
	</div>
	<div class="col-lg-12">
	<textarea class="form-control mb-2" name="description" placeholder="Hotel description"><?php echo $row['description'];?></textarea>
	</div>
	<div class="col-lg-12">
	<textarea class="form-control mb-2" name="facility" placeholder="Facilities"><?php echo $row['facility'];?></textarea>
	</div>
	<div class="col-lg-6">
	<input type="text" class="form-control mb-2" name="location" placeholder="location" value='<?php echo $row['location'];?>' />
	</div>
	<div class="col-lg-6">
	<input type="file" class="form-control mb-2" name="file" id="fileToUpload"><br/> 
    </div>
	<div class="col-lg-12">
	<input type="submit" class="btn btn-primary form-control mb-2" value="Edit" name="submit"><br/>
</div>
</div>
</form>


<!-- End of add new hotel form -->


</div>
</center>
<?php include 'footer.php' ?>