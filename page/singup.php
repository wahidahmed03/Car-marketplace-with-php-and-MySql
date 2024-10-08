<?php
session_start();
include("./../page/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $userMailId = $_POST['userMailId'] ?? '';
    $userAccountPassword = password_hash($_POST['userAccountPassword'], PASSWORD_BCRYPT);

    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($_FILES['file']['name']);
    
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file) == TRUE ) {
        $base_url = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
        $file_url = $base_url . "/" . $target_file;

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO users (username, password, email, profile_image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $userAccountPassword, $userMailId, $file_url);

        if ($stmt->execute()) {
            header('Location: signin.php'); 
        } else {
            // Handle error
            echo "Error: " . $stmt->error;
        }
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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <title>Create Your Account</title>
</head>

<body >
    <?php include("./../Header.php"); ?>
    <div class="bg-gray-200 dark:bg-gray-900 text-black dark:text-white flex items-center justify-center h-screen">

        
        <div class="w-96 h-auto dark:bg-gray-800/40 bg-gray-100/50 rounded shadow-2xl dark:shadow-lg p-5">
            <h5 class="text-center font-semibold">CREATE YOUR ACCOUNT</h5>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="flex flex-col gap-4 pt-4">
                    
                    <div class="flex items-center w-full h-12 px-3 gap-2 border-2 border-gray-300 dark:border-gray-300/50 hover:border-blue-600 transition-all duration-300 dark:bg-gray-800/40">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Type your name..." class="w-full h-10 px-1 outline-none bg-gray-100 dark:bg-gray-800/40" required>
                    </div>
                    
                <div class="flex items-center w-full h-12 px-3 gap-2 border-2 border-gray-300 hover:border-blue-600 dark:border-gray-300/50 transition-all duration-300 dark:bg-gray-800/40">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="userMailId" placeholder="Type your email..." class="w-full h-10 px-1 outline-none bg-gray-100 dark:bg-gray-800/40" required>
                </div>
                
                <div class="flex items-center w-full h-12 px-3 gap-2 border-2 border-gray-300 hover:border-blue-600 dark:border-gray-300/50 transition-all duration-300 dark:bg-gray-800/40">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="userAccountPassword" placeholder="Type your password..." class="w-full h-10 px-1 outline-none bg-gray-100 dark:bg-gray-800/40" required>
                </div>
                
                <div class="flex items-center w-full h-12 px-3 gap-2 border-2 border-gray-300 hover:border-blue-600 dark:border-gray-300/50 transition-all duration-300 dark:bg-gray-800/40">
                    <i class="fas fa-file-upload"></i>
                    <input type="file" name="file" class="w-full h-10 px-1 outline-none bg-gray-100 dark:bg-gray-800/40" accept="image/*">
                </div>
                
                <button type="submit" class="flex items-center justify-center w-full h-12 px-3 gap-2 border-2 border-gray-300 hover:border-blue-600 hover:bg-blue-600/50 dark:hover:bg-blue-600/50 cursor-pointer dark:border-gray-300/50 transition-all duration-300 dark:bg-gray-800/40">
                    Submit
                </button>
                <p class="text-center mt-4">Or</p>
                <a href="./singin.php" class="flex items-center justify-center w-full h-12 px-3 gap-2 border-2 border-gray-300 hover:border-blue-600 hover:bg-blue-600/50 dark:hover:bg-blue-600/50 cursor-pointer dark:border-gray-300/50 transition-all duration-300 dark:bg-gray-800/40">
                    Singin Your Account
                </a>
            </div>
        </form>
    </div>
    
</div>
</body>

</html>
