<?php
include("db.php");

// Error reporting and logging
error_reporting(E_ALL);
ini_set('display_errors', 0);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        error_log("Error in statement preparation: " . $conn->error);
        die("Internal Server Error");
    }

    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        error_log("Error in statement execution: " . $stmt->error);
        die("Internal Server Error");
    }

    if ($result->num_rows > 0) {
        header("Location: index.php");
        exit;
    } else {
        echo "No user found with the provided email and password";
        header("Location: index.php");
    }

    // User does not exist or password is incorrect, redirect to login page
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="bg-grey-lighter min-h-screen flex flex-col">
        <div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">
            <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
                <h1 class="mb-8 text-3xl text-center">Log in</h1>
                <form method="post">
                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" name="email"
                        placeholder="Email" />

                    <input type="password" class="block border border-grey-light w-full p-3 rounded mb-4"
                        name="password" placeholder="Password" />

                    <button type="submit"
                        class="w-full text-center py-3 border rounded bg-green-400 text-black hover:bg-green-dark focus:outline-none my-1">Login
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>