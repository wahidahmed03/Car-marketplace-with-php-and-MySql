<?php 
$IsUserLogin=false;
 
if($_SESSION == TRUE){
    $IsUserLogin=true;

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
<div class='flex items-center justify-between px-5 py-2 bg-gray-100 dark:bg-gray-900 relative text-black dark:text-white dark:shadow-md drop-shadow z-10'>

  <!-- {/***  LOGO BAR */} -->
  <div class=" text-xl text-gray-900 dark:text-white">
    <a href='/' >Car <span class=' text-blue-500 '>Market</span>Pace.</Link>
  </div>

  <!-- {/** Desktop ManuBar **/} -->
  <div class="hidden lg:flex text-black dark:text-white">

    <a href="/">
        <div class='mx-2'>
            <div class="h-[20px] group overflow-hidden">
                <div class="h-[20px] group-hover:-mt-7 transition-all duration-500 cursor-pointer">
                    <p>Home</p>
                    <p>Home</p>
                </div>
            </div>
        </div>
    </a>

    <a href="./page/ExploreCar.php">
        <div class='mx-2'>
            <div class="h-[20px] group overflow-hidden">
                <div class="h-[20px] group-hover:-mt-7 transition-all duration-500 cursor-pointer">
                    <p>Explore</p>
                    <p>Explore</p>
                </div>
            </div>
        </div>
    </a>

    <a href="/">
        <div class='mx-2'>
            <div class="h-[20px] group overflow-hidden">
                <div class="h-[20px] group-hover:-mt-7 transition-all duration-500 cursor-pointer">
                    <p>About Us</p>
                    <p>About Us</p>
                </div>
            </div>
        </div>
    </a>

    <a href="/">
        <div class='mx-2'>
            <div class="h-[20px] group overflow-hidden">
                <div class="h-[20px] group-hover:-mt-7 transition-all duration-500 cursor-pointer">
                    <p>Contact Us</p>
                    <p>Contact Us</p>
                </div>
            </div>
        </div>
    </a>

    <a href="./page/singup.php">
        <div class='mx-2'>
            <div class="h-[20px] group overflow-hidden">
                <div class="h-[20px] group-hover:-mt-7 transition-all duration-500 cursor-pointer">
                    <p>Sign Up</p>
                    <p>Sign Up</p>
                </div>
            </div>
        </div>
    </a>

</div>


  <!-- {/*** UserAccount bar and darkmod */} -->
  <div class=" flex gap-2 items-center  justify-center">
    <div class=""><IsDarkModBtn /></div>
    <div class=" block lg:hidden"><AiOutlineMenu  size={30}/></div>
    <?php echo $IsUserLogin ? '<a href="./page/Dashbord.php" class="hidden lg:block">Dashbord</a>
    <div class=" hidden lg:block"><ProfileAccount /></div>
    ' : '<a class="hidden lg:block px-5 py-[6px] rounded bg-blue-600/20 text-[16px]" href="./singin.php">Login</a>'; ?>

  </div>
 </div>
</body>
</html>




