<?php
   	include('database/Function.php');
	include('database/connection.php');
    $db = new Database;
    $db->isLogin();    
    if(!isset($_SESSION['detail']['emotionId']) || !isset($_SESSION['detail']['mealType'])){
    	echo "<script>alert('Oops! Please select meal type first!')</script>";
    	echo "<script>window.location.href='add-entry.php'</script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Entry - Food Detail</title>
	<?php include ('include/links.php'); ?>
	<script>
			$(function() {
			    // Multiple images preview in browser
			    function generate(){
			    	var text = "";
				    var possible = "123456789";
				    for(var i = 0; i < 10; i++) {
				        text += possible.charAt(Math.floor(Math.random() * possible.length));
				    }
				    return text;
			    }
			    var imagesPreview = function(input, placeToInsertImagePreview) {
			        if (input.files) {
			            var filesAmount = input.files.length;
			            for (i = 0; i < filesAmount; i++) {
			                var reader = new FileReader();
			                reader.onload = function(event) {
	            				var id = generate();
			                	var html = '<div class="col-md-3 col-sm-3 itemContainer" id="photo-'+id+'"> <div class="form-group"> <!-- <input type="button" value="remove" class="removeButton" onclick="remove('+id+');"/> --> <img src="'+event.target.result+'" class="imgPreview"/> <label for="foodName" class="labelFood">Food Name</label><input type="text" class="form-control" id="foodName"  name="foodName[]" required /> </div> <div class="form-group"><label for="servingSize" class="labelFood">Serving Size</label><a href="#" data-toggle="modal" title="Click for further info" data-target="#servingModal"><span class="fa fa-question" style="float: right;color:#eeb10c;font-size:110%"></span></a><input type="text" placeholder = "(1 cup, 1 slice, 170g)" class="form-control" id="servingSize" name="servingSize[]" required></div><div class="form-group"><label for="description" class="labelFood">Description</label><textarea class="form-control" id="description" name="description[]" required></textarea></div><div class="form-group"><label for="servingSize" class="labelFood">Time Eaten</label><p style="font-family: novaThin;color:#8a8989;font-weight: bold;margin-bottom: 4px;font-style: italic">Default time is the current time</p><input type="time" class="form-control" name="time[]" value="<?php echo date('H:i'); ?>" required />	</div></div>';
			                	$(placeToInsertImagePreview).append(html);
			                }
			                reader.readAsDataURL(input.files[i]);
			            }
			        }
			    };
			    $('#file-photo-90').on('change', function() {
			    	$('.itemContainer').remove();
			    	if ($('#file-photo-90').get(0).files.length === 0) {	
						$('.detailSubmit').css("display","none");
			    	}
			    	else{			    		
						$('.detailSubmit').css("display","block");
						$('.detailSubmit').removeAttr("disabled");
			    	}			    	
		        	imagesPreview(this, 'div.gallery');	
			    });
			});

			function remove(id){
				if(confirm('Are you sure you want to remove?')){
					$("#photo-"+id).remove();
					if ($('#file-photo-90').get(0).files.length === 0) {	
						$('.detailSubmit').css("display","none");
						$('.detailSubmit').attr("disabled","disabled");
			    	}			    	
			    	// var names = [];
				    // for (var i = 0; i < $('#file-photo-90').get(0).files.length; ++i) {
				    //     names.push($('#file-photo-90').get(0).files[i]);
				    // }
			  	}
			  	else{
		      		return false;
		 	 	}
			}
		</script>
</head>
<body class="mainPage">
	<header>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="left-col">
						<img src="img/logo.png">
						<h1 class="foodAppName" >Food Diary App</h1>
					</div>
					<div class="right-col">
						<ul id="topNav">
							<li><a href="archive.php"><span class="fa fa-calendar-o"></span>archive</a></li>
							<li class="navActive"><a href="add-entry.php"><span class="fa fa-plus-square-o"></span>add entry</a></li>	
							<li><a href="dashboard.php"><span class="fa fa-dashboard"></span>dashboard</a></li>
							<li><a href="documentation.php" target="_blank"><span class="fa fa-list-ol"></span>steps</a></li>
							<li  class="userNav"><a href="#"><span class="fa fa-user"></span> Hello, <?= $_SESSION['name'] ?></a>
                            <div class="dropdown-content">
						    	<a href="setting.php"><span class="fa fa-gear"></span>settings</a>
						    	<a href="database/logout.php"><span class="fa fa-power-off"></span>logout</a>
						  	</div>
							</li>
						</ul>	
					</div>
					<div>
						<a href="javascript:void(0);" onclick="myFunction();" class="icon">&#9776;</a>
                        <ul  id="mobile"  class="displayNone">
                            <li><a href="archive.php"><span class="fa fa-calendar-o"></span> archive</a></li>
                            <li  class="mobile-navActive"><a href="add-entry.php"><span class="fa fa-plus-square-o"></span> add entry</a>  </li>   
                            <li><a href="dashboard.php"><span class="fa fa-dashboard"></span> dashboard</a></li>
							<li><a href="documentation.php" target="_blank"><span class="fa fa-list-ol"></span> steps</a></li>
                            <li><a href="setting.php"><span class="fa fa-gear"></span> setting</a></li>
                            <li><a href="database/logout.php"><span class="fa fa-power-off"></span> <?= $_SESSION['name'] ?>, logout</a>
                            </li>
                        </ul>   
                    </div>
				</div>
			</div>
		</div>
	</header>
	<section id="breadcrumb">
		<div class="container">
			<div class="row breadcrumbContainer">
				<div class="col-md-12">
					<a href="dashboard.php" class="breadcrumb-link"><span class="fa fa-dashboard"></span> dashboard</a>
					<a href="add-entry.php"  class="breadcrumb-link"><span class="fa fa-plus-square-o"></span> add entry</a>
					<a href="circumplex.php"  class="breadcrumb-link">STEP 1</a>
					<a href="#"  class="breadcrumb-link  breadcrumb-link-active">STEP 2</a>
					<a href="#" id="help-circumplex" data-toggle="modal" title="Click for further info" data-target="#myModal"><span class="fa fa-question-circle"></span></a>
				</div>
			</div>
		</div>
	</section>
	<div class="mainPageFoodDetail">
		<div class="mainPageFoodDetailContainer">
			<div class="container foodDetailContainer">
				<div class="row">					
					<form action='food-detail.php' method="POST" enctype="multipart/form-data">			
						<div class="col-md-12">			
							<div class="degree90">
								<label for="file-photo-90" class="custom-file-take">
								    <i class="fa fa-cloud-upload"></i> Upload Photo/s
								</label>
								<input type="file" id="file-photo-90" name="deg90[]" multiple accept="image/*" capture="camera">
							</div>
						</div>
						<div class="gallery">
						</div>						
				</div>
				<div class="row">
					<div class="col-md-12">						
					  	<input type="submit" name="addDiary" class="detailSubmit"   value="Add to Diary" disabled style="display: none" />
					</div>				  	
					</form>
					<?php
						if(isset($_POST['addDiary'])){
							echo "<script>document.getElementById('file-photo-90').files.length = 50;</script>";
							$userId = $_SESSION['userId'];
							$emotionId = $_SESSION['detail']['emotionId'];
							$mealId = $_SESSION['detail']['mealType'];
							$posX = $_SESSION['detail']['posX'];
							$posY = $_SESSION['detail']['posY'];	
							$deg = $_SESSION['detail']['deg'];
							$dateAdded = date("Y-m-d H:i:s");
							$insertIntoEntry = mysqli_query($conn, "INSERT INTO entries(user_id,emotion_id,meal_id,date_added,entry_angle,xCoor,yCoor) VALUE($userId,$emotionId,$mealId,'$dateAdded','$deg',$posX,$posY)");

							$entryId=mysqli_insert_id($conn);		
							$dateEaten = $_SESSION['detail']['date'];
							for($i=0;$i<count($_POST['foodName']);$i++){
								  $photo = addslashes(file_get_contents($_FILES["deg90"]["tmp_name"][$i]));
								  $name = mysqli_real_escape_string($conn,strtolower($_POST['foodName'][$i]));
								  $serving = mysqli_real_escape_string($conn,strtolower($_POST['servingSize'][$i]));
								  $description = mysqli_real_escape_string($conn,strtolower($_POST['description'][$i]));
								  $time = date("H:i",strtotime($_POST['time'][$i]));
								  $dateTimeEaten = $dateEaten.' '.$time;
								  $insertItem = mysqli_query($conn, "INSERT INTO item(entry_id,food_name,food_description,serving_size,photo,date_eaten) VALUE($entryId,'$name','$description','$serving','$photo','$dateTimeEaten')");
							}
							echo "<script>alert('Successfully added!');window.location.href='archive.php';</script>";
						}
					?>			
				</div>
			</div>
		</div>
	</div>
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog" id="helpCircumplexdialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Process</h4>
	      </div>
	      <div class="modal-body">
	      	<video width="100%" controls>
			  <source src="video/food-detail.mp4" type="video/mp4">
			  <source src="video/food-detail.mp4" type="video/ogg">
			  Your browser does not support HTML5 video.
			</video>
	      </div>
	    </div>
	  </div>
	</div>
	<div id="servingModal" class="modal fade" role="dialog">
	  <div class="modal-dialog" id="servingSizeModalDialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Sample Serving Sizes</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-md-12">
	      			<img src="img/servingsize-1.jpg" width="100%" />
	      		</div>
	      		<div class="col-md-12">
	      			<img src="img/servingsize-2.jpg" width="100%" />
	      		</div>
	      		<div class="col-md-12">
	      			<img src="img/servingsize-3.jpg" width="100%" />
	      		</div>
	      		<div class="col-md-12">
	      			<img src="img/servingsize-4.jpg" width="100%" />
	      		</div>
	      		<div class="col-md-12">
	      			<img src="img/servingsize-5.jpg" width="100%" />
	      		</div>
	      		<div class="col-md-12">
	      			<p class="servingSizeRef">https://www.eatforhealth.gov.au/food-essentials/how-much-do-we-need-each-day/serve-sizes</p>
	      		</div>
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>
</body>
</html>