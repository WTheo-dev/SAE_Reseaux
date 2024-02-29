// Load existing comments from localStorage
window.onload = function() {
  loadComments();
};

function deconnecter() {
  // Ajoutez ici le code pour déconnecter l'utilisateur, par exemple, en supprimant les cookies ou en effectuant une déconnexion côté serveur.

  // Redirigez l'utilisateur vers la page d'accueil
  window.location.href = "index.php";
}

function ajouterCommentaire() {
  let commentaire = document.getElementById("comment-voircom").value.trim();

  // Check if the textarea has at least one character
  if (commentaire.length > 0) {
    let table = document.getElementById("commentTablevoircom");
    let row = table.insertRow(-1);
    let cell1 = row.insertCell(0);
    let cell2 = row.insertCell(1);
    let cell3 = row.insertCell(2);
    let cell4 = row.insertCell(3);
    cell1.innerHTML = "Jean";
    cell2.innerHTML = "Dubois";
    cell3.innerHTML = commentaire;

    // Add a "Supprimer" button only for the new row
    let deleteButton = document.createElement("button");
    deleteButton.innerHTML = "Supprimer";
    deleteButton.className = "button-voircom"; // Add the existing button class
    deleteButton.onclick = function() {
      supprimerLigne(row);
    };
    cell4.appendChild(deleteButton);

    // Add a "Modifier" button only for the new row
    let editButton = document.createElement("button");
    editButton.innerHTML = "Modifier";
    editButton.className = "button-voircom"; // Add the existing button class
    editButton.onclick = function() {
      modifierCommentaire(row);
    };
    cell4.appendChild(editButton);

    // Save comments to localStorage
    saveComments();

    // Clear the textarea content
    document.getElementById("comment-voircom").value = "";
  } else {
    alert("Veuillez entrer un commentaire avant d'ajouter.");
  }
}

function modifierCommentaire(row) {
  let newComment = prompt("Modifier le commentaire:", row.cells[2].innerHTML);
  if (newComment !== null) {
    row.cells[2].innerHTML = newComment;

    // Save comments to localStorage after modification
    saveComments();
  }
}

function supprimerLigne(row) {
  let table = document.getElementById("commentTablevoircom");
  table.deleteRow(row.rowIndex);

  // Save comments to localStorage after deletion
  saveComments();
}

function saveComments() {
  let comments = [];
  let table = document.getElementById("commentTablevoircom");

  for (let i = 1; i < table.rows.length; i++) {
    let comment = table.rows[i].cells[2].innerHTML;
    comments.push(comment);
  }

  localStorage.setItem("comments", JSON.stringify(comments));
}

function loadComments() {
  let comments = JSON.parse(localStorage.getItem("comments")) || [];
  let table = document.getElementById("commentTablevoircom");

  for (const element of comments) {
    let row = table.insertRow(-1);
    let cell1 = row.insertCell(0);
    let cell2 = row.insertCell(1);
    let cell3 = row.insertCell(2);
    let cell4 = row.insertCell(3);
    cell1.innerHTML = "Jean";
    cell2.innerHTML = "Dubois";
    cell3.innerHTML = element;

    // Add a "Supprimer" button
    let deleteButton = document.createElement("button");
    deleteButton.innerHTML = "Supprimer";
    deleteButton.className = "button-voircom"; // Add the existing button class
    deleteButton.onclick = function() {
      supprimerLigne(row);
    };
    cell4.appendChild(deleteButton);

    // Add a "Modifier" button
    let editButton = document.createElement("button");
    editButton.innerHTML = "Modifier";
    editButton.className = "button-voircom"; // Add the existing button class
    editButton.onclick = function() {
      modifierCommentaire(row);
    };
    cell4.appendChild(editButton);
  }
}
