// Ambil elemen yang dibutuhkan
const decrementBtn = document.getElementById("decrementBtn");
const incrementBtn = document.getElementById("incrementBtn");
const counterValue = document.getElementById("counterValue");

// Tambahkan event listener untuk tombol decrement
decrementBtn.addEventListener("click", () => {
    let currentValue = parseInt(counterValue.textContent, 10);
    if (currentValue > 0) {
        // Pastikan nilai tidak turun di bawah 0
        counterValue.textContent = currentValue - 1;
    }
});

// Tambahkan event listener untuk tombol increment
incrementBtn.addEventListener("click", () => {
    let currentValue = parseInt(counterValue.textContent, 10);
    counterValue.textContent = currentValue + 1;
});
