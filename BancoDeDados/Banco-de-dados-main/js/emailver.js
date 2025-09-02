
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const emailInput = document.querySelector("input[name='email']");

    form.addEventListener("submit", function (e) {
        const email = emailInput.value.trim();

        // Expressão regular simples para validar o e-mail
        const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailValido.test(email)) {
            e.preventDefault(); // Impede o envio do formulário
            alert("Por favor, insira um e-mail válido.");
            emailInput.focus();
        }
    });
});