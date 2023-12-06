const resetButton = document.getElementById("reset-button");
const modal = document.getElementById("myModal");
const modalClose = document.getElementById("modal-close");

resetButton.addEventListener("click", function() {
        modal.style.display = "block";
});

modalClose.addEventListener("click", function() {
        modal.style.display = "none";
});