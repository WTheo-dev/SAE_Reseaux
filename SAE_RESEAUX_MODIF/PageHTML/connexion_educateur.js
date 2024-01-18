const lockDots = document.querySelectorAll('.lock-dot');
let enteredCode = '';

/*
lockDots.forEach(dot => {
  dot.addEventListener('click', () => {
    if (enteredCode.length < 4) {
      enteredCode += dot.dataset.dot;
      toggleColor(dot);
    }

    checkCode();
  });
});
*/

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
  const connectButton = document.getElementById('connect-button_educ');
  connectButton.style.display = 'block';
}

function hideConnectButton() {
  const connectButton = document.getElementById('connect-button');
  connectButton.style.display = 'none';
}

function connect() {
  window.location.href = 'page_postco_admin.php';
}

function clearSelection() {
  /*
  lockDots.forEach(dot => {
    if (dot.classList.contains('active-dot')) {
      toggleColor(dot);
    }
  });
  enteredCode = '';
  hideConnectButton();
  */
  get = document.getElementsByTagName('input');

  for (var i = 0; i < get.length; i++) {
    get[i].checked = false;
  }
}

function goBack() {
  window.location.href = 'index.php';
}
