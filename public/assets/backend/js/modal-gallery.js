document.addEventListener("DOMContentLoaded", function () {

    const mainImage = document.getElementById("Selected-Image");
    const galleryButtons = document.querySelectorAll("[data-gallery]");
    const modalGalleryButtons = document.querySelectorAll("[data-image]");

    // When clicking a thumbnail outside the modal
    galleryButtons.forEach(button => {
        button.addEventListener("click", function () {
            const imageSrc = this.getAttribute("data-gallery");

            // Set the modal's main image to the clicked thumbnail
            mainImage.src = imageSrc;

            // Remove .active from all modal thumbnails
            modalGalleryButtons.forEach(btn => btn.classList.remove("active"));

            // Find the matching button inside the modal and set it active
            const matchingButton = Array.from(modalGalleryButtons).find(btn => btn.getAttribute("data-image") === imageSrc);
            if (matchingButton) {
                matchingButton.classList.add("active");
            }
        });
    });

    // When clicking a thumbnail inside the modal
    modalGalleryButtons.forEach(button => {
        button.addEventListener("click", function () {
            const imageSrc = this.getAttribute("data-image");

            // Update the main image in the modal
            mainImage.src = imageSrc;

            // Remove .active from all buttons inside the modal
            modalGalleryButtons.forEach(btn => btn.classList.remove("active"));

            // Add .active to the clicked button
            this.classList.add("active");
        });
    });
});