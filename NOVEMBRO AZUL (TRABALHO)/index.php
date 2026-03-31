<?php
// =======================================================
// CONEXÃO COM O BANCO DE DADOS
// =======================================================
$servidor = "nome do servidor";
$usuario  = "usuario do servidor";
$senha    = "senha do servidor";
$banco    = "nome do banco de dados utilizado";
$port     = "porta utilizada";

$conn = new mysqli($servidor, $usuario, $senha, $banco, $port);

if ($conn->connect_error) {
    die("Falha na conexão ❌: " . $conn->connect_error);
}

mysqli_set_charset($conn, "utf8");
session_start();

// Variável para controle do formulário visível
$form_login_ativo = false;

// =======================================================
// CADASTRO
// =======================================================
if ($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_POST["acao"])) {
    $nome_c   = trim($_POST["nome"]);
    $cpf_c    = trim($_POST["cpf"]);
    $idade_c  = trim($_POST["idade"]);
    $data_c   = trim($_POST["data"]);

    // Remove formatação do CPF
    $cpf_limpo = preg_replace('/\D/', '', $cpf_c);

    // Validação básica de campos
    if ($nome_c === "" || $cpf_c === "" || $idade_c === "" || $data_c === "") {
        echo "<script>alert('Nenhum campo pode ficar em branco.'); window.history.back();</script>";
        exit;
    }

    // ======= Função para validar CPF =======
    function validarCPF($cpf) {
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) return false;

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) 
                {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) return false;
        }
        return true;
    }

    // ======= Validação do CPF =======
    if (!validarCPF($cpf_limpo)) 
    {
        echo "<script>alert('❌ CPF inválido. Verifique os números e tente novamente.'); window.history.back();</script>";
        exit;
    }

    // ======= Cadastro no banco =======
    $stmt = $conn->prepare("INSERT INTO USUARIOS (nome, cpf, idade, data_consulta) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $nome_c, $cpf_c, $idade_c, $data_c);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Cadastro confirmado com sucesso!');</script>";
    } else {
        echo "<script>alert('❌ Erro ao cadastrar: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

// =======================================================
// LOGIN
// =======================================================
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["acao"]) && $_POST["acao"] === "login") {
    $cpf_login_c = trim($_POST["cpf_login"]);

    $query = $conn->prepare("SELECT * FROM USUARIOS WHERE cpf = ?");
    $query->bind_param("s", $cpf_login_c);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["cpf"] = $cpf_login_c;
        echo "<script>window.location.href='a.php';</script>";
        exit;
    } else {
        echo "<script>alert('❌ CPF não encontrado. Faça seu cadastro primeiro.');</script>";
        $form_login_ativo = true; // mantém o login ativo
    }

    $query->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Campanha Novembro Azul</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<!-- CSS -->
<link rel="stylesheet" href="css/style.css">

<!-- JS de validação do CPF -->
<script src="JavaScript/CpfValidado.js" defer></script>


    <link rel="manifest" href="manifest/manifest.txt">

    <meta charset="UTF-8"> <!-- Define a codificação do texto como UTF-8 (suporta acentos, emojis e caracteres especiais) -->
    <meta name="theme-color" content="#2b2b2b"> <!-- Cor da barra do navegador no celular e do tema quando o PWA é instalado -->
    <meta name="theme-color" content="#ffffff"> <!-- detectar se o manifest e o pwa esta certo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ajusta a página para ser responsiva em celulares (usa largura real da tela e zoom inicial 100%) -->


    <!-- Ícone do app -->
    <link rel="icon" href="assets/NovembroAzulLogo 192x192.png" type="image/png">

</head>

<body>
<!-- Bolhas decorativas -->
<div class="bubble"></div>
<div class="bubble"></div>
<div class="bubble"></div>

<!-- Conteúdo principal -->
<div class="container">
    <h1>💙 Novembro Azul</h1>
    <p>Cuide da sua saúde! Faça seu cadastro e agende sua consulta preventiva.</p>

    <!-- FORMULÁRIO DE CADASTRO -->
    <form id="cadastroForm" method="POST">
        <div>
            <label for="nome">Nome completo</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
        </div>

        <div>
            <label for="cpf">CPF</label>
            <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>
        </div>

        <div>
            <label for="idade">Idade</label>
            <input type="number" id="idade" name="idade" min="18" max="120" placeholder="Digite sua idade" required>
        </div>

        <div>
            <label for="data">Data da consulta</label>
            <input type="date" id="data" name="data" required>
        </div>

        <button type="submit">CADASTRAR</button>
    </form>

    <!-- FORMULÁRIO DE LOGIN -->
    <form id="loginForm" method="POST" class="login" style="<?php echo $form_login_ativo ? 'display:block;' : 'display:none;'; ?>">
        <input type="hidden" name="acao" value="login">
        <h2 style="color:#1565c0; margin-bottom:15px;">🔐 Login</h2>
        <p>Digite seu CPF para acessar sua área</p>
        <div>
            <label for="cpf_login">CPF</label>
            <input type="text" id="cpf_login" name="cpf_login" placeholder="000.000.000-00" required>
        </div>
        <button type="submit">ENTRAR</button>
    </form>

    <footer>Campanha de prevenção — Novembro Azul 💙</footer>
</div>

<script>
const cadastroForm = document.getElementById("cadastroForm");
const loginForm = document.getElementById("loginForm");

cadastroForm.addEventListener("submit", function (e) {
  e.preventDefault();

  // Aqui você pode enviar para o PHP via fetch (sem recarregar)
  const dados = new FormData(cadastroForm);

  fetch("index.php", {
    method: "POST",
    body: dados
  })
    .then(res => res.text())
    .then(resposta => {
      alert("✅ Cadastro realizado com sucesso!");
      
      // Esconde o cadastro e mostra o login
      cadastroForm.style.display = "none";
      loginForm.style.display = "block";
    })
    .catch(() => alert("❌ Erro ao enviar cadastro!"));
});
</script>

<script>
if ("serviceWorker" in navigator) 
{
    navigator.serviceWorker.register("/sw.js")
        .then(() => console.log("✅ Service Worker registrado"))
        .catch(err => console.error("❌ Erro no SW", err));
}
</script>


</body>
</html>
