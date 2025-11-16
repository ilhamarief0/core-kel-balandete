// document.addEventListener("DOMContentLoaded", function () {
//     const addMoreBtn = document.querySelector(".add-more-btn");
//     const container = document.querySelector(".photo-input-container");

//     // Store the original default image source
//     const defaultPhotoSrc = document.querySelector(".photo-form .Photo").src;

//     function initializePhotoInput(photoForm) {
//         const fileInput = photoForm.querySelector(".photo-input");
//         const photoPreview = photoForm.querySelector(".Photo");
//         const uploadButton = photoForm.querySelector(".Upload-btn");

//         // Trigger file input click when "Upload" button is clicked
//         uploadButton.addEventListener("click", () => {
//             fileInput.click();
//         });

//         // Handle file input change
//         fileInput.addEventListener("change", (event) => {
//             const file = event.target.files[0];
//             if (file) {
//                 const reader = new FileReader();
//                 reader.onload = () => {
//                     photoPreview.src = reader.result; // Update preview with selected image
//                 };
//                 reader.readAsDataURL(file);
//             } else {
//                 photoPreview.src = defaultPhotoSrc; // Reset to the original default image
//                 fileInput.value = ""; // Clear the input field
//             }
//         });
//     }

//     // Initialize existing photo input
//     document.querySelectorAll(".photo-form").forEach(initializePhotoInput);

//     // Add new photo input when clicking "Tambah Gambar Desa"
//     addMoreBtn.addEventListener("click", function () {
//         const photoForm = document.querySelector(".photo-form"); // Select existing form
//         if (!photoForm) return;

//         const newPhotoForm = photoForm.cloneNode(true);
//         const newFileInput = newPhotoForm.querySelector(".photo-input");
//         const newPhotoPreview = newPhotoForm.querySelector(".Photo");

//         // Always reset new input and use the original default image
//         newFileInput.value = "";
//         newPhotoPreview.src = defaultPhotoSrc;

//         // Append and initialize
//         container.insertBefore(newPhotoForm, addMoreBtn);
//         initializePhotoInput(newPhotoForm);
//     });
// });

document.addEventListener("DOMContentLoaded", function () {
    const addMoreBtn = document.querySelector(".add-more-btn");
    const container = document.querySelector(".photo-input-container");

    // Store the original default image source
    const defaultPhotoSrc = document.querySelector(".photo-form .Photo").src;

    function initializePhotoInput(photoForm) {
        const fileInput = photoForm.querySelector(".photo-input");
        const photoPreview = photoForm.querySelector(".Photo");
        const uploadButton = photoForm.querySelector(".Upload-btn");

        // Trigger file input click when "Upload" button is clicked
        uploadButton.addEventListener("click", () => {
            fileInput.click();
        });

        // Handle file input change
        fileInput.addEventListener("change", (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    photoPreview.src = reader.result; // Update preview with selected image
                };
                reader.readAsDataURL(file);
            } else {
                photoPreview.src = defaultPhotoSrc; // Reset to the original default image
                fileInput.value = ""; // Clear the input field
            }
        });
    }

    // Initialize existing photo input
    document.querySelectorAll(".photo-form").forEach(initializePhotoInput);

    // Add new photo input when clicking "Tambah Gambar Desa"
    addMoreBtn.addEventListener("click", function () {
        const photoForm = document.querySelector(".photo-form"); // Select existing form
        if (!photoForm) return;

        const newPhotoForm = photoForm.cloneNode(true);
        const newFileInput = newPhotoForm.querySelector(".photo-input");
        const newPhotoPreview = newPhotoForm.querySelector(".Photo");

        // Always reset new input and use the original default image
        newFileInput.value = "";
        newPhotoPreview.src = defaultPhotoSrc;

        // Add class 'new' to newly added photo-form
        newPhotoForm.classList.add("new");

        // Append and initialize
        container.insertBefore(newPhotoForm, addMoreBtn);
        initializePhotoInput(newPhotoForm);
    });
});

// Delete function to remove the parent photo-form when delete button is clicked
function deletePhotoForm(button) {
    const photoForm = button.closest(".photo-form"); // Get the parent .photo-form element
    photoForm.remove(); // Remove the .photo-form element
}
