<?php
  // Create database connection
  $db = mysqli_connect("localhost", "root", "root", "amuser");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload']) && 0 != strlen(trim($_POST['image_text']))) {
  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
  	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);

  	// image file directory
  	$target = "data/post/".basename($image);

  	$sql = "INSERT INTO posts (image, image_text) VALUES ('$image', '$image_text')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$msg = "Image uploaded successfully";
			header("Location: index.php");
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
 
?>
<!DOCTYPE html>
<html>
<head>
<title>Image Upload</title>

</head>
<body>
<div id="content">
		
  <form method="POST" action="upload.php" enctype="multipart/form-data">
  	<input type="hidden" name="size" value="1000000">
  	<div>
  	  <input type="file" name="image">
  	</div>
  	<div>
      <textarea 
      	id="text" 
      	cols="40" 
      	rows="4" 
      	name="image_text" 
      	placeholder="Say something about this image..."></textarea>
  	</div>
  	<div>
  		<button type="submit" name="upload">POST</button>
  	</div>
  </form>
</div>
</body>
</html>