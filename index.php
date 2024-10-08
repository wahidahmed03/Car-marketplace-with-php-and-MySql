<?php 
include("./page/db.php");
session_start();

$query = "SELECT * FROM cars";
$stmt = $conn->prepare($query);
$stmt->execute();
$car_result = $stmt->get_result();
$Cars_Data = $car_result->fetch_all(MYSQLI_ASSOC);
$Cars= (array_slice($Cars_Data,0,10));

?>







<?php
$carTypeData = json_decode(file_get_contents(__DIR__ . '/page/CartType.json'), true);
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
  <!-- =========== HEADER SECTIONBAR ============ -->
   <?php include("./Header.php"); ?>




<!-- ===========START HERO SECTIONBAR ============ -->
<div class=" w-[98.90vw] bg-blue-100/50 dark:bg-gray-900 text-black dark:text-white h-[85vh] sm:h-[70vh] lg:h-[85vh] ">
 <div class=" flex flex-col items-center justify-center pt-28">

 <!-- HERO TAITLE BAR -->
 <div class=" flex flex-col items-center justify-center gap-2 ">
  <p class='px-5 text-center'>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cumque ad vel quibusdam aliquam amet rerum?</p>
  <h5 class=' text-4xl sm:text-5xl font-semibold'>FIND YOUR DREAM CAR</h5>
 </div>

 <div class="pt-5">
   <form action="./page/ExploreCar.php" method="POST">
  <div class='w-[300px] md:flex md:w-[750px] h-[80px] bg-gray-50 dark:bg-gray-800 md:rounded-full    shadow ' >

      <!-- SELECT CAR TYPE -->
      <div class="w-full   md:w-[30%] h-[40px] md:h-full flex items-center justify-center">
        <select  class=" bg-slate-50 dark:bg-gray-800 h-full w-full rounded-l-full outline-none  px-5 text-lg">
                <option value="">Select Make</option>
                <option value="Toyota">Toyota</option>
                <option value="Honda" >Honda</option>
                <option value="Ford" >Ford</option>
                <option value="Tesla" >Tesla</option>
                <option value="Rolls-Royce " >Rolls-Royce </option>

        </select>
      </div>
      
      <!-- SELECT CAR BAND -->
      <div class="w-full   md:w-[30%] h-[40px] md:h-full">
        <select  class=" bg-slate-50 dark:bg-gray-800 h-full w-full   px-5 text-xl outline-none " >
        <option value="">Select Year</option>
                <?php
                for ($i = 0; $i < 24; $i++) {
                    $year_option = 2024 - $i;
                    echo "<option value=\"$year_option\"";
                    echo ">$year_option</option>";
                }
                ?>
              </select>
        </select>
      </div>
      <!-- SELECT CAR PRICE -->
      <div class=" w-full   md:w-[30%] h-[40px] md:h-full">
        <select class=" bg-slate-50 dark:bg-gray-800 h-full w-full  outline-none  px-5 text-lg">
          <option value="10000000000">Any</option>
          <option value="10000">Under 10000</option>
          <option value="100000">Under 100000</option>
          <option value="200000">Under 200000</option>
        </select>
      </div>
      
      <div class="w-full bg-blue-600 md:bg-transparent md:p-2 h-[40px] md:w-[10%] md:h-full flex items-center justify-center">
        <button type="submit" class="flex items-center justify-center md:w-[60px] md:h-[60px] bg-blue-600 rounded-full text-white">
          <img class="w-10 h-10" src="https://i.ibb.co/wcD7k28/search-icon.png" alt="Search Icon">
        </button>
      </div>

      </form>
  </div>
  
</div>
<!-- HOME CAR IMAGE BAR -->
  <div class="mt-52 sm:mt-20 md:mt-10">
      <Image src="https://i.ibb.co.com/34678nV/tesla.png" width={1400} height={1400} />
  </div>
  </div>
 </div>

 <!-- ===========END HERO SECTIONBAR ============ -->


 <!-- =========== START CAR SECTIONBAR ============ -->
<div class=' h-[650px] sm:h-[450px] lg:h-[350px] w-full dark:bg-gray-900 text-black dark:text-gray-50'>
 <div class="w-full h-full dark:bg-gray-800/40 flex items-center justify-center py-5 pt-10">
  <div class='  px-10 py-20  flex gap-2 flex-col'>
  <p class=' text-2xl text-center py-5 pt-10  font-bold '>Browse By Type    </p>
  <div class=' flex gap-2 items-center justify-center flex-wrap'>

    <?php 
    foreach ($carTypeData as $carItem) {
        echo '<a href="./page/ExploreCar.php" class="w-[130px] h-[90px] border-[3px] hover:shadow-lg dark:hover:shadow-lg dark:cursor-pointer dark:border flex flex-col items-center justify-center gap-2 rounded-lg">';
        echo '<p class="text-xl font-semibold">' . htmlspecialchars($carItem['name']) . '</p>';
        echo '<img src="' . htmlspecialchars($carItem['DarkIcon']) . '" alt="" width="30" height="30" />';
        echo '</a>';
    }
    ?>

  </div>
  </div>
 </div>
</div>
 <!-- =========== END CAR SECTIONBAR ============ -->

 <!-- =========== CAR SHOW  SECTIONBAR ============ -->
 <div class=' w-full  dark:bg-gray-900 text-black dark:text-white '>
 <div class=" flex  flex-col items-center justify-center dark:bg-gray-800/40 pb-20">
  <div class="p-10">
   <h5 class='text-5xl'>Most Searched Cars  </h5>
  </div>
  <div class="flex gap-2 items-center justify-center flex-wrap ">

<!-- =========== CAR DETALS  SECTIONBAR ============ -->
 <?php foreach($Cars as $car):    ?>
  <div class=' w-[300px] h-[370px]  overflow-hidden rounded border-[3px] dark:border-gray-600 dark:border-[3px] cursor-pointer'>
   <div class="w-full h-[180px] overflow-hidden object-none object-center">
            <img class=" object-contain object-center" src="<?php echo $car['image_url']; ?>"  />
   </div>
   <div class="">
        <h2 class='w-full h-[60px] text-lg  border-b-[2px] p-2 pt-3 font-semibold uppercase '><?php echo $car['model']; ?></h2>
   </div>
   <div class=" flex gap-4 w-full items-center justify-center">
    <div class="w-[50%] h-[70px] flex gap-1 flex-col items-center justify-center">
          <!-- < BsFuelPump size={18} /> -->
          <p class=' text-lg font-light'><?php echo $car['fuel_efficiency_highway']; ?></p>
    </div>

    <div class="w-[50%] h-[70px] p-2 flex gap-1 flex-col items-center justify-center">
          <!-- < IoMdSpeedometer size={18} /> -->
          <p class=' text-lg font-light'><?php echo $car['fuel_type']; ?></p>
    </div>
    </div>
    <div class="border-t-[2px] flex justify-between px-3" >
        <h5 class=' text-2xl font-medium  px-1 py-1'><?php echo $car['price']; ?></h5>
        <a href='./page/CarViews.php?id=<?php echo htmlspecialchars($car['id'])  ?>' class='text-1xl flex gap-2 items-center justify-center text-blue-500'>View Details</a>
        </div>
  </div>
<?php endforeach ?>




  </div>
  <a href="./page/ExploreCar.php" class=' flex items-center justify-center  gap-2 py-2 px-8 border-[3px]  mt-7  hover:border-blue-500 hover:bg-blue-500/50 transition-all duration-300'  >Explore Cars <GiCityCar size={35} /> </a>
 </div>
</div>

</body>
</html>