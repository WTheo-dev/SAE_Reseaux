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

function goBack() {
  window.location.href = 'index.php';
}
