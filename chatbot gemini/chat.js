const chat = document.getElementById("chat");
const campoMensagem = document.getElementById("campoMensagem");
const digitando = document.getElementById("digitando");
const btnImg = document.querySelector(".btn-img");

let imagemBase64 = null;

// Mostrar mensagem no chat
function adicionarMensagem(texto, tipo = "bot") {
    const msg = document.createElement("div");
    msg.className = `msg ${tipo}`;

    const avatar = document.createElement("img");
    avatar.className = "avatar";
    avatar.src = tipo === "user" ? "avatar.webp" : "enfermeira.png";

    const span = document.createElement("span");
    span.innerText = texto;

    msg.appendChild(avatar);
    msg.appendChild(span);
    chat.appendChild(msg);

    chat.scrollTop = chat.scrollHeight;
}

// Enviar mensagem
async function enviarMensagem() {
    let texto = campoMensagem.value.trim();
    if (!texto && !imagemBase64) return;

    adicionarMensagem(texto || "📎 Imagem enviada", "user");
    campoMensagem.value = "";

    digitando.style.display = "flex";

    const formData = new FormData();
    formData.append("mensagem", texto);

    if (imagemBase64) 
    {
        formData.append("imagem", imagemBase64);
    }

    const resposta = await fetch("gemini.php", {
        method: "POST",
        body: formData
    });

    digitando.style.display = "none";
    imagemBase64 = null;

    const data = await resposta.json();
    console.log(data);

    let textoResposta = data?.candidates?.[0]?.content?.parts?.[0]?.text || "❌ Erro!"

    adicionarMensagem(textoResposta, "bot");
}


// Enviar com ENTER
campoMensagem.addEventListener("keypress", (e) => {
    if (e.key === "Enter") enviarMensagem();
});


// Upload de imagem 📎
btnImg.addEventListener("click", () => {
    let input = document.createElement("input");
    input.type = "file";
    input.accept = "image/*";
    input.onchange = () => {
        let file = input.files[0];
        let reader = new FileReader();
        reader.onload = () => {
            imagemBase64 = reader.result.split(",")[1];
            adicionarMensagem("📎 Imagem anexada ✔", "user");
        };
        reader.readAsDataURL(file);
    };
    input.click();
});


// 🎙️ Voz → Texto
function speechToText() 
{
    if (!("webkitSpeechRecognition" in window)) {
        alert("Seu navegador não suporta reconhecimento de voz");
        return;
    }
    const rec = new webkitSpeechRecognition();
    rec.lang = "pt-BR";
    rec.onresult = (e) => (campoMensagem.value = e.results[0][0].transcript);
    rec.start();
}
