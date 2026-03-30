<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eletro Soluções — Agendamento de Conserto</title>

  <!-- css da pagina-->
  <link rel="stylesheet" href="style.css"></link>

    <link rel="manifest" href="manifest.txt">

    <meta charset="UTF-8"> <!-- Define a codificação do texto como UTF-8 (suporta acentos, emojis e caracteres especiais) -->
    <meta name="theme-color" content="#2b2b2b"> <!-- Cor da barra do navegador no celular e do tema quando o PWA é instalado -->
    <meta name="theme-color" content="#ffffff"> <!-- detectar se o manifest e o pwa esta certo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ajusta a página para ser responsiva em celulares (usa largura real da tela e zoom inicial 100%) -->

    <!-- Ícone do app -->
    <link rel="icon" href="assets/LogoEletroSolucoes 192x192 .png" type="image/png">

<body>

  <!-- 🎥 Vídeo de fundo -->
  <video autoplay muted loop id="bg-video">
    <source src="loja.mp4" type="video/mp4">
    Seu navegador não suporta vídeos em HTML5.
  </video>

  <!-- 🧾 Formulário -->
  <div class="form-container">
    <h1>🛠️ Agendamento de Conserto</h1>
    <p class="subtitle">Preencha os dados abaixo para solicitar o atendimento técnico</p>

    <form id="form-agendamento" action="processadados.php?Agendamento=Eletrodomesticos&versao=3.0" method="post">

      <label for="cliente">Nome do Cliente</label>
      <input type="text" id="cliente" name="cliente" placeholder="Ex: João da Silva" required>

      <label for="telefone">Telefone</label>
      <input type="text" id="telefone" name="telefone" placeholder="(DDD) 99999-9999" required>

      <label for="eletrodomestico">Tipo de Aparelho</label>
      <select id="eletrodomestico" name="eletrodomestico" required>
        <option value="" style="color: #0f172a">Selecione...</option>
        <option value="geladeira" style="color: #0f172a">Geladeira</option>
        <option value="micro-ondas" style="color: #0f172a">Micro-ondas</option>
        <option value="maquina-de-lavar" style="color: #0f172a">Máquina de lavar</option>
        <option value="fogao" style="color: #0f172a">Fogão</option>
        <option value="outro" style="color: #0f172a">Outro</option>
      </select>

      <label for="data">Data do Atendimento</label>
      <input type="date" id="data" name="data" required>

      <label for="descricao">Descrição do Problema</label>
      <textarea type="text" id="descricao" name="descricao" rows="5" placeholder="Descreva o defeito do aparelho..." required></textarea>

      <button type="submit">Agendar Atendimento</button>
    </form>
  </div>

  <!-- 🔻 Rodapé -->
  <footer>
    © 2025 <span>Eletro Soluções</span> — Sistema de Agendamento de Conserto | Desenvolvido por Gabriel da Silva Machado
  </footer>

<script> // salva o sw logo na index para o (pwa e todas aas paginas)
    if ("serviceWorker" in navigator) 
    {
    navigator.serviceWorker.register("/sw.js")
        .then(() => console.log("✅ Service Worker registrado"))
        .catch(err => console.error("❌ Erro no SW", err));
    }
</script>




<script>
// ===============================
// FUNÇÃO DE MÁSCARA DE TELEFONE
// ===============================
function formatPhone(input) 
{
  // Remove todos os caracteres que não são números (mantém só dígitos)
  let value = input.value.replace(/\D/g, "");

  // Aplica formato dinâmico conforme a quantidade de números digitados:
  if (value.length > 10) {
    // Exemplo: (31) 98888-7777 → 11 dígitos (celular com 9)
    value = value.replace(/^(\d{2})(\d{5})(\d{4}).*/, "($1) $2-$3");
  } else if (value.length > 6) {
    // Exemplo: (31) 3888-7777 → 10 dígitos (telefone fixo)
    value = value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, "($1) $2-$3");
  } else if (value.length > 2) {
    // Exemplo: (31) 3 → Começo da digitação após DDD
    value = value.replace(/^(\d{2})(\d{0,5})/, "($1) $2");
  } else {
    // Exemplo: (3 → ainda digitando o DDD
    value = value.replace(/^(\d*)/, "($1");
  }

  // Atualiza o valor do campo com a máscara formatada
  input.value = value;
}

// ========================================
// FUNÇÃO DE VALIDAÇÃO DO FORMATO TELEFONE
// ========================================
function isValidPhone(phone) {
  // Remove tudo que não for número
  const digits = phone.replace(/\D/g, "");
  
  // Telefone válido tem 10 ou 11 dígitos (DDD + número)
  return digits.length >= 10 && digits.length <= 11;
}

// =========================================
// APLICA A MÁSCARA AO CAMPO DE TELEFONE
// =========================================
const phoneInput = document.getElementById("telefone");

// Se o campo existir (garantia de segurança)
if (phoneInput) {
  // Toda vez que o usuário digitar algo, a máscara é aplicada
  phoneInput.addEventListener("input", () => formatPhone(phoneInput));
}

// ============================================
// VALIDAÇÃO FINAL DO FORMULÁRIO AO ENVIAR
// ============================================
const form = document.getElementById("form-agendamento");

if (form) {
  form.addEventListener("submit", (event) => {
    const phoneValue = phoneInput.value;

    // Se o telefone for inválido, cancela o envio e mostra alerta
    if (!isValidPhone(phoneValue)) {
      event.preventDefault(); // impede o envio do formulário
      alert("⚠️ Por favor, digite um número de telefone válido (DDD + número).");
    }
  });
}
</script>

</body>
</html>
