// Ambil elemen-elemen tab dan konten
const tabButtons = document.querySelectorAll("#TabButtons button");
const tabContents = document.querySelectorAll(".TabValues > div");

// Fungsi untuk mengaktifkan tab
function activateTab(index) {
    // Perbarui tombol tab
    tabButtons.forEach((button, btnIndex) => button.classList.toggle("active", btnIndex === index));
    // Perbarui konten tab
    tabContents.forEach((content, contentIndex) => content.classList.toggle("hidden", contentIndex !== index));
}
// Tambahkan event listener ke tombol tab
tabButtons.forEach((button, index) => {
    button.addEventListener("click", () => activateTab(index));
});
// Aktifkan tab pertama saat halaman dimuat
activateTab(0);
