<?php
include("db.php");
session_start();
$email = $_SESSION['LOGINEMAIL'];
$userQuery = "SELECT user_id FROM users WHERE email = '$email'";
$userResult = mysqli_query($conn, $userQuery);
$row = mysqli_fetch_assoc($userResult);
$userid = $row['user_id'];

if (isset($_POST['checkout'])) {
    if ($userResult) {
        $basketQuery = $conn->prepare("SELECT plant_id, COUNT(*) as quantity FROM basket WHERE user_id = ? GROUP BY plant_id");
        $basketQuery->bind_param("i", $userid);
        $basketQuery->execute();
        $results = $basketQuery->get_result();

        while ($row = $results->fetch_assoc()) {
            $plantid = $row['plant_id'];

            $commandQuery = $conn->prepare("INSERT INTO commands(user_id,plant_id) VALUES(?,?)");
            $commandQuery->bind_param("ii", $userid, $plantid);
            $commandQuery->execute();
        }

        $delete_basket = $conn->prepare("DELETE FROM basket WHERE user_id = ?");
        $delete_basket->bind_param("i", $userid);
        $delete_basket->execute();
    }
}

// Handle remove action
if (isset($_POST['remove'])) {
    $plantidToRemove = $_POST['plantId'];
    
    // Use prepared statement to delete the plant from the basket
    $deletePlantQuery = $conn->prepare("DELETE FROM basket WHERE user_id = ? AND plant_id = ?");
    $deletePlantQuery->bind_param("ii", $userid, $plantidToRemove);
    $deletePlantQuery->execute();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.9/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>
</head>

<body>

    <?php
    $select = "SELECT * 
    FROM basket
    JOIN plants ON plants.id = basket.plant_id
    WHERE user_id = $userid";
    $query = mysqli_query($conn, $select);

    while ($plantInfo = mysqli_fetch_assoc($query)) {
    ?>
    <form method="post" action="">
        <div class="flex max-w-2xl bg-white shadow-md rounded-lg overflow-hidden my-4 mx-4 relative">
            <button class="text-red-500 hover:text-red-700 cursor-pointer absolute top-2 right-2" type="submit"
                name="remove" value="1">
                <input type="hidden" name="plantId" value="<?php echo $plantInfo['plant_id'] ?>">&times;
            </button>

            <div class="w-1/3">
                <img class="w-full h-auto object-cover" src="<?php echo $plantInfo['image_url'] ?>"
                    alt="<?php echo $plantInfo['name'] ?>">
            </div>
            <div class="w-2/3 p-4">
                <div class="flex justify-between items-center mb-2">
                    <div class="font-bold text-xl">
                        <?php echo $plantInfo['name'] ?>
                        <div class="flex items-center">
                            <button class="text-gray-500 hover:text-gray-700" type="submit" name="decrease" value="1">
                                <input type="hidden" name="plantId" value="<?php echo $plantInfo['plant_id'] ?>">-
                            </button>
                            <span class="mx-2">
                                <?php echo "quantity" ?>
                            </span>
                            <button class="text-gray-500 hover:text-gray-700" type="submit" name="increase" value="1">
                                <input type="hidden" name="plantId" value="<?php echo $plantInfo['plant_id'] ?>">+
                            </button>
                        </div>
                    </div>
                    <p class="text-gray-700 text-base">
                        <?php echo $plantInfo['price'] ?>
                    </p>
                </div>
            </div>
        </div>
    </form>
    <?php
    }
    ?>

    <form method="post" action="">
        <div class="flex justify-center mt-4">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" type="submit"
                name="checkout" value="checkout">Checkout</button>
        </div>
    </form>

</body>

</html>