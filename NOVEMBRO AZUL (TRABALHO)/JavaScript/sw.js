// =======================
// 📦 Configuração de Cache
// =======================
const CACHE_NAME = "groozyshop-v1";
const DYNAMIC_CACHE = "groozyshop-dinamico";

// =======================
// 📂 Arquivos Essenciais (cache estático)
// =======================
const ASSETS = [
  // 🌐 Raiz e principais páginas
  "/",
  "/index.html",
  "/AreaDoVendedor.html",
  "/atendimento.html",
  "/autenticacao.php",
  "/autenticacaoparamudarsenha.html",
  "/cadastro.html",
  "/contato.html",
  "/LOGIN_CLIENTE.html",
  "/loginVendedor.html",
  "/login.php",
  "/vendedorLogin.html",
  "/transicaoLoginCadastro.html",
  "/TRANSICAOPAGINAPRINCIPALELOGINS.html",
  "/TrocasDevolucao.html",
  "/SobreNós.html",
  "/politicadeprivacidade.html",
  "/paginaDe5imagens.html",
  "/paginadeapresentacao.html",
  "/styleMapa.css",

  // 🧩 PHP e conexões
  "/conexao.php",
  "/CadastrophpCliente.php",
  "/MudarSenha.php",

  // 🎨 CSS
  "/5PaginasCSS.css",
  "/cssParaAs5interacoes.css",
  "/cadastro css.css",
  "/login css.css",
  "/pagina_de_apresentacao.css",

  // ⚙️ JavaScript
  "/app.js",
  "/GrozzzyShop.js",
  "/FuncoesAssincronas.js",
  "/sw.js",

  // 📱 PWA Manifest
  "/manifest.json",

  // 🖼️ Ícones e imagens
  "/logo Groozy Shop.png",
];

// =======================
// 📦 Instalação do Service Worker (cache inicial)
// =======================
self.addEventListener("install", event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      console.log("📦 Caching estático inicial (GroozyShop)...");
      return cache.addAll(ASSETS);
    })
  );
});

// =======================
// ♻️ Ativação (limpa caches antigos)
// =======================
self.addEventListener("activate", event => {
  event.waitUntil(
    caches.keys().then(keys => {
      return Promise.all(
        keys
          .filter(key => key !== CACHE_NAME && key !== DYNAMIC_CACHE)
          .map(key => caches.delete(key))
      );
    })
  );
});

// =======================
// 🔄 Estratégia de busca: Cache First + Dynamic Cache
// =======================
self.addEventListener("fetch", event => {
  event.respondWith(
    caches.match(event.request).then(response => {
      if (response) {
        return response; // retorna do cache se já existir
      }

      return fetch(event.request)
        .then(res => {
          return caches.open(DYNAMIC_CACHE).then(cache => {
            if (event.request.url.startsWith("http")) {
              cache.put(event.request, res.clone());
            }
            return res;
          });
        })
        .catch(() => {
          // fallback: se for imagem e falhar, mostra ícone do logo
          if (event.request.destination === "image") {
            return caches.match("/logo Groozy Shop.png");
          }
        });
    })
  );
});
