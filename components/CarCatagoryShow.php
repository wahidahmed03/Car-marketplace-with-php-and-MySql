<?php
$carTypeData = json_decode(file_get_contents(__DIR__ . '/CartType.json'), true);
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
<div class=' h-[650px] sm:h-[450px] lg:h-[350px] w-full dark:bg-gray-900'>
        <div class="w-full h-full dark:bg-gray-800/40 flex items-center justify-center py-5 pt-10">

        <div class='  px-10 py-20  flex gap-2 flex-col'>
    <p class=' text-2xl text-center py-5 pt-10  font-bold '>Browse By Type    </p>
<div class=' flex gap-2 items-center justify-center flex-wrap'>

<?php 
foreach ($carTypeData as $carItem) {
    echo '<div class="w-[130px] h-[90px] border-[3px] hover:shadow-lg dark:hover:shadow-lg dark:cursor-pointer dark:border flex flex-col items-center justify-center gap-2 rounded-lg">';
    echo '<p class="text-xl font-semibold">' . htmlspecialchars($carItem['name']) . '</p>';
    echo '<img src="' . htmlspecialchars($carItem['LightIcon']) . '" alt="" width="30" height="30" />';
    echo '</div>';
}

?>





</div>
</div>



        </div>
    </div>

</body>
</html>
