document.addEventListener("DOMContentLoaded", function () {
    const ronds = document.querySelectorAll('.point-connexion-eleve');
    const passwordInput = document.getElementById('password-input-connexion-eleve');
    const clearButton = document.getElementById('clear-button-connexion-eleve');
    const validerButton = document.getElementById('valider-button-connexion-eleve');

    const combinaisonValide = "1621"; // La combinaison correcte
    const maxTentatives = 3; // Nombre maximal de tentatives incorrectes autorisées
    let enteredPattern = '';
    let tentativesIncorrectes = 0;

    ronds.forEach((rond, index) => {
        rond.addEventListener('click', () => {
            if (enteredPattern.length < 4) {
                enteredPattern += (index + 1).toString();
                passwordInput.value = enteredPattern;
            }
        });
    });

    clearButton.addEventListener('click', () => {
        enteredPattern = '';
        passwordInput.value = '';
    });

    validerButton.addEventListener('click', (event) => {
        if (enteredPattern === combinaisonValide) {
            // La combinaison est correcte, rediriger vers la page suivante
            window.location.href = "page_postco_eleve.html";
        } else {
            // La combinaison est incorrecte
            tentativesIncorrectes++;
            if (tentativesIncorrectes >= maxTentatives) {
                // Désactiver le schéma de saisie après un certain nombre de tentatives incorrectes
                ronds.forEach(rond => rond.removeEventListener('click'));
                alert("Trop de tentatives incorrectes. Le schéma de saisie est désactivé.");
            }
            event.preventDefault(); // Empêche la soumission du formulaire si la combinaison est incorrecte
        }
    });
});