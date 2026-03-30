// Efeito suave no botão ao enviar
document.getElementById("form").addEventListener("submit", function() 
{
    const btn = document.querySelector(".btn");
    btn.innerText = "Enviando...";
    btn.style.opacity = "0.6";
});
