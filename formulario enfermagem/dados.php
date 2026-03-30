<?php
session_start(); 
include "conexao.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Coletando dados do formulário
    $p1 = trim($_POST["pergunta1"]);
    $r1 = trim($_POST["resposta1"]);
    $p2 = trim($_POST["pergunta2"]);
    $r2 = trim($_POST["resposta2"]);
    $p3 = trim($_POST["pergunta3"]);
    $r3 = trim($_POST["resposta3"]);
    $p4 = trim($_POST["pergunta4"]);
    $r4 = trim($_POST["resposta4"]);
    $p5 = trim($_POST["pergunta5"]);
    $r5 = trim($_POST["resposta5"]);
    $sugestao = trim($_POST["sugestoes"]);

    // Verificação de campos vazios
    if (
        $p1 === "" || $r1 === "" || $p2 === "" || $r2 === "" ||
        $p3 === "" || $r3 === "" || $p4 === "" || $r4 === "" ||
        $p5 === "" || $r5 === "" || $sugestao === ""
    ) {
        echo "<script>alert('Nenhum campo pode ficar em branco!'); window.history.back();</script>";
        exit;
    }

    // Junta as perguntas em um único TEXT
    $todas_perguntas = 
        "Pergunta 1: $p1\n" .
        "Pergunta 2: $p2\n" .
        "Pergunta 3: $p3\n" .
        "Pergunta 4: $p4\n" .
        "Pergunta 5: $p5";

    // Junta as respostas em um único TEXT
    $todas_respostas =
        "Resposta 1: $r1\n" .
        "Resposta 2: $r2\n" .
        "Resposta 3: $r3\n" .
        "Resposta 4: $r4\n" .
        "Resposta 5: $r5";

    // Prepara o SQL CORRETO
    $sql = "INSERT INTO chatbot_perguntas (pergunta, resposta, sugestao)
            VALUES ('$todas_perguntas', '$todas_respostas', '$sugestao')";

    // Executa
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Dados salvos com sucesso!'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Erro ao salvar: " . mysqli_error($conn) . "');</script>";
    }

}
?>
