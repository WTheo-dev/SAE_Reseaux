function openFileExplorer() {
    document.getElementById('file-input').click();
}

function deleteSelectedPhoto() {
    let fileInput = document.getElementById('file-input');
    let imageContainer = document.getElementById('image-container');
    let selectedImage = document.getElementById('selected-image');
    let deleteButton = document.getElementById('delete-button');
    let selectButton = document.getElementById('select-button'); // Ajout de cette ligne

    // Réinitialiser le champ de fichier et cacher l'image
    fileInput.value = '';
    selectedImage.src = '';
    imageContainer.style.display = 'none';

    // Cacher le bouton Supprimer la photo et afficher le bouton Sélectionner une photo
    deleteButton.style.display = 'none';
    selectButton.style.display = 'inline-block'; // Ajout de cette ligne
}

document.getElementById('file-input').addEventListener('change', function () {
    let fileInput = document.getElementById('file-input');
    let imageContainer = document.getElementById('image-container');
    let selectedImage = document.getElementById('selected-image');
    let deleteButton = document.getElementById('delete-button');
    let selectButton = document.getElementById('select-button'); // Ajout de cette ligne
    let file = fileInput.files[0];

    if (file) {
        let reader = new FileReader();
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
function createProfile() {
    conter=0;
    clearLockScreen();
}

// Fonction appelée lors du clic sur le bouton "Effacer"
function clearForm() {
    // Effacer le code saisi
    clearLockScreen();
}

// Fonction pour effacer le code
function clearLockScreen() {
    let lockDots = document.querySelectorAll('.lock-dot');
    lockDots.forEach(function(dot) {
        dot.classList.remove('filled');
    });
}

// Fonction appelée lors du clic sur un bouton du cadenas
function addEventListener() {
    let lockDots = document.querySelectorAll('.lock-dot');

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
document.getElementById('btn-valider-creation-eleve').addEventListener('click', afficherPopup);
const   lockDots = document.querySelectorAll('.lock-dot');
let enteredCode = '';

function toggleColor(dot) {
  dot.classList.toggle('active-dot');
}

let conter = 0
function checkCode() {
  if (conter === 3) {
    showConnectButton();
  } else {
    conter++
  }
}

function showConnectButton() {
  const connectButton = document.getElementById('btn-valider-creation-eleve');
  connectButton.style.display = 'block';
}

function hideConnectButton() {
  const connectButton = document.getElementById('btn-valider-creation-eleve');
  connectButton.style.display = 'none';
}

function clearSelection() {
 const get = document.getElementsByTagName('input');

  for (const element of get) {
    element.checked = false;
  }
}

function goBack() {
  window.location.href = 'page_postco_superadmin.php';
}
