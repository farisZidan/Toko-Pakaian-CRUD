document.addEventListener("DOMContentLoaded", () => {
const sections = document.querySelectorAll(".section");
window.addEventListener("scroll", () => {
    sections.forEach((section) => {
    const sectionTop = section.getBoundingClientRect().top;
    const triggerHeight = window.innerHeight * 0.8;

    if (sectionTop < triggerHeight) {
        section.classList.add("visible");
        }
    });
});
});