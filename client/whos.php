<?php
// update_user_type.php
include("db.php");
// Start the session (add this at the beginning of your file)
session_start();
$email = $_SESSION['LOGINEMAIL'];
$select = $conn->prepare("SELECT * FROM users WHERE email = ?");
$select->bind_param("s", $email);
$select->execute();
$result = $select->get_result();
$row = $result->fetch_assoc();
$iduser = $row['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include("db.php");

    // Get selected role
    $role = $_POST["role"];
    echo $role;

    // Get the user_id dynamically from the session variable

    echo $iduser;

    $update_query = "UPDATE users SET user_type = ? WHERE user_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ii", $role, $iduser);
    $stmt->execute();

    if ($row['user_type'] == 1) {
        header("location: ./client/index.php");
        exit();
    }
    elseif($row['user_type']== 2) {
        header("location: ../admin/admin.php");
    }

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