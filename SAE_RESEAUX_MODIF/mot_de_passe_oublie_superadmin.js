const resetButton = document.getElementById("reset-button");
const cancelButton = document.getElementById("cancel-button");
const modal = document.getElementById("myModal");
const modalClose = document.getElementById("modal-close");
const emailInput = document.getElementById("email");

resetButton.addEventListener("click", function() {
    // Vérifier si l'adresse e-mail est valide
    if (isValidEmail(emailInput.value)) {
        // Afficher la fenêtre modale
        modal.style.display = "block";
    } else {
        // Afficher un message d'erreur ou prendre d'autres mesures
        alert("Veuillez entrer une adresse e-mail valide.");
    }
});

cancelButton.addEventListener("click", function() {
    // Rediriger vers la page connexion_superadmin.html
    window.location.href = "connexion_superadmin.html";
});

modalClose.addEventListener("click", function() {
    // Fermer la fenêtre modale
    modal.style.display = "none";
});

// Fonction pour vérifier si l'adresse e-mail est valide
function isValidEmail(email) {
    // Utilisez une expression régulière simple pour vérifier le format de l'e-mail
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
