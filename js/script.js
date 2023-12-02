
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("simple-search");

    searchInput.addEventListener("input", function() {
        const searchTerm = searchInput.value.trim();

        if (searchTerm.length > 0) {
            fetch("search_category.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `searchTerm=${encodeURIComponent(searchTerm)}`,
                })
                .then(response => response.json())
                .then(data => {
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
