function deconnecter() {
    // Ajoutez ici le code pour déconnecter l'utilisateur, par exemple, en supprimant les cookies ou en effectuant une déconnexion côté serveur.

    // Redirigez l'utilisateur vers la page d'accueil
    window.location.href = "index.html";
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
    switch(selectedAction + selectedListe){
      case "creereleves":
        window.location.href = "creer_compte_eleve.html";
        break;
      case "modifiereleves":
        window.location.href = "modifier_compte_eleve.html";
        break;
      case "supprimereleves":
          window.location.href = "supprimer_eleve.html";
        break;
        case "creercours":
        window.location.href = "creer_cours.html";
        break;
      case "modifiercours":
        window.location.href = "modifier_cours.html";
        break;
      case "supprimercours":
          window.location.href = "supprimer_cours.html";
        break;
        case "creereducateurs":
        window.location.href = "creer_compte_educateur.html";
        break;
      case "modifiereducateurs":
        window.location.href = "modifier_educateur.html";
        break;
      case "supprimereducateurs":
          window.location.href = "supprimer_educateur.html";
        break;
           case "creerformations":
        window.location.href = "creer_formation.html";
        break;
      case "modifierformations":
        window.location.href = "modifier_formation.html";
        break;
      case "supprimerformations":
          window.location.href = "supprimer_formation.html";
        break;
        case "creeradministrateur":
          window.location.href = "creer_compte_superadmin.html";
          break;
        case "modifieradministrateur":
          window.location.href = "modifier_superadmin.html";
          break;
        case "supprimeradministrateur":
            window.location.href = "supprimer_superadmin.html";
          break;
    }

    
  }