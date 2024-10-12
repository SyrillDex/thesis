const inputField = document.getElementById('inputField');
const keyboard = document.getElementById('keyboard');

inputField.addEventListener('focus', () => {
    keyboard.style.display = 'block';
});

function addToInput(char) {
    inputField.value += char;
}

function backspace() {
    inputField.value = inputField.value.slice(0, -1);
}
function recordInput() {
    keyboard.style.display = 'none';
}
function submitRecords(){
    const age = inputField.value;
    console.log("Input value recorded:", age);
    inputField.value = inputField.value.slice(0, -100);
}
