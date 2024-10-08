<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>




<div class=' w-full  dark:bg-gray-900 text-black dark:text-white '>
      <div class=" flex  flex-col items-center justify-center dark:bg-gray-800/40 pb-20">

      <div class="p-10">
        <h5 class='text-5xl'>Most Searched Cars  </h5>
      </div>
      <div class="flex gap-2 items-center justify-center flex-wrap ">

      <?php include('./CarDetails.php')    ?>






      </div>
      <a href="" class=' flex items-center justify-center  gap-2 py-2 px-8 border-[3px]  mt-7  hover:border-blue-500 hover:bg-blue-500/50 transition-all duration-300'  >Explore Cars <GiCityCar size={35} /> </Link>
      </div>
</div>






    
</body>
</html>