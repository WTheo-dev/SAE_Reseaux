document.addEventListener("DOMContentLoaded", function () {
    const ronds = document.querySelectorAll('.rond');
    const passwordInput = document.getElementById('password-input');
    const clearButton = document.getElementById('clear-button');
    const validerButton = document.getElementById('valider-button');

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
            alert("L'élève a bien été enregistré");
        } else {
            alert("Combinaison incorrecte. Réessayez.");
            enteredPattern = '';
            passwordInput.value = '';
        }
    });
});
function previewImage() {
    var preview = document.getElementById('imagePreview');
    var fileInput = document.getElementById('photo');
    var file = fileInput.files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
        preview.style.display = 'block';
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}