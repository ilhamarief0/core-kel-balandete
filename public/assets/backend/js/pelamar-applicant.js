document.addEventListener("DOMContentLoaded", () => {
    const pelamarApplicantButton = document.getElementById("Pelamar-Applicant-Button");
    const modal = document.getElementById("modal");
    const closeModal = document.getElementById("closeModal");
    const profileList = document.getElementById("Profile-List");
    const defaultProfileImage = document.getElementById("default-Profile-Image");
    const defaultProfileName = document.getElementById("default-Profile-Name");
    const iconIfFilled = document.getElementById("Icon-If-Filled");
    const defaultProfileStatus = document.getElementById("default-Profile-Status");
    const bodyElement = document.body;

    // Tampilkan modal
    pelamarApplicantButton.addEventListener("click", () => {
        modal.classList.remove("hidden");
        bodyElement.classList.add("overflow-hidden");
    });

    // Tutup modal
    closeModal.addEventListener("click", (e) => {
        // Mencegah perilaku default, jika tombol ada dalam form
        e.preventDefault();
        modal.classList.add("hidden");
        bodyElement.classList.remove("overflow-hidden");
    });

    // Pilih profile
    profileList.addEventListener("click", (e) => {
        const listItem = e.target.closest("li")?.querySelector('input[type="radio"][name="anggota"]');
        if (listItem) {
            const image = listItem.dataset.image;
            const name = listItem.dataset.name;
            const status = listItem.dataset.status;

            // Update tombol default
            defaultProfileImage.src = image;
            defaultProfileName.textContent = name;
            defaultProfileStatus.textContent = status;
            iconIfFilled.classList.add("input-is-filled");

            // Tutup modal
            modal.classList.add("hidden");
            bodyElement.classList.remove("overflow-hidden");
        }
    });
});
