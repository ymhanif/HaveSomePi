<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hanif
 * Date: 4/12/2015
 * Time: 3:13 PM
 */

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$upload0k = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check to see if image file is an actual image or a fake image
if(isset($_POST["submit"])){
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false){
        echo "File is an image - " . $check["mime"] . ".";
        $upload0k = 1;
    } else{
        echo "File is not an image.";
        $upload0k = 0;
    }
}
?>