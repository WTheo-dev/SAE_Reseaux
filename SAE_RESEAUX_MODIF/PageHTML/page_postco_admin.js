function deconnecter() {
    // Ajoutez ici le code pour déconnecter l'utilisateur, par exemple, en supprimant les cookies ou en effectuant une déconnexion côté serveur.
    // Redirigez l'utilisateur vers la page d'accueil
    window.location.href = "page_daccueil.html";
  }
  
  function selectProfile(element, id_app) {
    // Retirez d'abord la classe "selected" de tous les éléments
    const allContainers = document.querySelectorAll('.profile-switch-container');
    allContainers.forEach(container => {
      container.classList.remove('selected');
    });
  console.log("sgsrg")
    // Ajoutez la classe "selected" à l'élément cliqué
    element.classList.add('selected');
  
    // Affichez les boutons dans le profil sélectionné
    const buttonsContainer = document.getElementById("profile_btn") 
       buttonsContainer.style.display = 'flex';

      document.getElementById("button_creer_nouvelle_fiche").setAttribute("value", id_app);
  }
  
  function creerNouvelleFiche() {
    window.location.href="fiche_valeur.php"; 
  }
  
  function accederEvaluation() {
    window.location.href = "suivi_eleve_educateur.php";
    }
  
  function voirCommentaires() {
    window.location.href = "voir_commentaire_educ.php";  }
  
  function deconnecter() {
    // Ajoutez ici le code pour déconnecter l'utilisateur, par exemple, en supprimant les cookies ou en effectuant une déconnexion côté serveur.
    // Redirigez l'utilisateur vers la page d'accueil
    window.location.href = "index.php";
  }
  
