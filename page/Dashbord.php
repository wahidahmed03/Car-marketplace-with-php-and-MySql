<?php 
include("./db.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: Index.php");
    exit();
}

$User_id = $_SESSION['user_id'];

// Fetch User Data
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("s", $User_id);
$stmt->execute();
$User_Result = $stmt->get_result();
$User_Data = $User_Result->fetch_assoc();
$stmt->close();

// Fetch Car Data
$stmt = $conn->prepare('SELECT * FROM cars WHERE CarLidtUserId = ?');
$stmt->bind_param("s", $User_id);
$stmt->execute();
$car_result = $stmt->get_result();
$Cars = $car_result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
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
<?php include('./../Header.php') ?>

<div class="flex bg-gray-200 dark:bg-gray-900 text-black dark:text-gray-400">
    <div class="w-[374px] h-screen bg-black hidden sm:block">
        <div class="fixed bg-gray-100 dark:bg-slate-800 w-[300px] h-[101vh] py-16 px-5 -mt-14 -z-0">
            <div class="w-full h-full flex flex-col items-center justify-center">
                <div class="flex flex-col items-center justify-center gap-5">
                    <div class="w-[180px] h-[180px] bg-red-500 rounded-full">
                      <img class="w-[180px] h-[180px] rounded-full object-cover " src="<?php  echo htmlspecialchars($User_Data['profile_image']); ?>" alt="">
                    </div>
                    <div class="font-semibold">
                        <p class='text-3xl'><?php echo htmlspecialchars($User_Data['username']); ?></p>
                        <p><?php echo htmlspecialchars($User_Data['email']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="w-full min-h-screen bg-slate-300 dark:bg-gray-900">
        <div class="">
            <div class="">
                <div class="w-full bg-gray-100 shadow-lg">
                    <img class='w-full h-[150px] object-center object-cover' src="https://d9s1543upwp3n.cloudfront.net/wp-content/uploads/2023/04/AI-generated-car-design-scaled.jpeg" alt=""/>
                </div>

                <div class="py-5">
                    <div class="flex gap-2 items-center justify-center flex-wrap">
                        <?php foreach ($Cars as $car): ?>
                        <div class='w-[300px] h-[370px] overflow-hidden rounded border-[3px] dark:border-gray-600 cursor-pointer'>
                            <div class="w-full h-[180px] overflow-hidden object-none object-center">
                                <img class="object-contain object-center" src="<?php  echo htmlspecialchars($car['image_url']); ?>" />
                            </div>
                            <div class="">
                                <h2 class='w-full h-[60px] text-lg border-b-[2px] p-2 pt-3 font-semibold uppercase'>
                                    <?php echo htmlspecialchars($car['model']); ?>
                                </h2>
                            </div>
                            <div class="flex gap-4 w-full items-center justify-center">
                                <div class="w-[90px] h-[70px] flex gap-1 text-[12px] flex-col items-center justify-center">
                                    <p class='text-xs p-1 font-light'><?php  echo htmlspecialchars($car['fuel_efficiency_city']); ?></p>
                                </div>
                                <div class="w-[50px] h-[70px] p-2 flex gap-1 flex-col items-center justify-center">
                                    <p class='text-xs font-light'><?php echo htmlspecialchars($car['fuel_type']); ?></p>
                                </div>
                                <div class="w-[130px] h-[70px] p-2 flex gap-1 flex-col items-center justify-center">
                                    <p class='text-xs font-light'><?php echo htmlspecialchars($car['transmission']); ?></p>
                                </div>
                            </div>
                            <div class="border-t-[2px] flex justify-between px-3">
                                <h5 class='text-2xl font-medium px-1 py-1'>$ <?php echo htmlspecialchars($car['price']); ?></h5>
                                <a href='./CarViews.php?id=<?php echo htmlspecialchars($car['id'])  ?>' class='text-1xl flex gap-2 items-center justify-center text-blue-500'>View Details</a>
                            </div>
                        </div>
                        <?php endforeach; ?>



                        <div class='w-[300px] h-[370px] hover:bg-blue-600/60 overflow-hidden rounded border-[3px] dark:border-gray-600 cursor-pointer bg-blue-500/50 flex items-center justify-center'>
                         <a href="./Car.php" class="text-center text-8xl flex gap-1 flex-col">
                            +
                            <p class="text-lg">ADD CAR LISTING</p>
                         </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
