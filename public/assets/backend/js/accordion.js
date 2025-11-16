$(() => {
    $("[data-expand]").on("click", function (e) {
        $(this).toggleClass("active");
        $(this).children("img").toggleClass("rotate-180");
        let target = $(`#${$(this).data("expand")}`);
        target.slideToggle();
    });
});