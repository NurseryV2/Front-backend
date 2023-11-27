<?php
include("./navbar.php");
include("./sidebar.php");
include("db.php");

// Check if plantId is provided
if (isset($_GET['plantId'])) {
    $plantId = $_GET['plantId'];

    // Fetch plant details based on plantId
    $plantQuery = "SELECT * FROM plants WHERE id = $plantId";
    $plantResult = mysqli_query($conn, $plantQuery);

    if ($plantResult) {
        $plantRow = mysqli_fetch_assoc($plantResult);

        // Handle form submission for updating the plant
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update-plant"])) {
            $newCategoryName = $_POST["category-name"];

            // Update the plant details in the database
            $updateQuery = "UPDATE plants SET category_name = '$newCategoryName' WHERE id = $plantId";
            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
                echo "Plant updated successfully!";
            } else {
                echo "Error updating plant: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Plant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.6/dist/full.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <h2>Update Plant</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?plantId=' . $plantId; ?>">
        <input type="hidden" name="plant_id" value="<?php echo $plantRow['id']; ?>">

        <!-- Display the previous value of the category -->
        <label for="category-name">Category Name:</label>
        <input type="text" id="category-name" name="category-name" value="<?php echo $plantRow['category_name']; ?>"
            required>

        <!-- Add other input fields for updating other plant details -->

        <button type="submit" name="update-plant">Update Plant</button>
    </form>
</body>

</html>