<?php 
// =======================================================
// INÍCIO DO SCRIPT PHP
// =======================================================

// Inicia uma sessão PHP — isso permite armazenar dados temporários do usuário
session_start();

// Inclui o arquivo de conexão com o banco de dados (deve conter o $conn)
include "conexao.php";


// =======================================================
// VERIFICA SE O FORMULÁRIO FOI ENVIADO (MÉTODO POST)
// =======================================================
if ($_SERVER["REQUEST_METHOD"] === "POST") 
    {

    // Coleta os dados enviados pelo formulário e remove espaços extras
    $cliente_c          = trim($_POST["cliente"]);
    $telefone_c         = trim($_POST["telefone"]);
    $eletrodomestico_c  = trim($_POST["eletrodomestico"]);
    $data_c             = trim($_POST["data"]);
    $descricao_c        = trim($_POST["descricao"]);

    // ---------------------------------------------------
    // Verifica se algum campo foi deixado em branco
    // ---------------------------------------------------
    if ($cliente_c === "" || $telefone_c === "" || $eletrodomestico_c === "" || $data_c === "" || $descricao_c === "") {
        echo "<script>alert('Nenhum campo pode ficar em branco, por favor preencha novamente.'); window.history.back();</script>";
        exit; // Encerra o script para não continuar a execução
    }

    // ---------------------------------------------------
    // Prepara o comando SQL para inserir os dados
    // (Usamos o método PREPARE para evitar SQL Injection)
    // ---------------------------------------------------
    $stmt = $conn->prepare("INSERT INTO CadastroEletrodomesticos 
        (cliente, telefone, eletrodomestico, data_do_atendimento, descricao)
        VALUES (?, ?, ?, ?, ?)");

    // Liga as variáveis PHP aos parâmetros do comando SQL (sssss = 5 strings) // O primeiro parâmetro ("sssss") indica o tipo de dado que cada variável representa.
    $stmt->bind_param("sssss", $cliente_c, $telefone_c, $eletrodomestico_c, $data_c, $descricao_c);

    // ---------------------------------------------------
    // Executa a inserção no banco de dados
    // ---------------------------------------------------
    if ($stmt->execute()) 
        {
        // Caso o comando seja executado com sucesso
        echo "<script>alert('Agendamento confirmado com sucesso!');</script>";
    } else {
        // Caso ocorra algum erro na inserção
        echo "<script>alert('Erro ao agendar: " . $conn->error . "'); window.history.back();</script>";
    }


/* 
Etapa	                 Função

prepare()	     Cria o comando SQL com “?” nos lugares das variáveis
bind_param()	 Liga as variáveis PHP aos “?” e define o tipo de cada uma
execute()	     Envia os dados de forma segura ao banco de dados */

}


// =======================================================
// VERIFICA SE EXISTEM DADOS ENVIADOS VIA GET (PELA URL)
// =======================================================
// Exemplo de URL: processa.php?Agendamento=123&versão=1.0
if (isset($_GET["Agendamento"]) && isset($_GET["versão"])) {
    // Guarda os valores recebidos via GET
    $Agendamento = $_GET["Agendamento"];
    $versao = $_GET["versão"];
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"> <!-- Permite o uso de acentos e caracteres especiais -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ajusta o layout para telas menores -->
    <title>🛠️ Confirmação de Agendamento</title>

    <!-- Importa o arquivo CSS externo que estiliza a página -->
    <link rel="stylesheet" href="styleProcessadados.css">
</head>

<body>
    <!-- Container principal que mostra o resultado do agendamento -->
    <div class="resultado">
        <h1>Agendamento Confirmado</h1>

        <?php
        // =======================================================
        // SE O FORMULÁRIO FOI ENVIADO, MOSTRA OS DADOS CADASTRADOS
        // =======================================================
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Cada linha mostra um campo com seu respectivo valor
            echo "<p><strong>Nome do Cliente:</strong> $cliente_c</p>";
            echo "<p><strong>Telefone:</strong> $telefone_c</p>";
            echo "<p><strong>Eletrodoméstico:</strong> $eletrodomestico_c</p>";
            echo "<p><strong>Data do Atendimento:</strong> $data_c</p>";
            echo "<p><strong>Descrição do Problema:</strong> $descricao_c</p>";
        }

        // =======================================================
        // SE EXISTIREM PARÂMETROS GET NA URL, TAMBÉM MOSTRA ELES
        // =======================================================
        if (isset($Agendamento) && isset($versao)) {
            echo "<hr style='border: 1px solid #059669; margin: 20px 0;'>"; // linha de separação
            echo "<p><strong>Agendamento:</strong> $Agendamento</p>";
            echo "<p><strong>Versão:</strong> $versao</p>";
        }
        ?>

        <!-- Botão para retornar à página inicial do formulário -->
        <a href="index.php" class="voltar">⬅ Voltar ao Formulário</a>
    </div>

    <!-- Rodapé fixo com créditos -->
    <footer>
        © 2025 <span>Eletro Soluções</span> — Agendamento de Eletrodomésticos 🏪 | Desenvolvido por Gabriel da Silva Machado
    </footer>
</body>
</html>

