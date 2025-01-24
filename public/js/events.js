const accordionButtons = document.querySelectorAll(
    ".concerts__filter-category"
);
const filterInputs = document.querySelectorAll(".concerts__filter input");
const filterButton = document.querySelector(".concerts__filter-button");

accordionButtons.forEach((accordionButton) => {
    accordionButton.addEventListener("click", () => {
        accordionButton.classList.toggle("concerts__filter-category--active");
        const filterContent = accordionButton.nextElementSibling;
        const maxHeight = filterContent.style.maxHeight;
        filterContent.style.maxHeight = maxHeight
            ? null
            : filterContent.scrollHeight + 18 + "px";
    });
});

document.querySelector('.concerts__filter-category').click();

filterInputs.forEach((input) => {
    input.addEventListener("input", () => {
        if (window.innerWidth > 991)
            filterButton.style.display = "inline-block";
    });
});
