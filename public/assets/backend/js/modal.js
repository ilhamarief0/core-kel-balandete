document.addEventListener("DOMContentLoaded", function () {
    const modalButtons = document.querySelectorAll("[data-modal]");
    const closeButtons = document.querySelectorAll(".btn-close-modal");

    modalButtons.forEach(button => {
        button.addEventListener("click", function () {
            const modalId = this.getAttribute("data-modal");
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove("hidden");
                document.body.classList.add("overflow-hidden");
            }
        });
    });

    closeButtons.forEach(button => {
        button.addEventListener("click", function () {
            const modal = this.closest(".modal");
            if (modal) {
                modal.classList.add("hidden");
                document.body.classList.remove("overflow-hidden");
            }
        });
    });

    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("modal")) {
            event.target.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
        }
    });
});