<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$num1 = 23;
$num2 = 46;

// contas
$soma = ($num1 + $num2);
$subtracao1 = ($num1 - $num2);
$subtracao2 = ($num2 - $num1);
$multiplicação = ($num1 * $num2);
$divisao1 = ($num1 / $num2);
$divisao2 = ($num2 / $num1);

echo "</br>";
echo "<strong>primeiro numero: ".$num1."</br></strong>";
echo "<strong>segundo numero: ".$num2."</br></strtong>";
echo "</br>";

echo "______________________________________________________________________________________________________________________</br>";

echo "</br>";
echo "<strong> Contas: </br><strong>";
echo "</br>";
// prints

echo "<strong> a soma: do primeiro numero: ".$num1." mais o segudo numero: ".$num2." e igual a: ".$soma."</br></strong>";
echo "a subtração: do primeiro numero: ".$num1." menos o segudo numero: ".$num2." e igual a: ".$subtracao1."</br>";
echo "a subtração: do segundo numero: ".$num2." menos o primeiro numero: ".$num1." e igual a: ".$subtracao2."</br>";
echo "a multiplicação: do primeiro numero: ".$num1." vezes o segudo numero: ".$num2." e igual a: ".$multiplicação."</br>";
echo "a divisão: do primeiro numero: ".$num1." dividido pelo segudo numero: ".$num2." e igual a: ".$divisao1."</br>";
echo "a divisão: do segundo numero: ".$num2." dividido pelo primeiro numero: ".$num1." e igual a: ".$divisao2."</br>";
echo "</br>";

echo "______________________________________________________________________________________________________________________</br>";

echo "</br>";
echo "Condicionais de Divisão: </br>";
echo "</br>";
// condições

if ($divisao1 > 2)
{
    echo "a divisão: do primeiro numero: ".$num1." dividido pelo segudo numero: ".$num2." O resultado e maior que 2 </br>";

}
else if ($divisao2 > 2)
{
    echo "a divisão: do segundo numero: ".$num2." dividido pelo primeiro numero: ".$num1." O resultado e maior que 2 </br>";
}



if ($divisao1 === 2)
{
    echo "a divisão: do primeiro numero: ".$num1." dividido pelo segudo numero: ".$num2." O resultado e exatamente igual a 2 </br>";

}
else if ($divisao2 === 2)
{
    echo "a divisão: do segundo numero: ".$num2." dividido pelo primeiro numero: ".$num1." O resultado e exatamente igual a 2 </br>";
}



if ($divisao1 < 2)
{
    echo "a divisão: do primeiro numero: ".$num1." dividido pelo segudo numero: ".$num2." O resultado e menor que 2 </br>";

}
else if ($divisao2 < 2)
{
    echo "a divisão: do segundo numero: ".$num2." dividido pelo primeiro numero: ".$num1." O resultado e menor que 2 </br>";
}




echo "<br>______________________________________________________________________________________________________________________</br>";



?>
<br>
<a href ="desce"><em>DO PRÓPRIO AUTOR: </em></a><span style="text-decoration: underline;"><strong>    Gabriel da Silva Machado</strong></span></em>

<style>
    html, body 
    {
        height: 100%;              /* garante que o body ocupe toda a tela */
        margin: 0;
        padding: 0;
    }
    body 
    {
        font-family: Arial, sans-serif; /* fonte do texto */
        margin: 0; /* remove margens padrão */
        padding: 0; /* remove padding padrão */
        background-image: url("FundoFlor.jpg"); /* chama a imagem pelo nome e backgorud image, adiciona a imagem ao fundo do site */
        background-size: cover;       /* cobre toda a tela */
        background-position: center;  /* centraliza a imagem */
        background-repeat: no-repeat; /* não repete a imagem */
        background-attachment: fixed; /* fixa a imagem ao rolar */
    }
</style>
</html>
