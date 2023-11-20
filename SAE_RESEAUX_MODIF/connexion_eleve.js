document.addEventListener("DOMContentLoaded", function () {
    const ronds = document.querySelectorAll('.point-connexion-eleve');
    const passwordInput = document.getElementById('password-input-connexion-eleve');
    const clearButton = document.getElementById('clear-button-connexion-eleve');
    const validerButton = document.getElementById('valider-button-connexion-eleve');

    const combinaisonValide = "1621"; // La combinaison correcte : vert-rouge-bleu-vert

    let enteredPattern = '';

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

    validerButton.addEventListener('click', () => {
        if (enteredPattern === combinaisonValide) {
            alert("Combinaison correcte. Vous êtes connecté !");
        } else {
            alert("Combinaison incorrecte. Réessayez.");
            enteredPattern = '';
            passwordInput.value = '';
        }
    });
});
     