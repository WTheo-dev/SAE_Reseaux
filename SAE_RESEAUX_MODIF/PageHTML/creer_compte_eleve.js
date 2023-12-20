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
document.getElementById('btn-valider-creation-eleve').addEventListener('click', afficherPopup);


function afficherPopup() {
    // Créer l'élément de la popup
    var popup = document.createElement("div");
    popup.className = "popup";
    popup.innerHTML = "Profil créé";

    // Ajouter la popup à la fin du corps du document
    document.body.appendChild(popup);

    // Ajouter une classe pour l'animation (facultatif)
    popup.classList.add("popup-anim");

    // Fermer la popup après un certain délai (par exemple, 3 secondes)
    setTimeout(function () {
        document.body.removeChild(popup);
    }, 3000);
}

const   lockDots = document.querySelectorAll('.lock-dot');
let enteredCode = '';

lockDots.forEach(dot => {
  dot.addEventListener('click', () => {
    if (enteredCode.length < 4) {
      enteredCode += dot.dataset.dot;
      toggleColor(dot);
    }

    checkCode();
  });
});

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

function connect() {
  window.location.href = 'page_postco_eleve.html';
}

function clearSelection() {
  lockDots.forEach(dot => {
    if (dot.classList.contains('active-dot')) {
      toggleColor(dot);
    }
  });
  enteredCode = '';
  hideConnectButton();
}

function goBack() {
  window.location.href = 'page_daccueil.html';
}
