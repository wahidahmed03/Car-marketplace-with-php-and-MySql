<?php
session_start();
include("./db.php");


// Get filter values from the form
$make = isset($_POST['make']) ? $_POST['make'] : '';
$model = isset($_POST['model']) ? $_POST['model'] : '';
$year = isset($_POST['year']) ? $_POST['year'] : '';
$priceRange = isset($_POST['priceRange']) ? $_POST['priceRange'] : 25000000;
$bodyType = isset($_POST['bodyType']) ? $_POST['bodyType'] : '';

$query = "SELECT * FROM cars";
$params = [];
$types = '';

$conditions = [];

if (!empty($make)) {
    $conditions[] = "brand = ?";
    $params[] = $make;
    $types .= 's';
}

if (!empty($model)) {
    $conditions[] = "model LIKE ?";
    $params[] = "%$model%";
    $types .= 's';
}

if (!empty($year)) {
    $conditions[] = "relese_year = ?";
    $params[] = $year;
    $types .= 'i';
}

if (!empty($bodyType)) {
    $conditions[] = "car_type = ?";
    $params[] = $bodyType;
    $types .= 's';
}

if (!empty($priceRange)) {
    $conditions[] = "price <= ?";
    $params[] = $priceRange;
    $types .= 'i';
}

if (!empty($conditions)) {
    $query .= " WHERE " . implode(' AND ', $conditions);
}

$query .= " ORDER BY id";

$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

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
  <title>Car Filter</title>
</head>
<body>
  <?php include("./../Header.php") ?>

  <div class="flex bg-gray-200 dark:bg-gray-900 text-black dark:text-gray-400 ">
    <div class="w-[374px] h-screen bg-black hidden sm:block">
      <div class="fixed bg-gray-100 dark:bg-slate-800 w-[300px] h-[101vh] py-16 px-5 -mt-14 -z-0">
        <form method="POST" action="">
          <div class="w-64 bg-gray-100 dark:bg-gray-800 p-2 rounded-md">
            <h2 class="text-lg font-semibold mb-4">Filter Cars</h2>

            <!-- Make -->
            <div class="mb-4">
              <label class="block mb-1 text-sm font-medium">Make</label>
              <select name="make" class="w-full px-2 py-1 border rounded-md bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-50">
                <option value="">Select Make</option>
                <option value="Toyota" <?php if ($make == 'Toyota') echo 'selected'; ?>>Toyota</option>
                <option value="Honda" <?php if ($make == 'Honda') echo 'selected'; ?>>Honda</option>
                <option value="Ford" <?php if ($make == 'Ford') echo 'selected'; ?>>Ford</option>
                <option value="Tesla" <?php if ($make == 'Tesla') echo 'selected'; ?>>Tesla</option>
              </select>
            </div>

            <!-- Model -->
            <div class="mb-4">
              <label class="block mb-1 text-sm font-medium">Model</label>
              <input type="text" name="model" value="<?php echo htmlspecialchars($model); ?>" class="w-full px-2 py-1 border rounded-md bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-50" placeholder="Enter Model"/>
            </div>

            <!-- Year -->
            <div class="mb-4">
              <label class="block mb-1 text-sm font-medium">Year</label>
              <select name="year" class="w-full px-2 py-1 border rounded-md bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-50">
                <option value="">Select Year</option>
                <?php
                for ($i = 0; $i < 24; $i++) {
                    $year_option = 2024 - $i;
                    echo "<option value=\"$year_option\"";
                    if ($year == $year_option) echo ' selected';
                    echo ">$year_option</option>";
                }
                ?>
              </select>
            </div>

            <!-- Price Range -->
            <div class="mb-4">
              <label class="block mb-1 text-sm font-medium">Price Range</label>
              <input type="range" name="priceRange" min="0" max="50000000" value="<?php echo $priceRange; ?>" class="w-full" oninput="document.getElementById('priceValue').innerText = this.value" />
              <div class="flex justify-between text-sm">
                <span>$0</span>
                <span id="priceValue"><?php echo "$" . $priceRange; ?></span>
              </div>
            </div>

            <!-- Body Type -->
            <div class="mb-4">
              <label class="block mb-1 text-sm font-medium">Body Type</label>
              <select name="bodyType" class="w-full px-2 py-1 border rounded-md bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-50">
                <option value="">Select Body Type</option>
                <option value="Sedan" <?php if ($bodyType == 'Sedan') echo 'selected'; ?>>Sedan</option>
                <option value="SUV" <?php if ($bodyType == 'SUV') echo 'selected'; ?>>SUV</option>
                <option value="Truck" <?php if ($bodyType == 'Truck') echo 'selected'; ?>>Truck</option>
                <option value="Coupe" <?php if ($bodyType == 'Coupe') echo 'selected'; ?>>Coupe</option>
              </select>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
              Apply Filters
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="w-full min-h-screen bg-slate-300 dark:bg-gray-900">
      <div class="">
        <div class="">
          <div class="w-full bg-gray-100 shadow-lg">
            <img class='w-full h-[150px] object-center object-cover' src="https://d9s1543upwp3n.cloudfront.net/wp-content/uploads/2023/04/AI-generated-car-design-scaled.jpeg" alt="" />
          </div>
          <div class="relative ">
            <div class="py-5">

              <div class="flex gap-2 items-center justify-center flex-wrap">
                <?php foreach ($Cars as $car): ?>
                <div class='w-[300px] h-[370px] overflow-hidden rounded border-[3px] dark:border-gray-600 cursor-pointer'>
                  <div class="w-full h-[180px] overflow-hidden object-none object-center">
                    <img class="object-contain object-center" src="<?php echo htmlspecialchars($car['image_url']); ?>" />
                  </div>
                  <div class="">
                    <h2 class='w-full h-[60px] text-lg border-b-[2px] p-2 pt-3 font-semibold uppercase'>
                      <?php echo htmlspecialchars($car['model']); ?>
                    </h2>
                  </div>
                  <div class="flex gap-4 w-full items-center justify-center">
                    <div class="w-[90px] h-[70px] flex gap-1 text-[12px] flex-col items-center justify-center">
                      <p class='text-xs p-1 font-light'><?php echo htmlspecialchars($car['fuel_efficiency_city']); ?></p>
                    </div>
                    <div class="w-[50px] h-[70px] p-2 flex gap-1 flex-col items-center justify-center">
                      <p class='text-xs font-light'><?php echo htmlspecialchars($car['fuel_type']); ?></p>
                    </div>
                    <div class="w-[130px] h-[70px] p-2 flex gap-1 flex-col items-center justify-center">
                      <p class='text-xs font-light'><?php echo htmlspecialchars($car['transmission']); ?></p>
                    </div>
                  </div>
                  <div class="border-t-[2px] flex justify-between px-3">
                    <h5 class='text-2xl font-medium px-1 py-1'>$<?php echo htmlspecialchars($car['price']); ?></h5>
                    <a href='./CarViews.php?id=<?php echo htmlspecialchars($car['id'])  ?>' class='text-1xl flex gap-2 items-center justify-center text-blue-500'>View Details</a>
                    </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</body>
</html>
