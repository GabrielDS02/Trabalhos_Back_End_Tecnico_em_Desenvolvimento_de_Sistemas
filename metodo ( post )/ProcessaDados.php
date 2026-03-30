<?php
if($_SERVER ["REQUEST_METHOD"] == "POST")
    {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $ginecologista = $_POST["ginecologista"];

    echo "<strong>Dados recebidos para avaliação: </strong></br>";
    echo "<br>";
    echo "<strong> usuario: </strong>". $usuario ."</br>";
    echo "<strong> senha: </strong>". $senha ."</br>";
    echo "<strong> já realizou o teste: </strong>". $ginecologista ."</br>";
    }
?>