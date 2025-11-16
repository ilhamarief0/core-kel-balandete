const form = document.getElementById("myForm");
const submitButton = document.getElementById("submitButton");

// Function to check if all inputs are filled
const checkInputs = () => {
    const inputs = form.querySelectorAll("input[required]");
    const allFilled = Array.from(inputs).every((input) => input.value.trim() !== "");
    submitButton.disabled = !allFilled; // Enable button if all inputs are filled
};

// Add event listeners to all inputs
form.querySelectorAll("input[required]").forEach((input) => {
    input.addEventListener("input", checkInputs);
});

// Initial check in case some inputs have default values
checkInputs();
