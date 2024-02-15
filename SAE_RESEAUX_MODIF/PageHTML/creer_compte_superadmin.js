function validateForm() {
    let emailInput = document.querySelector('input[type="email"]');
    let email = emailInput.value;

    // Simple email validation using regular expression
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(email)) {
      alert("Veuillez entrer une adresse email valide.");
      return false;
    }

    return true;
  }

  function redirectToPostcoAdmin() {
    // Rediriger vers la page_postco_admin
    window.location.href = 'page_postco_superadmin.php'; // Assurez-vous de mettre le chemin correct vers votre page_postco_admin
  }