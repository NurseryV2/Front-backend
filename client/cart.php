<?php
include("db.php");
session_start();
$email = $_SESSION['LOGINEMAIL'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['increase'])) {
        $plantid = $_POST['plantId'];
    } elseif (isset($_POST['decrease'])) {
        $plantid = $_POST['plantId'];
    } elseif (isset($_POST['remove'])) {
        $plantid = $_POST['plantId'];
        $removeQuery = $conn->prepare("DELETE FROM basket WHERE user_id = ? ");
        $removeQuery->bind_param("i", $userid);
        $removeQuery->execute();
        $removeQuery->close();
    } elseif (isset($_POST['checkout'])) {
        // Handle checkout logic (delete everything from the basket)
        $checkoutQuery = $conn->prepare("DELETE FROM basket WHERE user_id = ?");
        $checkoutQuery->bind_param("i", $userid);
        $checkoutQuery->execute();
        $checkoutQuery->close();
    }
}

$userQuery = "SELECT user_id FROM users WHERE email = '$email'";
$userResult = mysqli_query($conn, $userQuery);

if ($userResult) {
    $row = mysqli_fetch_assoc($userResult);
    $userid = $row['user_id'];

    $basketQuery = $conn->prepare("SELECT plant_id, COUNT(*) as quantity FROM basket WHERE user_id = ? GROUP BY plant_id");
    $basketQuery->bind_param("i", $userid);
    $basketQuery->execute();
    $results = $basketQuery->get_result();

    while ($row = $results->fetch_assoc()) {
        $plantid = $row['plant_id'];
        $quantity = $row['quantity'];

        // Retrieve plant information from the 'plants' table (adjust the column names as needed)
        $plantInfoQuery = "SELECT * FROM plants WHERE id = $plantid";
        $plantInfoResult = mysqli_query($conn, $plantInfoQuery);

        if ($plantInfoResult) {
            $plantInfo = mysqli_fetch_assoc($plantInfoResult);
            // Display the plant card with image on the left and quantity
            echo '<form method="post" action="">
                    <div class="flex max-w-2xl bg-white shadow-md rounded-lg overflow-hidden my-4 mx-4">
                        <div class="w-1/3">
                            <img class="w-full h-auto object-cover" src="' . $plantInfo['image_url'] . '" alt="' . $plantInfo['name'] . '">
                        </div>
                        <div class="w-2/3 p-4">
                            <div class="flex justify-between items-center mb-2">
                                <div class="font-bold text-xl">' . $plantInfo['name'] . '</div>
                                <div class="flex items-center">
                                    <button class="text-gray-500 hover:text-gray-700" type="submit" name="decrease" value="1"><input type="hidden" name="plantId" value="' . $plantid . '">-</button>
                                    <span class="mx-2">' . $quantity . '</span>
                                    <button class="text-gray-500 hover:text-gray-700" type="submit" name="increase" value="1"><input type="hidden" name="plantId" value="' . $plantid . '">+</button>
                                </div>
                                <button class="text-red-500 hover:text-red-700 cursor-pointer" type="submit" name="remove" value="1"><input type="hidden" name="plantId" value="' . $plantid . '">&times;</button>
                            </div>
                            <p class="text-gray-700 text-base">' . $plantInfo['description'] . '</p>
                        </div>
                    </div>
                </form>';
        }
    }

    echo '<form method="post" action="">
            <div class="flex justify-center mt-4">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" type="submit" name="checkout" value="checkout">Checkout</button>
            </div>
          </form>';

    $basketQuery->close();
} else {
    echo "Error retrieving user information: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
>


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

</body>

</html>