<?php
 if(isset($_POST["submit"])){
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "myDB";
 $conn = new mysqli($servername, $username, $password, $dbname);
 if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
 }
 if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
 $imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
 $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
 $sql = "INSERT INTO logo (imageType, imageData) VALUES('{$imageProperties['mime']}',
 '{$imgData}')";
 if ($conn->query($sql) === TRUE) {
 echo "Image inserted successfully";
 } else {
 echo "Error updating record: " . $conn->error;
 }
 $conn->close();
 }
 }
 ?>