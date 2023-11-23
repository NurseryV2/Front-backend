<?php
// update_user_type.php

// Start the session (add this at the beginning of your file)
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include("db.php");

    // Get selected role
    $role = $_POST["role"];

    // Get the user_id dynamically from the session variable
    $user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

    // Check if the user_id is set and not null
    if (!$user_id) {
        die("User not found. Please make sure you are logged in.");
    }

    // Check if the user has selected a role
    if (empty($role)) {
        die("Please select a role.");
    }

    // Use prepared statement to prevent SQL injection
    $update_query = "UPDATE users SET user_type = ? WHERE user_id = ?";
    $stmt = $conn->prepare($update_query);

    if ($stmt === false) {
        die("Error in statement preparation: " . $conn->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("ii", $role, $user_id);
    $stmt->execute();

    // Check for errors during execution
    if ($stmt->errno) {
        die("Error executing statement: " . $stmt->error);
    }

    // Check if any rows were affected
    if ($stmt->affected_rows > 0) {
        echo "User type updated successfully!";
    } else {
        echo "No changes made or user not found.";
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
    exit; // Important to stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Type</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="bg-grey-lighter min-h-screen flex flex-col">
        <div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">
            <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
                <h1 class="mb-8 text-3xl text-center">Select User Type</h1>

                <!-- Use a single form with hidden input for role -->
                <form method="post">
                    <input type="hidden" name="role" value="1"> <!-- Use the role ID from the role table -->
                    <button type="submit"
                        class="w-full text-center py-3 border rounded bg-green-400 text-black hover:bg-green-dark focus:outline-none my-1">
                        Client
                    </button>
                </form>

                <form method="post">
                    <input type="hidden" name="role" value="2"> <!-- Use the role ID from the role table -->
                    <button type="submit"
                        class="w-full text-center py-3 border rounded bg-green-400 text-black hover:bg-green-dark focus:outline-none my-1">
                        Admin
                    </button>
                </form>

                <form method="post">
                    <input type="hidden" name="role" value="3"> <!-- Use the role ID from the role table -->
                    <button type="submit"
                        class="w-full text-center py-3 border rounded bg-green-400 text-black hover:bg-green-dark focus:outline-none my-1">
                        Super Admin
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>