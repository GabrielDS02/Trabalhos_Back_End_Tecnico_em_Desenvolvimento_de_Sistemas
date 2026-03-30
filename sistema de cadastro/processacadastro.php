<?php // puxa os dados do html via methodo post
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Coleta os dados enviados via formulário
    $NomeAluno = $_POST["aluno"];
    $idade = $_POST["idade"];
    $turma = $_POST["turma"];
    $nota1 = $_POST["nota1"];
    $nota2 = $_POST["nota2"];

}
// Verifica se existem parâmetros GET (vindos da URL)
if(isset($_GET["CADASTRO"]) && isset($_GET["versão"]))
{
    $CADASTRO = $_GET["CADASTRO"];
    $versão = $_GET["versão"];
}

// conta das medias das duas notas
$ContaMedia = ($nota1 * $nota2 / 2);

?>




<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Bem Sucedido</title>
<body>
    <div class="resultado">
        <h1>Dados Cadastrados</h1>

        <?php
        // Se o método foi POST, exibe os dados enviados pelo formulário
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            echo "<p><strong>nome do Aluno:</strong> $NomeAluno</p>";
            echo "<p><strong>Idade:</strong> $idade</p>";
            echo "<p><strong>Turma:</strong> $turma</p>";
            echo "<p><strong>Primeira Nota:</strong> $nota1</p>";
            echo "<p><strong>DSegunda Nota:</strong> $nota2 </p>";
        }


        // Se há dados GET (vindos da URL), exibe também
        if(isset($CADASTRO) && isset($versão))
        {
            echo "<hr style='border: 1px solid #ff0000; margin: 15px 0;'>";
            echo "<p><strong>Cadastro:</strong> $CADASTRO</p>";
            echo "<p><strong>Versão:</strong> $versão</p>";
        }

        // EXIBI OS DADOS DA MEDIA, PELO METHODO POST
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            echo "<hr style='border: 1px solid #ff0000; margin: 15px 0;'>";
            echo "<p><strong>Média: </strong> $ContaMedia<p>";
        }
        if ($_SERVER["REQUEST_METHOD"]== "POST")
        {
            // condições de aprovado ou não
            if ($ContaMedia == 6 || $ContaMedia > 6)
            {
                echo "<hr style='border: 1px solid #ff0000; margin: 15px 0;'>";
                echo "<p><strong> Condição de aproveitamento do aluno:</strong> $NomeAluno<p>"; 
                echo "<p><strong>Foi aprovado, com uma media de:</strong> $ContaMedia pontos</p>";
            }
            else if ($ContaMedia == 2 || $ContaMedia < 6 )
            {
                echo "<hr style='border: 1px solid #ff0000; margin: 15px 0;'>";
                echo "<p><strong> Condição de aproveitamento do aluno:</strong> $NomeAluno<p>"; 
                echo "<p><strong>Esta de recuperação, com uma media de:</strong> $ContaMedia pontos</p>";
            }
            else if ($ContaMedia < 2)
            {
                echo "<hr style='border: 1px solid #ff0000; margin: 15px 0;'>";
                echo "<p><strong> Condição de aproveitamento do aluno: $NomeAluno</strong><p>";   
                echo "<p><strong>Foi reprovado, com uma media de:</strong>$ContaMedia pontos</p>";
            }
        }

    ?>

        <!-- Link para voltar ao formulário -->
        <a href="index.php" class="voltar">⬅ Voltar ao Formulário</a>
    </div>
    <!-- Rodapé -->
    <footer>
        © 2025 <span>>Escola Geraldina Ana Gomes</span> — CADASTRO 🏫 | Desenvolvido por Gabriel da Silva Machado
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
    background: linear-gradient(135deg, #000000, #111111, #d22d2dff);
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
