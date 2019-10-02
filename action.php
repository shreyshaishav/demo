<?php


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES['files']['name']);
$uploadok = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_POST['submit'])) {
	$check = getimagesize($_FILES['files']['tmp_name']);
	if ($check !== false) {
		echo "File is an image - " . $check['mime'] . ".";
	} else {
		echo "File is not an image.";
		$uploadok = 0;
	}
}

//Checking that file already exists or not.
if (file_exists($target_file)) {
	echo "File already exists.";
	$uploadok = 0;
}

//Checking the size of file.
if ($_FILES['files']['name'] > 50000000) {
	echo "Sorry! File size is greater than allowed size i.e. 5Mb";
	$uploadok = 0; 
}

//Checking the extensions of the image file OR Checking the extension for validating that uploading file is image or not.
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
	echo "File format/extension is not allowed. Allowed extensions are 'JPG','JPEG','PNG' and 'GIF'.";
	$uploadok = 0;
}
if ($uploadok == 0) {
	echo "Sorry! File is not uploaded.";
} else {
	if (move_uploaded_file($_FILES['files']['tmp_name'], $target_file)) {
		echo "The file is " . basename($_FILES['files']['name'] . " is uploaded successfully.");
	} else {
		echo "Sorry! File is not uploaded to system.";
	}
}







?>
