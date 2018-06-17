<?php

class ApiClient
{
    protected $url = "http://webservice.eorbit.com.br";
    protected $cliente = 'teste';

    public function __construct($cliente = '')
    {
        $this->cliente = $cliente;
    }

    public function getToken($usuario, $senha)
    {
        $url = "/auth";

        $headers = [
            'Content-Type:application/json',
            'X-Life-Sistemas-Id-Cliente:'.$this->cliente
        ];

        $post_data = array(
            "login"=>$usuario,
            "senha"=>$senha
        );

        $resposta = $this->doPost($post_data, $headers, $url);

        if($resposta['status']) {
            return $resposta['token'];
        } else {
            return false;
        }
    }

    public function insereMulta($dados, $token)
    {
        $url = "/lancphl";

        $headers = [
            'Content-Type:application/json',
            'X-Life-Sistemas-Id-Cliente:'.$this->cliente,
            'Authorization:Bearer '.$token
        ];

        return $this->doPost($dados, $headers, $url);
    }

    public function buscaLancamentos($token)
    {
        $url = "/lancamentos?limit=100";
        $headers = [
            'Content-Type:application/json',
            'X-Life-Sistemas-Id-Cliente:'.$this->cliente,
            'Authorization:Bearer '.$token
        ];
        return $this->doGet($headers, $url);
    }

    public function doGet($headers, $url)
    {
        $url = $this->url . $url;

        $sessao = curl_init();

        curl_setopt($sessao, CURLOPT_URL, $url);

        curl_setopt($sessao, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($sessao, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($sessao);

        curl_close($sessao);

        return json_decode($output, true);
    }

    public function doPost($postdata, $headers, $url)
    {
        $url = $this->url . $url;

        $postdata = json_encode($postdata);

        $sessao = curl_init();

        curl_setopt($sessao, CURLOPT_URL, $url);

        curl_setopt($sessao, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($sessao, CURLOPT_POST, true);

        curl_setopt($sessao, CURLOPT_POSTFIELDS, $postdata);

        curl_setopt($sessao, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($sessao);

        curl_close($sessao);

        return json_decode($output, true);
    }
}