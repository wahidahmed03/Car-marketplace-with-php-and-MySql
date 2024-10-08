<?php 
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES['file']['name']);
    
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {

        $base_url = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
        $file_url = $base_url . "/" . $target_file;
        echo $file_url;



        echo "The file ". htmlspecialchars(basename($_FILES['file']['name'])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="file.php" method="POST" enctype="multipart/form-data">
        <input type="file" required name="file" accept="image/*">
        <input type="submit">
    </form>
</body>
</html>
