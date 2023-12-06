// Load existing comments from localStorage
window.onload = function() {
  loadComments();
};

function deconnecter() {
  // Ajoutez ici le code pour déconnecter l'utilisateur, par exemple, en supprimant les cookies ou en effectuant une déconnexion côté serveur.

  // Redirigez l'utilisateur vers la page d'accueil
  window.location.href = "page_daccueil.html";
}

function ajouterCommentaire() {
  var commentaire = document.getElementById("comment").value.trim();

  // Check if the textarea has at least one character
  if (commentaire.length > 0) {
      var table = document.getElementById("commentTable");
      var row = table.insertRow(-1);
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      var cell4 = row.insertCell(3);
      cell1.innerHTML = "Jean";
      cell2.innerHTML = "Dubois";
      cell3.innerHTML = commentaire;

      // Add a "Supprimer" button only for the new row
      var deleteButton = document.createElement("button");
      deleteButton.innerHTML = "Supprimer";
      deleteButton.onclick = function() {
          supprimerLigne(row);
      };
      cell4.appendChild(deleteButton);

      // Add a "Modifier" button only for the new row
      var editButton = document.createElement("button");
      editButton.innerHTML = "Modifier";
      editButton.onclick = function() {
          modifierCommentaire(row);
      };
      cell4.appendChild(editButton);

      // Save comments to localStorage
      saveComments();

      // Clear the textarea content
      document.getElementById("comment").value = "";
  } else {
      alert("Veuillez entrer un commentaire avant d'ajouter.");
  }
}

function modifierCommentaire(row) {
  var newComment = prompt("Modifier le commentaire:", row.cells[2].innerHTML);
  if (newComment !== null) {
      row.cells[2].innerHTML = newComment;

      // Save comments to localStorage after modification
      saveComments();
  }
}

function supprimerLigne(row) {
  var table = document.getElementById("commentTable");
  table.deleteRow(row.rowIndex);

  // Save comments to localStorage after deletion
  saveComments();
}

function saveComments() {
  var comments = [];
  var table = document.getElementById("commentTable");

  for (var i = 1; i < table.rows.length; i++) {
      var comment = table.rows[i].cells[2].innerHTML;
      comments.push(comment);
  }

  localStorage.setItem("comments", JSON.stringify(comments));
}

function loadComments() {
  var comments = JSON.parse(localStorage.getItem("comments")) || [];
  var table = document.getElementById("commentTable");

  for (var i = 0; i < comments.length; i++) {
      var row = table.insertRow(-1);
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      var cell4 = row.insertCell(3);
      cell1.innerHTML = "Nouveau";
      cell2.innerHTML = "Commentaire";
      cell3.innerHTML = comments[i];

      
          // Add a "Supprimer" button
          var deleteButton = document.createElement("button");
          deleteButton.innerHTML = "Supprimer";
          deleteButton.onclick = function () {
              supprimerLigne(row);
          };
          cell4.appendChild(deleteButton);
      

      // Add a "Modifier" button
      var editButton = document.createElement("button");
      editButton.innerHTML = "Modifier";
      editButton.onclick = function () {
          modifierCommentaire(row);
      };
      cell4.appendChild(editButton);
  }
}





