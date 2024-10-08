<?php
include("./db.php");
session_start();



$UserError ='';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_mail = $_POST['email'];
    $user_password = $_POST['password'];
    $stmt = $conn->prepare('SELECT id, password FROM users WHERE email = ?');
    $stmt->bind_param("s",$user_mail);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id,$password);



    if($stmt->num_rows>0){
        $stmt->fetch();
        if(password_verify($user_password,$password)){
            $_SESSION['user_id']=$id;
            setcookie("user_mail",$user_mail,time() + (86400*30),"/");
            $_SESSION['mailId'] = $user_mail;
            header("Location: Dashbord.php");
            exit();
        }
        else{
            $UserError = "PASSWORD NOT MATCH";
        }
    }
    else{
        $UserError = "ACCOUNT  NOT MATCH";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Your Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body >
    <?php include("./../Header.php") ?>
<div class="bg-gray-200 dark:bg-gray-900 text-black dark:text-white flex items-center justify-center h-screen">

    <div class="w-[500px] h-[400px] bg-gray-100/50 dark:bg-gray-800/40 rounded-lg shadow-2xl p-5">
        <h5 class="text-center font-semibold text-4xl mb-6">LOGIN YOUR ACCOUNT</h5>
        <form action="singin.php" method="post">
            <div class="flex flex-col items-center justify-center gap-4">
                <!-- Email Input -->
                <div class="flex items-center w-full h-[43px] px-3 gap-2 border-[3px] border-gray-300 hover:border-blue-600 dark:border-gray-300/50 transition-all duration-300 dark:bg-gray-800/40">
                    <i class="fas fa-user text-lg"></i>
                    <input type="email" name="email" placeholder="Type your email..." class="w-full h-[38px] px-1 outline-none bg-gray-100 dark:bg-gray-800/40">
                </div>
                
                <!-- Password Input -->
                <div class="flex items-center w-full h-[43px] px-3 gap-2 border-[3px] border-gray-300 hover:border-blue-600 dark:border-gray-300/50 transition-all duration-300 dark:bg-gray-800/40">
                    <i class="fas fa-lock text-lg"></i>
                    <input type="password" name="password" placeholder="Type your password..." class="w-full h-[38px] px-1 outline-none bg-gray-100 dark:bg-gray-800/40">
                </div>
                
            <!-- Submit Button -->
            <div class="flex items-center justify-center w-full h-[43px] px-3 gap-2 border-[3px] border-gray-300 hover:border-blue-600 hover:bg-blue-600/50 dark:hover:bg-blue-600/50 cursor-pointer dark:border-gray-300/50 transition-all duration-300 dark:bg-gray-800/40">
                <input type="submit" value="Submit" class="h-[38px] px-1 outline-none cursor-pointer bg-transparent">
            </div>

            <!-- Alternative Signup Link -->
            <p>Or</p>
            <div class="flex items-center justify-center w-full h-[43px] px-3 gap-2 border-[3px] border-gray-300 hover:border-blue-600 hover:bg-blue-600/50 dark:hover:bg-blue-600/50 cursor-pointer dark:border-gray-300/50 transition-all duration-300 dark:bg-gray-800/40">
                <a href="./singup.php" class="text-center w-full h-full flex items-center justify-center">Create Your Account</a>
                <?php echo $UserError;   ?>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.tailwindcss.com"></script>
</div>
</body>
</html>
