/* ---------- FUNÇÕES ÚTEIS ---------- */
function onlyDigits(str) {
  return str.replace(/\D+/g, '');
}

function formatCPF(value) {
  const digits = onlyDigits(value).slice(0, 11);
  // Formata: 000.000.000-00
  let part1 = digits.slice(0, 3);
  let part2 = digits.slice(3, 6);
  let part3 = digits.slice(6, 9);
  let part4 = digits.slice(9, 11);
  let formatted = part1;
  if (part2) formatted += '.' + part2;
  if (part3) formatted += '.' + part3;
  if (part4) formatted += '-' + part4;
  return formatted;
}

function isRepeatedSequence(cpf) 
{
  return /^(\d)\1{10}$/.test(cpf);
}

function validateCPF(raw) {
  const cpf = onlyDigits(raw);
  if (cpf.length !== 11) return false;
  if (isRepeatedSequence(cpf)) return false;

  const nums = cpf.split('').map(d => parseInt(d, 10));

  // primeiro dígito verificador
  let sum = 0;
  for (let i = 0; i < 9; i++) {
    sum += nums[i] * (10 - i);
  }
  let rem = sum % 11;
  let dig1 = (rem < 2) ? 0 : 11 - rem;
  if (dig1 !== nums[9]) return false;

  // segundo dígito verificador
  sum = 0;
  for (let i = 0; i < 10; i++) {
    sum += nums[i] * (11 - i);
  }
  rem = sum % 11;
  let dig2 = (rem < 2) ? 0 : 11 - rem;
  if (dig2 !== nums[10]) return false;

  return true;
}

/* ---------- MANIPULAÇÃO DO INPUT ---------- */
document.addEventListener('DOMContentLoaded', function () {
  const cpfInput = document.getElementById('cpf');
  if (!cpfInput) return;

  // Cria um span para mostrar mensagens (se já existir, usa-o)
  let msg = document.getElementById('cpf-msg');
  if (!msg) {
    msg = document.createElement('div');
    msg.id = 'cpf-msg';
    msg.style.fontSize = '0.9rem';
    msg.style.marginTop = '6px';
    msg.style.minHeight = '18px';
    msg.setAttribute('aria-live', 'polite');
    cpfInput.parentNode.appendChild(msg);
  }

  // Formata enquanto digita
  cpfInput.addEventListener('input', function (e) {
    const previous = e.target.value;
    const caret = e.target.selectionStart;

    // mantém apenas números e limita a 11
    const digits = onlyDigits(previous).slice(0, 11);
    const formatted = formatCPF(digits);

    e.target.value = formatted;

    // move o caret para o fim - simples e confiável
    // (se quiser preservar posição exata, requer lógica extra)
    e.target.setSelectionRange(formatted.length, formatted.length);

    // remove feedback enquanto o usuário digita
    e.target.classList.remove('valid', 'invalid');
    msg.textContent = '';
  });

  // Impede teclas não numéricas (exceto Backspace, Delete, setas, Tab)
  cpfInput.addEventListener('keydown', function (e) {
    const allowed = [
      'Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Home', 'End'
    ];
    if (allowed.includes(e.key)) return;
    // Permite Ctrl/Cmd+A/C/V/X
    if (e.ctrlKey || e.metaKey) return;

    // Se não for dígito, bloqueia
    if (!/\d/.test(e.key)) {
      e.preventDefault();
    }
  });

  // Ao sair do campo, valida e mostra feedback
  cpfInput.addEventListener('blur', function (e) {
    const val = e.target.value;
    if (val.trim() === '') {
      e.target.classList.remove('valid', 'invalid');
      msg.textContent = '';
      return;
    }
    const ok = validateCPF(val);
    if (ok) {
      e.target.classList.add('valid');
      e.target.classList.remove('invalid');
      msg.style.color = '#2e7d32'; // verde
      msg.textContent = 'CPF válido ✅';
    } else {
      e.target.classList.add('invalid');
      e.target.classList.remove('valid');
      msg.style.color = '#c62828'; // vermelho
      msg.textContent = 'CPF inválido — verifique os números.';
    }
  });

  // Se necessário, revalida antes de submeter o formulário
  const form = cpfInput.form;
  if (form) {
    form.addEventListener('submit', function (ev) {
      const ok = validateCPF(cpfInput.value);
      if (!ok) {
        ev.preventDefault();
        cpfInput.focus();
        cpfInput.classList.add('invalid');
        msg.style.color = '#c62828';
        msg.textContent = 'CPF inválido — corrija antes de enviar.';
      }
    });
  }
});

/* ---------- LOGIN CPF ---------- */
document.addEventListener('DOMContentLoaded', function () {
  const cpfLoginInput = document.getElementById('cpf_login');
  if (!cpfLoginInput) return;

  // Cria um span para mensagens (se não existir)
  let msgLogin = document.getElementById('cpf-login-msg');
  if (!msgLogin) {
    msgLogin = document.createElement('div');
    msgLogin.id = 'cpf-login-msg';
    msgLogin.style.fontSize = '0.9rem';
    msgLogin.style.marginTop = '6px';
    msgLogin.style.minHeight = '18px';
    msgLogin.setAttribute('aria-live', 'polite');
    cpfLoginInput.parentNode.appendChild(msgLogin);
  }

  // Formata enquanto digita
  cpfLoginInput.addEventListener('input', function (e) {
    const digits = onlyDigits(e.target.value).slice(0, 11);
    const formatted = formatCPF(digits);
    e.target.value = formatted;
    e.target.setSelectionRange(formatted.length, formatted.length);

    e.target.classList.remove('valid', 'invalid');
    msgLogin.textContent = '';
  });

  // Impede teclas não numéricas
  cpfLoginInput.addEventListener('keydown', function (e) {
    const allowed = ['Backspace','Delete','ArrowLeft','ArrowRight','Tab','Home','End'];
    if (allowed.includes(e.key)) return;
    if (e.ctrlKey || e.metaKey) return;
    if (!/\d/.test(e.key)) e.preventDefault();
  });

  // Valida ao sair do campo
  cpfLoginInput.addEventListener('blur', function (e) {
    const val = e.target.value;
    if (val.trim() === '') {
      e.target.classList.remove('valid','invalid');
      msgLogin.textContent = '';
      return;
    }
    if (validateCPF(val)) {
      e.target.classList.add('valid');
      e.target.classList.remove('invalid');
      msgLogin.style.color = '#2e7d32';
      msgLogin.textContent = 'CPF válido ✅';
    } else {
      e.target.classList.add('invalid');
      e.target.classList.remove('valid');
      msgLogin.style.color = '#c62828';
      msgLogin.textContent = 'CPF inválido — verifique os números.';
    }
  });

  // Valida antes de enviar o formulário de login
  const loginForm = cpfLoginInput.form;
  if (loginForm) {
    loginForm.addEventListener('submit', function (ev) {
      if (!validateCPF(cpfLoginInput.value)) {
        ev.preventDefault();
        cpfLoginInput.focus();
        cpfLoginInput.classList.add('invalid');
        msgLogin.style.color = '#c62828';
        msgLogin.textContent = 'CPF inválido — corrija antes de enviar.';
      }
    });
  }
});
