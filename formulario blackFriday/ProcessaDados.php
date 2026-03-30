<?php
// Verifica se o método da requisição é POST (ou seja, se o formulário foi enviado)
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Coleta os dados enviados via formulário
    $usuario = $_POST["usuario"];
    $produto = $_POST["produto"];
    $categoria = $_POST["categoria"];
    $preco = $_POST["preco"];
    $estoque = $_POST["estoque"];
}

// Verifica se existem parâmetros GET (vindos da URL)
if(isset($_GET["Campanha"]) && isset($_GET["Versao"]))
{
    $Campanha = $_GET["Campanha"];
    $Versao = $_GET["Versao"];
}
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados Enviados - Black Friday</title>
<body>
    <div class="resultado">
        <h1>Dados Recebidos</h1>

        <?php
        // Se o método foi POST, exibe os dados enviados pelo formulário
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            echo "<p><strong>Usuário:</strong> $usuario</p>";
            echo "<p><strong>Produto:</strong> $produto</p>";
            echo "<p><strong>Categoria:</strong> $categoria</p>";
            echo "<p><strong>Preço:</strong> R$ $preco</p>";
            echo "<p><strong>Estoque:</strong> $estoque unidades</p>";
        }

        // Se há dados GET (vindos da URL), exibe também
        if(isset($Campanha) && isset($Versao))
        {
            echo "<hr style='border: 1px solid #ff0000; margin: 15px 0;'>";
            echo "<p><strong>Campanha:</strong> $Campanha</p>";
            echo "<p><strong>Versão:</strong> $Versao</p>";
        }
        ?>

        <!-- Link para voltar ao formulário -->
        <a href="index.html" class="voltar">⬅ Voltar ao Formulário</a>
    </div>
<!-- Rodapé -->
<footer>
    © 2025 <span>>Gabriel e Lucas - Soluções</span> — Black Friday Edition 💥 | Desenvolvido por Gabriel da Silva Machado
</footer>
</body>


<style>
/* === Estilização geral === */
body 
{
    margin: 0;
    padding: 0;
    font-family: 'Poppins', Arial, sans-serif;
    color: white;
    background: linear-gradient(135deg, #000000, #111111, #ff0000);
    background-size: 400% 400%;
    animation: bgMove 8s ease infinite; /* animação de leve movimento do fundo */
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* === Animação do fundo === */
@keyframes bgMove 
{
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* === Caixa central de exibição dos dados === */
.resultado 
{
    background-color: rgba(0, 0, 0, 0.8); /* fundo escuro translúcido */
    border: 2px solid #ff0000; /* borda vermelha (tema Black Friday) */
    border-radius: 20px; /* bordas arredondadas */
    padding: 40px; /* espaçamento interno */
    width: 400px; /* largura fixa */
    box-shadow: 0 0 25px rgba(255, 0, 0, 0.6); /* brilho vermelho ao redor */
    text-align: left; /* alinha o texto à esquerda */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* animação suave */
}

/* === Efeito de hover: levanta e brilha === */
.resultado:hover 
{
    transform: translateY(-10px);
    box-shadow: 0 0 40px rgba(255, 0, 0, 0.9);
}

/* === Título principal === */
h1 
{
    text-align: center;
    font-size: 26px;
    color: #ff0000;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* === Cada linha de dado exibido === */
p 
{
    font-size: 18px;
    margin: 8px 0;
}

/* === Palavras destacadas (ex: "Usuário:") === */
strong 
{
    color: #ff0000;
}

/* === Botão para voltar ao formulário === */
.voltar 
{
    display: block;
    text-align: center;
    background-color: #ff0000;
    color: #fff;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 10px;
    margin-top: 20px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.voltar:hover 
{
    background-color: #ff4d4d;
    transform: scale(1.05);
}

/* === RODAPÉ BLACK FRIDAY === */
footer 
{
    width: 100%;
    text-align: center;
    color: white;
    background: rgba(0, 0, 0, 0.85);
    border-top: 2px solid #ff0000;
    padding: 10px 0;
    position: fixed;
    bottom: 0;
    left: 0;
    font-size: 14px;
    letter-spacing: 1px;
}

footer span 
{
    color: #ff0000;
    font-weight: bold;
}
</style>
</head>
</html>
