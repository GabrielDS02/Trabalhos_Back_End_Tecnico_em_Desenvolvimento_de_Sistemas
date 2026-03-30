function calculo()
{
    $num_pessoas = document.getElementById("num_pessoas").value;

    if ($num_pessoas > 30)
    {
        $resposta = "iluminação em potência maxima (praça muito movimentada)";
    }
    else if ($num_pessoas > 15 && $num_pessoas <= 30)
    {
        $resposta = "iluminação em potência média (movimento moderado)";
    }
    else if ($num_pessoas < 15)
    {
        $resposta = "iluminação em potência baixa (pouco movimento)";
    }

    $descricao = document.getElementById("descrição_resposta").innerHTML = $resposta;
}