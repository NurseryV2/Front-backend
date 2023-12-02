<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.6/dist/full.min.css" rel="stylesheet" type="text/css" />
    <title>Document</title>
</head>

<body class="bg-[#ECECF8]">
    <?php
    include("./navbar.php");
    include("./sidebar.php");
    include("db.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add-category"])) {
        $categoryName = mysqli_real_escape_string($conn, $_POST["category-name"]);
        $insertQuery = "INSERT INTO categories (name) VALUES ('$categoryName')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            echo '<script>alert("Category added successfully!");</script>';
        } else {
            echo '<script>alert("Error adding category: ' . mysqli_error($conn) . '");</script>';
        }
    }

    // Handle deleting a plant
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-plant"])) {
        $plantIdToDelete = mysqli_real_escape_string($conn, $_POST["plant_id"]);
        $categoryId = mysqli_real_escape_string($conn, $_POST["category_id"]);

        // Perform the deletion
        $deletePlantQuery = "DELETE FROM plants WHERE id = '$plantIdToDelete' AND category_id = '$categoryId'";
        $deletePlantResult = mysqli_query($conn, $deletePlantQuery);
        if ($deletePlantResult) {
            echo '<script>alert("Plant deleted successfully!");</script>';
        } else {
            echo '<script>alert("Error deleting plant: ' . mysqli_error($conn) . '");</script>';
        }
    }

    // Handle deleting a category
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-category"])) {
        $categoryIdToDelete = mysqli_real_escape_string($conn, $_POST["category_id"]);

        // Delete plants associated with the category
        $deletePlantsQuery = "DELETE FROM plants WHERE category_id = '$categoryIdToDelete'";
        $deletePlantsResult = mysqli_query($conn, $deletePlantsQuery);

        if ($deletePlantsResult) {
            // Now,  let's delete the category itself
            $deleteCategoryQuery = "DELETE FROM categories WHERE id = '$categoryIdToDelete'";
            $deleteCategoryResult = mysqli_query($conn, $deleteCategoryQuery);

            if ($deleteCategoryResult) {
                echo '<script>alert("Category and associated plants deleted successfully!");</script>';
            } else {
                echo '<script>alert("Error deleting category: ' . mysqli_error($conn) . '");</script>';
            }
        } else {
            echo '<script>alert("Error deleting plants associated with the category: ' . mysqli_error($conn) . '");</script>';
        }
    }

    // Handle updating a category
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update-category"])) {
        $categoryIdToUpdate = $_POST["category_id"];
        $updatedCategoryName = mysqli_real_escape_string($conn, $_POST["update-category-name"]);

        // Perform the update
        $updateCategoryQuery = "UPDATE categories SET name = ? WHERE id = ?";
        $updateCategoryResult = mysqli_prepare($conn, $updateCategoryQuery);
        mysqli_stmt_bind_param($updateCategoryResult,"si",$updatedCategoryName,$categoryIdToUpdate);
        $updatedResult=mysqli_stmt_execute($updateCategoryResult);

        if ($updatedResult) {
            echo '<script>alert("Category updated successfully!");</script>';
        } else {
            echo '<script>alert("Error updating category: ' . mysqli_error($conn) . '");</script>';
        }
    }

    ?>
    <div class="p-5 mt-14 sm:ml-64">
        <div class="relative overflow-x-auto sm:rounded-lg">
            <div
                class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 dark:bg-gray-900">
                <div>
                    <button onclick="toggleFormVisibility()"
                        class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        type="button">
                        Add Category
                    </button>
                </div>
                <label for="table-search" class="sr-only">Search</label>

                <form method="post" action="./search_category.php" class="flex items-center">
                    <div class=" w-full">
                        <input type="text" id="simple-search" name="searchTerm"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search for a category" required>
                    </div>
                    <button type="submit"
                        class="p-2.5 ms-2 text-sm font-medium text-white bg-[#2f9f5c] rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
                                    Category Name
                                </th>
                                <th>See Plants</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                    
                        </thead>
                        <tbody>';
                while ($row = mysqli_fetch_assoc($result)) {


                    echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">' . $row['name'] . '</td>
                                <td>
                                    <button class="btn btn-success" onclick="openModal(\'modal_' . $row['id'] . '\')">Open</button>
                                    <dialog id="modal_' . $row['id'] . '" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="closeModal(' . $row['id'] . ')">✕</button>
                                            </form>
                                            <h3 class="font-bold text-lg text-center mx-auto">Plants in Category: ' . $row['name'] . '</h3>
                                            <a href="./add.php">
                                            <button type="submit" class="mt-2 p-2.5 text-sm font-medium text-white rounded-lg border border-green-600 bg-[#2f9f5c] focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-green-500"
                                            name="add-plant">
                                            Add Plant
                                        </button>
                                            </a>
                                         
                                            <table id="plantTable_' . $row['id'] . '" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3">Plant Name</th>
                                                        <th>Picture</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';

                    // Fetch plants data from the db with the corresponding category id
                    $categoryId = $row['id'];
                    $plantQuery = "SELECT * FROM plants WHERE category_id = $categoryId";
                    $plantResult = mysqli_query($conn, $plantQuery);

                    while ($plantRow = mysqli_fetch_assoc($plantResult)) {
                        echo '<tr>
                                                        <td>' . $plantRow['name'] . '</td>
                                                        <td>
                                                            <img src="' . $plantRow['image_url'] . '" alt="Product" class="h-12 w-28 object-cover my-2" />
                                                        </td>
                                                        <td>
                                                        <form method="post" action="">
            <input type="hidden" name="plant_id" value="' . $plantRow['id'] . '">
            <input type="hidden" name="category_id" value="' . $row['id'] . '">
            <button type="submit" name="delete-plant"
                class="mt-2 p-2.5 text-sm font-medium text-white bg-red-500 rounded-lg border border-red-600 focus:ring-4 focus:outline-none focus:ring-gray-200">
                Delete
            </button>
            </form>

            </td>
            </tr>';
            }

            echo '<tr>
                <td colspan="3">

                </td>
            </tr>';

            echo '</tbody>
            </table>
        </div>
        </dialog>
        </td>
        <td class="border px-2 py-4">

            <form method="post" action="">
                <input type="hidden" name="category_id" value="' . $row['id'] . '">
                <label for="update-category-name"></label>
                <input type="text" id="update-category-name" name="update-category-name" value="' . $row['name'] . '"
                    required>
                <button type="submit" name="update-category"
                    class="mt-2 p-2.5 text-sm font-medium bg-black text-white  rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Edit
                </button>
            </form>

        </td>
        <td>
            <form method="post" action=3">
                                              <input type="hidden" name="category_id" value="' . $row['id'] . '">
                                                        <button type="submit" name="delete-category" class="mt-2 p-2.5 text-sm font-medium text-white bg-red-500 rounded-lg border border-red-600 focus:ring-4 focus:outline-none focus:ring-gray-200">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>' ; } echo '</tbody></table>' ; } else { echo '<p>No data found</p>' ;
                } mysqli_close($conn); ?>
            <div id="addCategoryForm" class="mt-4 hidden">
                <h2 class="text-xl font-semibold mb-2">Add New Category</h2>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <label for="category-name" class="sr-only">Category Name</label>
                    <input type="text" id="category-name" name="category-name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Enter category name" required>
                    <button type="submit"
                        class="mt-2 p-2.5 text-sm font-medium text-white bg-[#2F329F] rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        name="add-category">
                        Add Category
                    </button>
                </form>
            </div>

        </div>
    </div>


    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("simple-search");

        searchInput.addEventListener("input", function() {
            const searchTerm = searchInput.value.trim();

            if (searchTerm.length > 0) {
                // Make an AJAX request to the search_category.php file
                fetch("search_category.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: `searchTerm=${encodeURIComponent(searchTerm)}`,
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Update the UI with the search results
                        updateCategoryList(data);
                    })
                    .catch(error => {
                        console.error("Error fetching data:", error);
                    });
            }
        });

        function updateCategoryList(categories) {
            const categoryListContainer = document.getElementById("category-list");
            categoryListContainer.innerHTML = "";
            categories.forEach(category => {
                const listItem = document.createElement("li");
                listItem.textContent = category.name;
                categoryListContainer.appendChild(listItem);
            });
        }
    });




    function openModal(modalId) {
        var modal = document.getElementById(modalId);
        if (modal) {
            modal.showModal();
        }
    }

    function toggleFormVisibility() {
        var addCategoryForm = document.getElementById('addCategoryForm');
        addCategoryForm.style.display = (addCategoryForm.style.display == 'none' || addCategoryForm.style.display ==
            '') ? 'block' : 'none';
    }

    function toggleFormsVisibility() {
        var addCategoryForm = document.getElementById('updateCategory');
        addCategoryForm.style.display = (addCategoryForm.style.display == 'none' || addCategoryForm.style.display ==
            '') ? 'block' : 'none';
    }
    </script>

</body>




</html>