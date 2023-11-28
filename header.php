<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title> Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> 
  <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet"> 

  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="//jqueryui.com/resources/demos/style.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  <script>
  
  $( function() {
    $( ".datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  </script>








</head>
<body>

<header class="col-lg-12">
	<div id="website-title">
		 <i class="fa fa-university"></i> HRS 
	</div>


	

	 

    
<div class="col-lg-10">
	<?php if(!isset($_SESSION['is_logged_in'])) 
		{ 
			$_SESSION['is_logged_in']="0";
		} 
	?>


	<!-- Checking if user is logged in -->
	
	<?php if($_SESSION['is_logged_in']=="true"){ ?>
	
	<!-- Checking if user is admin -->
	<?php
	if($_SESSION['userid']=='1'){?>
		<div id="adminpanel">
		 <a href="all-hotel.php" style="text-decoration: none; color: white;" class="btn btn-primary">
		 <i class="fa fa-cog"></i> Panel
		 </a>
		 </div>
		
		
	<?php }
	
	?>	  
 	 
  
	<div id="login">
		<a href="login.php?logout=true" style="text-decoration: none; color: white;" class="btn btn-danger">
		 Logout  
		 </a>
	</div>

	<?php } else{ ?>
		<div id="register">
		 <a href="register.php" style="text-decoration: none; color: white;" class="btn btn-primary">
			Register
		 </a>
		</div>
		<div id="login">
			<a href="login.php" style="text-decoration: none; color: white;" class="btn btn-primary">
			 Login  
			 </a>
		</div>

	<?php } ?>

	<div id="login" style="float:right;">
		<a href="index.php" style="text-decoration: none; color: white;" class="btn btn-primary">
		Home  
		 </a>
	</div>
	</div>



	





</header>


<div class="search-form-div">
</div>
<div class="col-lg-12">
<center><h2 style="font-weight: bold;">SEARCH HOTELS <i class="fa fa-search"></i></h2></center>
<form class="form-signin" action='search.php' method='post'>
		<div class="row">
		<div class="col-lg-3">
		 <input type="text" class="form-control" name="city" placeholder="City name" required> 
		</div>
		<div class="col-lg-2">
		  <input type="number" class='form-control' name="likes"  placeholder="Likes">
		  </div>
		<div class="col-lg-2">
			<select class="form-control" name="star" required>
				<option selected disabled>Star rating</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
			</select>
		  </div>
		<div class="col-lg-3">
		  <input type="text" name="budgetmax" class="form-control" placeholder="Budget max">
		  </div>
		  <div class="col-lg-2">
		  <button class="form-control btn-primary"><input type="hidden" value="Search" class="form-control col-lg-3" style="background:green;height:20px;background: #120c4e;height: 30px;color: white;"> Search <i class="fa fa-search"></i></button>
		  </div>
		</div>
		</form> 
		
</div>

