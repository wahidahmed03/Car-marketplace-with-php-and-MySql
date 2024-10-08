<?php
$consrDetails = [
    "model" => "Ford Fiesta",
    "CarType" => "Subcompact Car",
    "engine" => "1.6L I4",
    "transmission" => "6-speed automatic",
    "horsepower" => "120 hp",
    "fuelEfficiency" => [
        "city" => "27 mpg",
        "highway" => "35 mpg"
    ],
    "seatingCapacity" => 5,
    "driveType" => "Front-Wheel Drive",
    "safetyRating" => "5-star",
    "Brand" => "Ford",
    "Condition" => "New",
    "Category" => "Compact",
    "Make" => "Ford",
    "Year" => "2024",
    "DriveType" => "FWD",
    "Transmission" => "Automatic",
    "FuelType" => "Gasoline",
    "EngineSize" => "1.6",
    "Cylinder" => "4",
    "Color" => "Blue",
    "Door" => "4",
    "price" => "20000",
    "Features" => [
        "tractionControl",
        "antiLockBraking",
        "driverAirBag",
        "powerDoorLocks",
        "vanityMirror",
        "bluetooth",
        "rearViewCamera",
        "cruiseControl"
    ],
    "image" => "https://firebasestorage.googleapis.com/v0/b/tubeguruji-startups.appspot.com/o/car-marketplace%2F1726261118773.jpeg?alt=media&token=4ba40ded-2785-423e-ae72-aba6a2b3a6a8"
];
?>
  <div class=' w-[300px] h-[370px]  overflow-hidden rounded border-[3px] dark:border-gray-600 dark:border-[3px] cursor-pointer'>
        <div class="w-full h-[180px] overflow-hidden object-none object-center">
            <img class=" object-contain object-center" src="<?php echo $consrDetails['image']; ?>"  />
        </div>
    <div class="">
        <h2 class='w-full h-[60px] text-2xl  border-b-[2px] p-2 pt-3 font-semibold uppercase '><?php echo $consrDetails['model']; ?></h2>
    </div>
    <div class=" flex gap-4 w-full items-center justify-center">
        <div class="w-[70px] h-[70px] flex gap-1 flex-col items-center justify-center">
          <!-- < BsFuelPump size={18} /> -->
          <p class=' text-lg font-light'><?php echo $consrDetails['fuelEfficiency']['highway']; ?></p>
        </div>

        <div class="w-[70px] h-[70px] p-2 flex gap-1 flex-col items-center justify-center">
          <!-- < IoMdSpeedometer size={18} /> -->
          <p class=' text-lg font-light'><?php echo $consrDetails['FuelType']; ?></p>
        </div>

        <div class="w-[70px] h-[70px] p-2 flex gap-1 flex-col items-center justify-center">
          <!-- < TbManualGearbox  size={18} /> -->
          <p class=' text-lg font-light'><?php echo $consrDetails['Transmission']; ?></p>
        </div>
    </div>
    <div class="border-t-[2px] flex justify-between px-3" >
        <h5 class=' text-2xl font-medium  px-1 py-1'><?php echo $consrDetails['price']; ?></h5>
        <Link href={'/'} class=' text-1xl flex gap-2 items-center justify-center text-blue-500' >View Details <TbExternalLink size={20} /> </Link>
    </div>
    </div>






