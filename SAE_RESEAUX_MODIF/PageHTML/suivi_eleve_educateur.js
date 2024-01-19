const lockDots = document.querySelectorAll('.lock-dot');
let selectedDots = [];

lockDots.forEach(dot => {
  dot.addEventListener('click', () => {
    if (!dot.classList.contains('active-dot') && selectedDots.length < 4) {
      addDelayAndToggleColor(dot);
    } else if (dot.classList.contains('active-dot')) {
      toggleColor(dot);
    }

    checkCode();
  });
});

function addDelayAndToggleColor(dot) {
  setTimeout(() => {
    toggleColor(dot);
    checkCode();
  }, 200); // 200 millisecondes de délai (ajustez selon vos préférences)
}

function toggleColor(dot) {
  dot.classList.toggle('active-dot');
  if (dot.classList.contains('active-dot')) {
    selectedDots.push(dot);
  } else {
    selectedDots = selectedDots.filter(selectedDot => selectedDot !== dot);
  }
}

function checkCode() {
  if (selectedDots.length === 4) {
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
  selectedDots.forEach(dot => {
    toggleColor(dot);
  });
  selectedDots = [];
  hideConnectButton();
}

function goBack() {
  history.back();
}
