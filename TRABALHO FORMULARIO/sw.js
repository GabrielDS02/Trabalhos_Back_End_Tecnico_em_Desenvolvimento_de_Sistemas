// =======================
// 📦 Configuração de Cache
// =======================
const CACHE_NAME = "supermercado-v1";
const DYNAMIC_CACHE = "supermercado-dinamico";

// =======================
// 📂 Arquivos Essenciais (cache estático)
// =======================
const ASSETS = 
[
  // raiz
  "/",                  
  "/index.html",
  "/manifest.txt",
  "/conexao.php",
  "/loja.mp4",
  "/processadados.php",
  "/style.css",
  "/styleprocessadados.css"
];

// 📦 Instalação do Service Worker (cache inicial)
self.addEventListener("install", event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      console.log("📦 Caching estático inicial...");
      return cache.addAll(ASSETS);
    })
  );
});

// ♻️ Ativação do Service Worker (limpa caches antigos)
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

// 🔄 Estratégia de busca: Cache First + Dynamic Cache
self.addEventListener("fetch", event => {
  event.respondWith(
    caches.match(event.request).then(response => {
      if (response) {
        return response; // retorna do cache se já existir
      }

      // caso não tenha no cache, busca online e salva no cache dinâmico
      return fetch(event.request).then(res => {
        return caches.open(DYNAMIC_CACHE).then(cache => {
          if (event.request.url.startsWith("http")) {
            cache.put(event.request, res.clone());
          }
          return res;
        });
      }).catch(() => {
        // fallback: se for imagem e falhar, mostra fundo padrão
        if (event.request.destination === "image") {
          return caches.match("/src/css/imagemDeFundo/fundo.jpg");
        }
      });
    })
  );
});
