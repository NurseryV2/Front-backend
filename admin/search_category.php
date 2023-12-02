<?php
include("db.php");
include("sidebar.php");
include("navbar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["searchTerm"])) {
    $searchTerm = mysqli_real_escape_string($conn, $_POST["searchTerm"]);

    $query = "SELECT * FROM categories WHERE name LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $query);

    $categories = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Search</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.6/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="p-5 mt-14 sm:ml-64">
        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <!-- Include all columns in the table header -->
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Category Name</th>
                        <!-- Add other columns as needed -->
                        <th>See Plants</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) : ?>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <!-- Include all columns in each row -->
                        <td class="px-6 py-4"><?php echo $category['id']; ?></td>
                        <td class="px-6 py-4"><?php echo $category['name']; ?></td>
                        <td>
                            <button class="btn btn-success"
                                onclick="openModal('modal_<?php echo $category['id']; ?>')">Open</button>
                            <dialog id="modal_<?php echo $category['id']; ?>" class="modal">
                                <!-- Include all columns in the modal content -->
                                <div class="modal-box">
                                    <form method="dialog">
                                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
                                            onclick="closeModal(<?php echo $category['id']; ?>)">✕</button>
                                    </form>
                                    <h3 class="font-bold text-lg text-center mx-auto">Category Details:
                                        <?php echo $category['name']; ?></h3>
                                    <table
                                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <thead
                                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">ID</th>
                                                <th scope="col" class="px-6 py-3">Category Name</th>
                                                <!-- Add other columns as needed -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="px-6 py-4"><?php echo $category['id']; ?></td>
                                                <td class="px-6 py-4"><?php echo $category['name']; ?></td>
                                                <!-- Add other columns as needed -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </dialog>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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