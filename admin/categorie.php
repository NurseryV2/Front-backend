<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <title>Document</title>
</head>

<body class="bg-[#ECECF8]">
    <?php
   
   include("./navbar.php");
   include("./sidebar.php");
   include("db.php");
?>
    <div class="p-5 mt-14 sm:ml-64">
        <div class="relative overflow-x-auto  sm:rounded-lg">
            <div
                class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 dark:bg-gray-900">
                <div>
                    <button
                        class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        type="button">
                        Add Categorie
                    </button>
                </div>
                <label for="table-search" class="sr-only">Search</label>

                <form class="flex items-center">
                    <div class=" w-full">
                        <input type="text" id="simple-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search for a categorie" required>
                    </div>
                    <button type="submit"
                        class="p-2.5 ms-2 text-sm font-medium text-white bg-[#2F329F] rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </form>

            </div>
            <?php
// Fetch data from the database, including the count of plants for each category
$query = "SELECT categories.id, categories.name, COUNT(plants.id) AS plant_count
          FROM categories
          LEFT JOIN plants ON categories.id = plants.category_id
          GROUP BY categories.id, categories.name";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    echo '<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Category ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Number of Plants
                    </th>
                </tr>
            </thead>
            <tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    ' . $row['id'] . '
                </td>
                <td class="px-6 py-4">
                    ' . $row['name'] . '
                </td>
                <td class="px-6 py-4">
                    ' . $row['plant_count'] . '
                </td>
            </tr>';
    }

    echo '</tbody></table>';
} else {
    echo '<p>No data found</p>';
}

mysqli_close($conn);
?>
        </div>
    </div>
    </div>
</body>

</html>