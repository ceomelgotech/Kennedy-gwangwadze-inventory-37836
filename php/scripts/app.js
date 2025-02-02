document.addEventListener("DOMContentLoaded", function () {
    let deleteButtons = document.querySelectorAll(".btn-danger");
    deleteButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            if (!confirm("Are you sure you want to delete this item?")) {
                event.preventDefault();
            }
        });
    });
}); 