const lockDots = document.querySelectorAll('.lock-dot');
let enteredCode = '';

function toggleColor(dot) {
  dot.classList.toggle('active-dot');
}

function checkCode() {
  if (enteredCode === '1234') {
    showConnectButton();
  } else {
    hideConnectButton();
  }
}

function showConnectButton() {
  const connectButton = document.getElementById('connect-button');
  connectButton.style.display = 'block';
}

function hideConnectButton() {
  const connectButton = document.getElementById('connect-button');
  connectButton.style.display = 'none';
}

function connect() {
  window.location.href = 'page_postco_eleve.php';
}

function clearSelection() {

  const get = document.getElementsByTagName('input');

  for (const element of get) {
    element.checked = false;
  }
}


document.addEventListener('DOMContentLoaded', function () {
  const checkboxes = document.querySelectorAll('#lock-screen input[type="checkbox"]');

  checkboxes.forEach((checkbox) => {
      checkbox.addEventListener('change', (event) => {
          let checkedCount = 0;
          checkboxes.forEach((cb) => {
              if (cb.checked) checkedCount++;
          });

          if (checkedCount > 4) {
              event.target.checked = false;
          }
      });
  });
});

document.addEventListener("DOMContentLoaded", function() {
  const lockScreen = document.getElementById("lock-screen");
  const digits = lockScreen.querySelectorAll(".lock-dot input[type='checkbox']");
  const mdpField = document.getElementById("mdp");
  
  let mdp = '';

  digits.forEach(function(digit) {
    digit.addEventListener("change", function() {
      if (this.checked) {
        mdp += this.id;
      } else {
        mdp = mdp.replace(this.id, '');
      }
      mdpField.value = mdp;
    });
  });
});


function goBack() {
  window.location.href = 'index.php';
}
