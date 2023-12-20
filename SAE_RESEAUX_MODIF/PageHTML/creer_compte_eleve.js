function openFileExplorer() {
    document.getElementById('file-input').click();
}

function deleteSelectedPhoto() {
    var fileInput = document.getElementById('file-input');
    var imageContainer = document.getElementById('image-container');
    var selectedImage = document.getElementById('selected-image');
    var deleteButton = document.getElementById('delete-button');
    var selectButton = document.getElementById('select-button'); // Ajout de cette ligne
    var buttonContainer = document.getElementById('button-container');

    // Réinitialiser le champ de fichier et cacher l'image
    fileInput.value = '';
    selectedImage.src = '';
    imageContainer.style.display = 'none';

    // Cacher le bouton Supprimer la photo et afficher le bouton Sélectionner une photo
    deleteButton.style.display = 'none';
    selectButton.style.display = 'inline-block'; // Ajout de cette ligne
}

document.getElementById('file-input').addEventListener('change', function () {
    var fileInput = document.getElementById('file-input');
    var imageContainer = document.getElementById('image-container');
    var selectedImage = document.getElementById('selected-image');
    var deleteButton = document.getElementById('delete-button');
    var selectButton = document.getElementById('select-button'); // Ajout de cette ligne
    var buttonContainer = document.getElementById('button-container');

    var file = fileInput.files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function (e) {
            selectedImage.src = e.target.result;
            imageContainer.style.display = 'block';

            // Afficher le bouton Supprimer la photo et cacher le bouton Sélectionner une photo
            deleteButton.style.display = 'inline-block';
            selectButton.style.display = 'none'; // Ajout de cette ligne
        };

        reader.readAsDataURL(file);
    } else {
        // Si aucun fichier n'est sélectionné, cacher l'image et le bouton Supprimer
        imageContainer.style.display = 'none';
        deleteButton.style.display = 'none';
        selectButton.style.display = 'inline-block'; // Ajout de cette ligne
    }
 
});
// Fonction appelée lors du clic sur le bouton "Créer"
function createProfile() {
    // Vous pouvez ajouter ici le code nécessaire pour créer le profil

    // Ramener vers la page page_posto_superadmin
    window.location.href = 'page_posto_superadmin.html';

    // Afficher un popup "Profil créé"
    alert('Profil créé');

    // Effacer le code précédemment saisi
    clearLockScreen();
}

// Fonction appelée lors du clic sur le bouton "Effacer"
function clearForm() {
    // Effacer le code saisi
    clearLockScreen();
}

// Fonction pour effacer le code
function clearLockScreen() {
    var lockDots = document.querySelectorAll('.lock-dot');
    lockDots.forEach(function(dot) {
        dot.classList.remove('filled');
    });
}

// Fonction appelée lors du clic sur un bouton du cadenas
function addEventListener() {
    var lockDots = document.querySelectorAll('.lock-dot');

    lockDots.forEach(function(dot) {
        dot.addEventListener('click', function() {
            if (!dot.classList.contains('filled')) {
                dot.classList.add('filled');
            } else {
                dot.classList.remove('filled');
            }
        });
    });
}

// Associer ces fonctions aux boutons correspondants
document.getElementById('a').addEventListener('click', createProfile);
document.getElementById('back-button').addEventListener('click', clearForm);
document.getElementById('connect-button').addEventListener('click', connect);
document.getElementById('a').addEventListener('click', addEventListener);
