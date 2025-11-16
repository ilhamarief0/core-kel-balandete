const fileInput = document.getElementById("File");
const photoContainer = document.getElementById("Photo");
const addPhotoButton = document.getElementById("Upload");

// Simpan referensi ke gambar sebelumnya
let previousPhotoSrc = photoContainer.src;

// Trigger file input click when "Add" button is clicked
addPhotoButton.addEventListener("click", () => {
    fileInput.click();
});

// Handle file input change
fileInput.addEventListener("change", (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = () => {
            previousPhotoSrc = photoContainer.src; // Simpan gambar sebelumnya
            photoContainer.src = reader.result; // Update photo preview
        };
        reader.readAsDataURL(file);
    } else {
        // Jika tidak ada file yang dipilih (Cancel)
        photoContainer.src = previousPhotoSrc; // Kembali ke gambar sebelumnya
    }
});
