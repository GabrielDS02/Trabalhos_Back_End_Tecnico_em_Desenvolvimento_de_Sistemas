<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

// 🔑 SUA API KEY
$api_key = "AIzaSyAblyKiJVqwJbTKKW0gBkM5cV_eZC6l5SQ"; 

$texto = $_POST['mensagem'] ?? "";
$imagem = $_POST['imagem'] ?? null;
 
if (!$texto && !$imagem) {
    echo json_encode(["error" => "Nenhum conteúdo recebido"]);
    exit;
}

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $api_key;

// ===============================
// CONSTRUÇÃO DOS PARTS (TEXTO + IMAGEM)
// ===============================
$parts = [];

if (!empty($texto)) {
    $parts[] = ["text" => $texto];
}

if (!empty($imagem)) {
    $parts[] = [
        "inlineData" => [
            "mimeType" => "image/png", // funciona para PNG e JPG
            "data" => $imagem           // Base64 sem o prefixo "data:image/png..."
        ]
    ];
}

$payload = [
    "contents" => [
        [
            "role" => "user",
            "parts" => $parts
        ]
    ]
];

// ===============================
// CURL PARA GEMINI
// ===============================
$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
    CURLOPT_POSTFIELDS => json_encode($payload)
]);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode(["error" => curl_error($ch)]);
    curl_close($ch);
    exit;
}

curl_close($ch);

// ===============================
// TRATAMENTO DE RESPOSTA
// ===============================
$data = json_decode($response, true);

// Se o Google der erro, retornamos uma mensagem genérica
if (isset($data["error"])) {
    echo json_encode([
        "candidates" => [
            [
                "content" => [
                    "parts" => [
                        [
                            "text" => "⚠️ Ocorreu um erro ao gerar a resposta. Verifique sua API Key ou tente novamente."
                        ]
                    ]
                ]
            ]
        ]
    ]);
    exit;
}

// Se não vier texto algum, devolver algo seguro
$textoGemini = $data["candidates"][0]["content"]["parts"][0]["text"] ?? "⚠️ Não consegui gerar resposta.";

// Sempre retornar no formato esperado pelo seu JS
echo json_encode([
    "candidates" => [
        [
            "content" => [
                "parts" => [
                    ["text" => $textoGemini]
                ]
            ]
        ]
    ]
]);

?>
