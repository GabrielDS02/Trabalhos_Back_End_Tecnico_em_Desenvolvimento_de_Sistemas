
function calcularSemaforo() 
{
    let count = parseInt(document.getElementById("vehicleCount").value);
    let result = document.getElementById("result");

    if (isNaN(count) || count < 0) 
    {
        result.innerHTML = "⚠ Insira um número válido!";
        return;
    }

    let tempoVerde = 0;
    let mensagem = "";

    if (count < 11) 
    {
        tempoVerde = 8;
        mensagem = "🏁 Tráfego leve — Pista quase livre!";
    } 
    else if (count <= 20) 
    {
        tempoVerde = 16;
        mensagem = "⏱ Tráfego moderado — Fluxo constante.";
    } 
    else 
    {
        tempoVerde = 25;
        mensagem = "🔥 Tráfego intenso — Atenção total no pit wall!";
    }

    result.innerHTML = `
        ${mensagem}<br><br>
        <span class="green-light">Luz verde: ${tempoVerde}s</span><br>
        🚦 Ajuste automático concluído.
    `;
}