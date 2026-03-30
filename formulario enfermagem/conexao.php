<?php
    // Dados do servidor MySQL no InfinityFree
    $servidor = "sql102.infinityfree.com";   
    $usuario  = "if0_40052179";              
    $senha    = "Familia05456";              
    $banco    = "if0_40052179_FormularioEnfermagem";    
    $port     = 3306;                        

    // Criar conexão
    $conn = new mysqli($servidor, $usuario, $senha, $banco, $port);

    // Verificar conexão
    if ($conn->connect_error) 
        {
        die("❌ Falha na conexão: " . $conn->connect_error);
        }

    echo "<h1 style='position: absolute; top: 0; left: 210px;'>✅</h1>";
?>