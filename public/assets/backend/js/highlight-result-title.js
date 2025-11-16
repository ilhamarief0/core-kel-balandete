document.addEventListener("DOMContentLoaded", function () {
    const keywordElement = document.getElementById("Keyword");
    const resultTitles = document.querySelectorAll(".result-title");

    if (!keywordElement) return;

    function highlightMatches() {
        const keywords = keywordElement.textContent.trim().split(/\s+/);
        if (keywords.length === 0) return;

        resultTitles.forEach(title => {
            let text = title.textContent;
            keywords.forEach(keyword => {
                if (keyword) {
                    const regex = new RegExp(`\\b(${keyword})\\b`, "gi");
                    text = text.replace(regex, `<span class="text-desa-soft-green">$1</span>`);
                }
            });
            title.innerHTML = text;
        });
    }

    highlightMatches();
});
