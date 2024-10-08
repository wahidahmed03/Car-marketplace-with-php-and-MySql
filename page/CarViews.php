<?php 
include('./db.php');
session_start();
$Car_id = isset($_GET['id']) ? intval($_GET['id']) : 0;



$stmt = $conn->prepare("SELECT * FROM cars WHERE id = ?");
$stmt-> bind_param("i",$Car_id);
$stmt->execute();
$Result = $stmt->get_result();

if($Result->num_rows > 0){
    $car_data= $Result->fetch_assoc();
    $Car_Future_Data = $car_data["features"];
}
else{

}





?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>
<body>
  <?php include("./../Header.php") ?>


<div class=' bg-gray-50 dark:bg-gray-900 text-black dark:text-white py-10 px-20'>
   <div class="">
   <h2 class='text-4xl font-semibold'><?php echo htmlentities($car_data["model"]) ?></h2>
   <p><?php echo htmlentities($car_data["brand"]) ?></p>
   <div class=" flex flex-wrap gap-2 font-semibold text-blue-600 dark:text-white">
   <div class=" w-[70px] h-[32px] bg-blue-500/30 border-[2px] border-blue-600 rounded-xl flex items-center justify-center">Time</div>
   <div class=" w-[70px] h-[32px] bg-blue-500/30 border-[2px] border-blue-600 rounded-xl flex items-center justify-center">Time</div>
   <div class=" w-[70px] h-[32px] bg-blue-500/30 border-[2px] border-blue-600 rounded-xl flex items-center justify-center">Time</div>
   <div class=" w-[70px] h-[32px] bg-blue-500/30 border-[2px] border-blue-600 rounded-xl flex items-center justify-center">Time</div>
   </div>
   </div>
   <div class=" flex gap-5">
      <div class=" flex  flex-col  gap-5">
         <div class=" py-5 shadow-xl px-3 rounded w-[850px]  mt-2 dark:bg-gray-800/50 bg-gray-100/50 ">
          <img class='w-[830px] h-[500px]  rounded-2xl object-cover shadow-lg ' src=<?php echo htmlentities($car_data["image_url"]) ?> alt="" />
         <div class=" flex  gap-1  py-2">
          <img class='w-[200px] h-[120px] shadow rounded-2xl object-cover'  src=<?php echo htmlentities($car_data["image_url"]) ?> alt="" />
          <img class='w-[200px] h-[120px] shadow rounded-2xl object-cover'  src=<?php echo htmlentities($car_data["image_url"]) ?> alt="" />
          <img class='w-[200px] h-[120px] shadow rounded-2xl object-cover'  src=<?php echo htmlentities($car_data["image_url"]) ?> alt="" />
         </div>
         </div>   
      <div class=" flex flex-wrap gap-2">
         <div class=" py-10 px-5  bg-gray-100 dark:bg-gray-900  rounded shadow-lg drop-shadow-md max-w-[850px] border-[2px] dark:border-gray-700">
          <p class='text-2xl py-3 font-bold'>Driscription</p>
          <p><?php echo htmlentities($car_data["Driscription"]) ?></p>
         </div>
         <div class=" py-8 px-5 bg-gray-100 dark:bg-gray-900 rounded shadow-lg drop-shadow-md max-w-[850px] border-[2px] dark:border-gray-700 ">
          <p class='text-2xl py-3 font-bold'>Future</p>
          <div class=" flex gap-5 flex-wrap-reverse  order-first	">
           <?php  foreach ( explode(',',$car_data["features"])  as $future ){
           echo '<div class="flex items-center gap-2 justify-center	 text-xl">
           <div class="w-[15px] h-[15px] rounded-full bg-blue-400/50 border border-blue-600" ></div> ' . htmlspecialchars($future) . '
           </div>';}?>
          </div>
         </div>
      </div>
      </div>
   <div class="">
   <div class="w-[500px] h-[200px] bg-gray-100 drop-shadow-lg dark:bg-gray-800	 py-5 px-5 rounded mt-2">
   <p class=' text-lg'>OUR PRICE</p>
   <h5 class=' text-6xl font-semibold ' >$ <?php echo htmlentities($car_data["price"]) ?></h5>
   <div class=" w-full h-[40px]  rounded text-center flex items-center justify-center text-white font-medium my-3 bg-blue-500">
   <Link class='' href={"/"} >Buy Car</Link>
   </div>
   </div>


<div class="  bg-gray-100 drop-shadow-lg dark:bg-gray-800	 py-10 px-5 rounded mt-2">
   <p class=' text-lg text-center pb-5'>Specifications</p>
   <div class=" px-5 flex gap-5 flex-col text-xl">

   <div class=" flex justify-between">
   <div class=" flex gap-2 items-center ">
   <div class="py-1 px-1 rounded-full bg-blue-500/40 border border-blue-500 text-blue-800 dark:text-white">
   <AiFillCar size={15} />
   </div>
   Category
   </div>
   <?php echo htmlentities($car_data["car_type"]) ?>
   </div>


   <div class=" flex justify-between">
   <div class=" flex gap-2 items-center ">
   <div class="py-1 px-1 rounded-full bg-blue-500/40 border border-blue-500 text-blue-800 dark:text-white">
   <AiFillCar size={15} />
   </div>
   Condition
   </div>
   <?php echo htmlentities($car_data["car_condition"]) ?>
   </div>
   <div class=" flex justify-between">
   <div class=" flex gap-2 items-center ">
   <div class="py-1 px-1 rounded-full bg-blue-500/40 border border-blue-500 text-blue-800 dark:text-white">
   <AiFillCar size={15} />
   </div>
   Make
   </div>
   <?php echo htmlentities($car_data["brand"]) ?>
   </div>
   <div class=" flex justify-between">
   <div class=" flex gap-2 items-center ">
   <div class="py-1 px-1 rounded-full bg-blue-500/40 border border-blue-500 text-blue-800 dark:text-white">
   </div>
   Model
   </div>
   <?php echo htmlentities($car_data["model"]) ?>
   </div>

   <div class=" flex justify-between">
   <div class=" flex gap-2 items-center ">
   <div class="py-1 px-1 rounded-full bg-blue-500/40 border border-blue-500 text-blue-800 dark:text-white">
   </div>
   Year
   </div>
   <?php echo htmlentities($car_data["relese_year"]) ?>
   </div>


                           
   <div class=" flex justify-between">
   <div class=" flex gap-2 items-center ">
   <div class="py-1 px-1 rounded-full bg-blue-500/40 border border-blue-500 text-blue-800 dark:text-white">
   </div>
   Drive Type
   </div>
   <?php echo htmlentities($car_data["drive_type"]) ?>
   </div>



   <div class=" flex justify-between">
   <div class=" flex gap-2 items-center ">
   <div class="py-1 px-1 rounded-full bg-blue-500/40 border border-blue-500 text-blue-800 dark:text-white">
   </div>
   Transmission
   </div>
   <?php echo htmlentities($car_data["transmission"]) ?>
   </div>




   <div class=" flex justify-between">
   <div class=" flex gap-2 items-center ">
   <div class="py-1 px-1 rounded-full bg-blue-500/40 border border-blue-500 text-blue-800 dark:text-white">
   <AiFillCar size={15} />
   </div>
   Fuel Type
   </div>
   <?php echo htmlentities($car_data["fuel_type"]) ?>
   </div>




   <div class=" flex justify-between">
   <div class=" flex gap-2 items-center ">
   <div class="py-1 px-1 rounded-full bg-blue-500/40 border border-blue-500 text-blue-800 dark:text-white">
   </div>
   Mileage
   </div>
   <?php echo htmlentities($car_data["fuel_efficiency_city"]) ?>
   </div>




   <div class=" flex justify-between">
   <div class=" flex gap-2 items-center ">
   <div class="py-1 px-1 rounded-full bg-blue-500/40 border border-blue-500 text-blue-800 dark:text-white">
   </div>
   Engine Size
   </div>
   <?php echo htmlentities($car_data["engine_size"]) ?>
   </div>




   <div class=" flex justify-between">
   <div class=" flex gap-2 items-center ">
   <div class="py-1 px-1 rounded-full bg-blue-500/40 border border-blue-500 text-blue-800 dark:text-white">
   </div>
   Cylinder
   </div>
   <?php echo htmlentities($car_data["cylinder"]) ?>
   </div>

                           
   <div class=" flex justify-between">
   <div class=" flex gap-2 items-center ">
   <div class="py-1 px-1 rounded-full bg-blue-500/40 border border-blue-500 text-blue-800  dark:text-white">
   <AiFillCar size={15} />
   </div>
   Color
   </div>
   <div class="px-2"><?php echo htmlentities($car_data["color"]) ?></div>
   </div>



   <div class=" flex justify-between">
   <div class=" flex gap-2 items-center ">
   <div class="py-1 px-1 rounded-full bg-blue-500/40 border border-blue-500 text-blue-800 dark:text-white">
   </div>
   Door
   </div>
   <?php echo htmlentities($car_data["door"]) ?>
   </div>

   <div class=" flex justify-between">
   <div class=" flex gap-2 items-center ">
   <div class="py-1 px-1 rounded-full bg-blue-500/40 border border-blue-500 text-blue-800 dark:text-white">
   </div>
   Engine
   </div>
   <?php echo htmlentities($car_data["engine"]) ?>
   </div>

   <div class=" flex justify-between">
   <div class=" flex gap-2 items-center ">
   <div class="py-1 px-1 rounded-full bg-blue-500/40 border border-blue-500 text-blue-800 dark:text-white">
   </div>
   Horsepower
   </div>
   <?php echo htmlentities($car_data["horsepower"]) ?>
   </div>

   <div class=" flex justify-between">
   <div class=" flex gap-2 items-center ">
   <div class="py-1 px-1 rounded-full bg-blue-500/40 border border-blue-500 text-blue-800 dark:text-white">
   </div>
   Drive type
   </div>
   <?php echo htmlentities($car_data["drive_type"]) ?>
   </div>


   </div>
   </div>
   </div>
   </div>
</div>



        
</body>
</html>