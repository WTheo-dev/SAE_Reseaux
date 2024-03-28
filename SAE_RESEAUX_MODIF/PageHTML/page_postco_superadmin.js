function deconnecter() {
  window.location.href = "deconnexion.php";
}



function showSection() {
    let selectActions = document.getElementById("actions");
    let selectedAction = selectActions.options[selectActions.selectedIndex].value;

    let selectListe = document.getElementById("liste");
    let selectedListe = selectListe.options[selectListe.selectedIndex].value;

    // Cacher toutes les sections
    document.getElementById("modifierSection").classList.add("hidden");
    document.getElementById("creerSection").classList.add("hidden");
    document.getElementById("supprimerSection").classList.add("hidden");

    // Afficher la section correspondante à la combinaison action et liste sélectionnée
    document.getElementById(selectedAction + selectedListe + "Section").classList.remove("hidden");
  }

  function goToPage() {
    let selectActions = document.getElementById("actions");
    let selectedAction = selectActions.options[selectActions.selectedIndex].value;

    let selectListe = document.getElementById("liste");
    let selectedListe = selectListe.options[selectListe.selectedIndex].value;

    // Rediriger vers la page appropriée en fonction des sélections
    switch(selectedAction + selectedListe){
      case "creereleves":
        window.location.href = "creer_compte_eleve.php";
        break;
      case "modifiereleves":
        window.location.href = "modifier_liste_eleve.php";
        break;
        case "creercours":
        window.location.href = "creer_cours_superadmin.php";
        break;
      case "modifiercours":
        window.location.href = "modifier_cours_superadmin.php";
        break;
        case "creereducateurs":
        window.location.href = "creer_compte_educateur.php";
        break;
      case "modifiereducateurs":
        window.location.href = "modifier_educateur.html";
        break;
           case "creerformations":
        window.location.href = "creer_formation_superadmin.php";
        break;
      case "modifierformations":
        window.location.href = "modifier_formation_superadmin.php";
        break;
    }

    
  }

  function goToPageBanque(){
    window.location.href = "banque.php";

  }