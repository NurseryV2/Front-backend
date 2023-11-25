<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.6/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php
    include("./navbar.php");
    include("./sidebar.php");
    include("db.php");

    $usersQuery = "SELECT * FROM users WHERE user_type = 1";
    $result = mysqli_query($conn, $usersQuery);

    if (mysqli_num_rows($result) > 0) {
        echo '<table class=" w-full max-w-[80vw][text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border-t border-b divide-y divide-gray-200 dark:divide-gray-700 mt-16 mx-auto">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left">Full Name</th>
                        <th scope="col" class="px-6 py-3 text-left">Email</th>
                        <th scope="col" class="px-6 py-3 text-left">Profile Active</th>
                        <th>block</th>
                        <th>deblock</th>
                    </tr>
                </thead>
                <tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">' . $row['fullname'] . '</td>
                    <td class="px-6 py-4">' . $row['email'] . '</td>
                    <td class="px-6 py-4">' . ($row['profile_active'] ? 'Active' : 'Inactive') . '</td>
                    
                    <td>
                    <button type="submit" name="block-client" class="mt-2 p-2.5 text-sm font-medium text-white bg-red-500 rounded-lg border border-red-600 focus:ring-4 focus:outline-none focus:ring-gray-200">
                    Block
                    </button>
                    </td>
                    <td>Deblock</td>
                </tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<p>No users found</p>';
    }

    mysqli_close($conn);
    ?>
</body>

</html>