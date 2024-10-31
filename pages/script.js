function appendToDisplay(value) {
    document.getElementById("display").value += value;
}

function calculateResult() {
    try {
        document.getElementById("display").value = eval(document.getElementById("display").value);
    }
    catch(e) {
        alert("Niepoprawny zapis działań matematycznych!")
    }
}

function clearDisplay() {
    document.getElementById("display").value = "";
}