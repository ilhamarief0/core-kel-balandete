document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".tab-btn");
    const contents = document.querySelectorAll("#Tabs-Content > div");

    tabs.forEach(tab => {
        tab.addEventListener("click", function () {
            const targetId = this.getAttribute("data-content");

            // Remove .active from all tabs
            tabs.forEach(t => t.classList.remove("active"));
            // Hide all contents
            contents.forEach(c => c.classList.add("hidden"));

            // Add .active to clicked tab
            this.classList.add("active");
            // Show the target content
            document.getElementById(targetId).classList.remove("hidden");
        });
    });
});
