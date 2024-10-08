<?php
include('./db.php');

session_start();
$Car_Lidt_UserId = $_SESSION['user_id'];
$Car_List_UserMailId = $_SESSION['mailId'];

if(!$Car_Lidt_UserId || !$Car_List_UserMailId ){
    header('Location: index.php'); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = $_POST['model'];
    $carType = $_POST['carType'];
    $engine = $_POST['engine'];
    $transmission = $_POST['transmission'];
    $horsepower = $_POST['horsepower'];
    $fuelEfficiencyCity = $_POST['fuel_efficiency_city'];
    $fuelEfficiencyHighway = $_POST['fuel_efficiency_highway'];
    $seatingCapacity = $_POST['seating_capacity'];
    $driveType = $_POST['drive_type'];
    $safetyRating = $_POST['safety_rating'];
    $brand = $_POST['brand'];
    $condition = $_POST['condition'];
    $make = $_POST['make'];
    $year = $_POST['year'];
    $fuelType = $_POST['fuel_type'];
    $engineSize = $_POST['engine_size'];
    $cylinder = $_POST['cylinder'];
    $color = $_POST['color'];
    $door = $_POST['door'];
    $price = $_POST['price'];
    $features = $_POST['features'];
    $image = $_POST['image'];

  
     $sql = "INSERT INTO cars (CarLidtUserId, CarListUserMailId,model, car_type, engine, transmission, horsepower, fuel_efficiency_city, fuel_efficiency_highway, seating_capacity, drive_type, safety_rating, brand, car_condition, car_make, relese_year, fuel_type, engine_size, cylinder, color, door, price, features, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssssssssssss",$Car_Lidt_UserId,$Car_List_UserMailId, $model, $carType, $engine, $transmission, $horsepower, $fuelEfficiencyCity, $fuelEfficiencyHighway, $seatingCapacity, $driveType, $safetyRating, $brand, $condition, $make, $year, $fuelType, $engineSize, $cylinder, $color, $door, $price, $featuresJson, $image);

    if ($stmt->execute()) {
        header('Location: index.php'); 
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car Listing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
<body class="bg-gray-100 dark:bg-slate-900 text-gray-950 dark:text-gray-100">
    <?php include("./../Header.php") ?>
    <div class="w-full py-10 px-1 md:px-10 lg:px-20">
        <div class="mx-auto bg-white dark:bg-gray-800/40 p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-6">Add Car Listing</h1>
            <form action="Car.php" method="POST">
                <div class="mb-4">
                    <label class="block">Model</label>
                    <input type="text" name="model" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Car Type</label>
                    <input type="text" name="carType" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Engine</label>
                    <input type="text" name="engine" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Transmission</label>
                    <input type="text" name="transmission" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Horsepower</label>
                    <input type="text" name="horsepower" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Fuel Efficiency (City)</label>
                    <input type="text" name="fuel_efficiency_city" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Fuel Efficiency (Highway)</label>
                    <input type="text" name="fuel_efficiency_highway" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Seating Capacity</label>
                    <input type="number" name="seating_capacity" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Drive Type</label>
                    <input type="text" name="drive_type" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Safety Rating</label>
                    <input type="text" name="safety_rating" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Brand</label>
                    <input type="text" name="brand" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Condition</label>
                    <select name="condition" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                        <option value="New">New</option>
                        <option value="Used">Used</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Make</label>
                    <input type="text" name="make" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Year</label>
                    <input type="number" name="year" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Fuel Type</label>
                    <input type="text" name="fuel_type" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Engine Size</label>
                    <input type="text" name="engine_size" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Cylinder</label>
                    <input type="text" name="cylinder" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Color</label>
                    <input type="text" name="color" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Door</label>
                    <input type="text" name="door" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Price</label>
                    <input type="number" name="price" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Features (comma separated)</label>
                    <input type="text" name="features" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="mb-4">
                    <label class="block">Image URL</label>
                    <input type="text" name="image" required class="w-full px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-800">
                </div>

                <div class="col-span-2">
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                        Add Car
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
