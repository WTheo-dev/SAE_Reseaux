function validateForm() {
    var emailInput = document.querySelector('input[type="email"]');
    var email = emailInput.value;

    // Simple email validation using regular expression
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(email)) {
      alert("Veuillez entrer une adresse email valide.");
      return false;
    }

    return true;
  }

  function redirectToPostcoAdmin() {
    // Rediriger vers la page_postco_admin
    window.location.href = 'page_postco_superadmin.html'; // Assurez-vous de mettre le chemin correct vers votre page_postco_admin
  }