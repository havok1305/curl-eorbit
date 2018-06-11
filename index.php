<?php
require 'ApiClient.php';

$client = new ApiClient('teste');

// pega o token
// não é necessário gerar um token toda vez que precisar realizar uma requisição
// é necessário apenas quando ainda não possui um token ou se ele tiver expirado (a cada 60 minutos ele expira)
$token = $client->getToken('elysio', 'elysio');

if($token) {
    // inserção para alunos de GRADUAÇÃO
    $dados = [
        "tipo"=> "GRA",
        "matricula"=> "0120130527",
        "data_vencimento" => "2018-".rand(1,12)."-".rand(1,30),
        "valor" => rand(1.1,70.99),
        "mensagem_boleto" => "lançamento teste",
        "id_multa" => rand(1000,99999)
    ];

    $resposta = $client->insereMulta($dados, $token);
    if($resposta['status']) {
        echo "<br>Lançamento inserido com sucesso.";
    } else {
        echo "<br>Não foi possível inserir o lançamento Erro: ".$resposta['message'];
    }

    // inserção para alunos de POS-GRADUAÇÃO
    $dados = [
        "tipo"=> "POS",
        "matricula"=> "81820160008",
        "data_vencimento" => "2018-".rand(1,12)."-".rand(1,30),
        "valor" => rand(1.1,70.99),
        "mensagem_boleto" => "lançamento teste",
        "id_multa" => rand(1000,99999)
    ];

    $resposta = $client->insereMulta($dados, $token);

    if($resposta['status']) {
        echo "<br>Lançamento inserido com sucesso.";
    } else {
        echo "<br>Não foi possível inserir o lançamento Erro: ".$resposta['message'];
    }

    // inserção para usuários usando o CPF
    $dados = [
        "tipo"=> "EXT",
        "cpf"=> "146.716.418-60",
        "data_vencimento" => "2018-".rand(1,12)."-".rand(1,30),
        "valor" => rand(1.1,70.99),
        "mensagem_boleto" => "lançamento teste",
        "id_multa" => rand(1000,99999)
    ];

    $resposta = $client->insereMulta($dados, $token);
    if($resposta['status']) {
        echo "<br>Lançamento inserido com sucesso.";
    } else {
        echo "<br>Não foi possível inserir o lançamento. Erro: ".$resposta['message'];
    }

} else {
    echo "<br>Não foi possível pegar o token.";
}
