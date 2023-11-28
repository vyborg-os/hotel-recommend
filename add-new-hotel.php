<?php include 'header.php' ?>

<?php include 'sidebar.php' ?>

<center><div class="col-lg-8 mt-4" style="background-color: lightgrey;">
<!-- Form to add new hotel -->
<h2>Add new hotel </h2>
<form class="form-group" method="post" action='addnewhotel.php' enctype="multipart/form-data">
<div class="row">
	
	<div class="col-lg-6">
	<input type="text" class="form-control mb-2" name="name" placeholder="Hotel name" />
	</div>
	<div class="col-lg-6">
	<input type="text" class="form-control mb-2" name="price" placeholder="Price" />
	</div>
	<div class="col-lg-8">
	<textarea class="form-control mb-2" name="description" placeholder="Hotel description"></textarea>
	</div>
	<div class="col-lg-4">
	<textarea class="form-control mb-2" name="facility" placeholder="Facilities"></textarea>
	</div>
	<div class="col-lg-6">
	<input type="text" class="form-control mb-2" name="location" placeholder="location" />
	</div>
	<div class="col-lg-6">
	<input type="file" class="form-control mb-2" name="file" id="fileToUpload">
	</div>
	<div class="col-lg-12">
    <input type="submit" class="btn btn-primary form-control mb-2" value="add new" name="submit">
	</div>
	</div>
</form>


<!-- End of add new hotel form -->


</div>
</center>

<?php include 'footer.php' ?>