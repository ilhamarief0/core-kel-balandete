// Function to calculate age from the input date
function calculateAge(birthDate) {
    const today = new Date();
    const birth = new Date(birthDate);
    let age = today.getFullYear() - birth.getFullYear();
    const monthDifference = today.getMonth() - birth.getMonth();

    // Adjust age if birthdate hasn't occurred yet this year
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birth.getDate())) {
    age--;
    }

    return age;
}

// Event listener for date input
const birthDateInput = document.getElementById('birthdate');
birthDateInput.addEventListener('input', function () {
    const birthDate = this.value;
    const age = calculateAge(birthDate);
    document.getElementById('Age').textContent = age;
});