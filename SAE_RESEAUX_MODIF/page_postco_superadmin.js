function deconnecter() {
    // Ajoutez ici le code pour déconnecter l'utilisateur, par exemple, en supprimant les cookies ou en effectuant une déconnexion côté serveur.

    // Redirigez l'utilisateur vers la page d'accueil
    window.location.href = "page_daccueil.html";
}

function showSection() {
    var selectActions = document.getElementById("actions");
    var selectedAction = selectActions.options[selectActions.selectedIndex].value;

    var selectListe = document.getElementById("liste");
    var selectedListe = selectListe.options[selectListe.selectedIndex].value;

    // Cacher toutes les sections
    document.getElementById("modifierSection").classList.add("hidden");
    document.getElementById("creerSection").classList.add("hidden");
    document.getElementById("supprimerSection").classList.add("hidden");

    // Afficher la section correspondante à la combinaison action et liste sélectionnée
    document.getElementById(selectedAction + selectedListe + "Section").classList.remove("hidden");
  }

  function goToPage() {
    var selectActions = document.getElementById("actions");
    var selectedAction = selectActions.options[selectActions.selectedIndex].value;

    var selectListe = document.getElementById("liste");
    var selectedListe = selectListe.options[selectListe.selectedIndex].value;

    // Rediriger vers la page appropriée en fonction des sélections
    window.location.href = selectedAction + selectedListe + ".html";
  }