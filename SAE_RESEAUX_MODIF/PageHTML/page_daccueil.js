let button = document.getElementById("js-button-tts");
let content = document.getElementById("js-content-tts");

button.addEventListener("click", function(){
    let text = content.textContent;

    let speech = new SpeechSynthesisUtterance(text);
    speechSynthesis.speak(speech);
});