


function openModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.showModal();
    }
}
function closeModal(categoryId) {
    const modal = document.getElementById(`modal_${categoryId}`);
    modal.close();
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
