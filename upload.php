<?php 
header('Content-Type: application/json');
header('Access-Control-Allow-Orgin: *');
header('Access-Control-Allow-Methods: POST');
// @$_POST['name'] && @$_POST['discription']
// isset($_POST['submit'])

if (@$_POST['name'] && @$_POST['discription']&& isset($_FILES['my_image'])) {
	include "db_conn.php";
	$name = $_POST['name'];
	$discription = $_POST['discription'];


	// echo "<pre>";
	// print_r($_FILES['my_image']);
	// echo "</pre>";

	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];


	if ($error === 0) {
		if ($img_size > 2000000) {
			echo json_encode(array(
				"status" => false,
				"action" => "failed",
				"data" => [],
				"error" => ["this file is to large"]
			));
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;

				$img_upload_path = 'uploads/'.$new_img_name;

				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
				
				$sql = "INSERT INTO `imagewithname`(`id`, `images_url`, `name`, `discription`) VALUES ('','$new_img_name','$name','$discription')";
				mysqli_query($conn, $sql);

				echo json_encode(array(
					"status" => true,
					"action" => "Image inserted",
					"data" => ['files'=>$_FILES['my_image']],
					"error" => []
				));
				// header("Location: view.php");
			}else {
				echo json_encode(array(
					"status" => false,
					"action" => "invalid request",
					"data" => [],
					"error" => ["you cannot upload this type of image"]
				));
		        // header("Location: index.php?error=$em");
			}
		}
	}else {
		echo json_encode(array(
			"status" => false,
			"action" => "invalid request",
			"data" => [],
			"error" => ["Unknown error occur"]
		));
		// header("Location: index.php?error=$em");
	}

}else {
	echo json_encode(array(
		"status" => false,
		"action" => "select image failed",
		"data" => [],
		"error" => ["please provide name and discription"]
	));
	// header("Location: index.php");
}