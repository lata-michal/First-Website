// Kalkulator
function appendToDisplay(value) {
    document.getElementById("display").value += value;
}

function calculateResult() {
    try {
        let expression = document.getElementById("display").value;
        if (/[^0-9+\-*/().\s]/.test(expression)) {
            alert("Niepoprawny zapis działań matematycznych!");
            return;
        }
        document.getElementById("display").value = eval(expression);
    }
    catch(e) {
        alert("Niepoprawny zapis działań matematycznych!")
    }
}

function clearDisplay() {
    document.getElementById("display").value = "";
}

// Formularz z walidacja
function validateForm(event) {
    event.preventDefault();
    
    let firstName = document.getElementById("fname").value;
    let lastName = document.getElementById("lname").value;
    let phoneNumber = document.getElementById("phonenumber").value;
    let birthDate = document.getElementById("birthdate").value;
    let buildingNumber = document.getElementById("building_number").value;
    let country = document.getElementById("country").value;
    let city = document.getElementById("city").value;
    let apartmentNumber = document.getElementById("apartment_number").value;
    let license = document.querySelector('input[name="license"]:checked');
    let gender = document.querySelector('input[name="gender"]:checked');
    let password = document.getElementById("password").value;
    
    let firstNameRegex = /^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+$/;
    let lastNameRegex = /^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+(?:[-\s][A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+)?$/;
    let phoneRegex = /^\d{9}$/;
    let buildingNumberRegex = /^\d+[A-Za-z]?$/;
    let countryCityRegex = /^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+(?:[-\s][A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]+)?$/;
    let apartmentNumberRegex = /^\d+[A-Za-z]?$/;
    
    if (!firstNameRegex.test(firstName)) {
        alert("Podaj poprawne imię (musi zaczynać się dużą literą, a następne litery muszą być małe)." );
        return;
    }

    if (!lastNameRegex.test(lastName)) {
        alert("Podaj poprawne nazwisko (może być jedno- lub dwuczłonowe, każdy człon zaczyna się wielką literą, następnie małe litery)." );
        return;
    }

    if (!phoneRegex.test(phoneNumber)) {
        alert("Podaj poprawny numer telefonu (dokładnie 9 cyfr, bez spacji i separatorów)." );
        return;
    }

    if (!birthDate) {
        alert("Podaj datę urodzenia.");
        return;
    }

    if (!buildingNumberRegex.test(buildingNumber)) {
        alert("Podaj poprawny numer budynku (może zawierać cyfry i opcjonalnie jedną literę)." );
        return;
    }

    if (!apartmentNumberRegex.test(apartmentNumber)) {
        alert("Podaj poprawny numer lokalu (może zawierać cyfry i opcjonalnie jedną literę)." );
        return;
    }

    if (!countryCityRegex.test(country)) {
        alert("Podaj poprawne państwo (musi zaczynać się dużą literą i nie może zawierać cyfr).");
        return;
    }

    if (!countryCityRegex.test(city)) {
        alert("Podaj poprawne miasto (musi zaczynać się dużą literą i nie może zawierać cyfr).");
        return;
    }

    if (!license) {
        alert("Musisz wybrać, czy posiadasz prawo jazdy.");
        return;
    }

    if (!gender) {
        alert("Musisz wybrać płeć.");
        return;
    }

    if (password.length < 8) {
        alert("Hasło musi mieć minimum 8 znaków.");
        return;
    }

    if (!firstName || !lastName || !phoneNumber || !birthDate || !buildingNumber || !country || !city || !apartmentNumber || !password) {
        alert("Wszystkie pola muszą być wypełnione.");
        return;
    }

    alert("Formularz został poprawnie wypełniony! Przeładowanie strony.");
    event.target.submit();
}


window.onload = function() {
    document.querySelector("form").addEventListener("submit", validateForm);
};
