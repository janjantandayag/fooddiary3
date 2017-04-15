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
			                	var html = '<div class="col-md-3 col-sm-3 itemContainer" id="photo-'+id+'"> <div class="form-group"> <img src="'+event.target.result+'" class="imgPreview" id="photoPreview"/> <label for="foodName" class="labelFood">Food Name</label><input type="text" class="form-control" id="foodName"  name="foodName[]" required /> </div> <div class="form-group"><label for="servingSize" class="labelFood">Serving Size</label><a href="#" data-toggle="modal" title="Click for further info" data-target="#servingModal"><span class="fa fa-question" style="float: right;color:#eeb10c;font-size:110%"></span></a><input type="text" placeholder = "(1 cup, 1 slice, 170g)" class="form-control" id="servingSize" name="servingSize[]" required></div><div class="form-group"><label for="description" class="labelFood">Description</label><textarea class="form-control" id="description" name="description[]" required></textarea></div><div class="form-group"><label for="servingSize" class="labelFood">Time Eaten</label><p style="font-family: novaThin;color:#8a8989;font-weight: bold;margin-bottom: 4px;font-style: italic">Default time is the current time</p><input type="time" class="form-control" name="time[]" value="<?php echo date('H:i'); ?>" required />	</div></div>';
			                	$(placeToInsertImagePreview).append(html);
			                }
			                reader.readAsDataURL(input.files[i]);
			            }
			        }
			    };
			    $('#file-photo-90').on('change', function() {
		        	imagesPreview(this, 'div.gallery');			
					var photo = $("#file-photo-90").val();
					// Returns successful data submission message when the entered information is stored in database.
					var dataString = 'photo='+ photo;
		            $.ajax({
						type: "POST",
						url: "test.php",
						data: dataString,
						cache: false
					});
			    });
			});
		</script>
</head>
<body class="mainPage">
	<?php var_dump($_SESSION['test']); ?>
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
							for($i=0;$i<count($_POST['foodName'][$i]);$i++){
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
</body>
</html>