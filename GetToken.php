<?php

class GetToken
{
    protected $url = "http://webservice.eorbit.com.br";

    public function token($usuario, $senha, $cliente)
    {
        $this->url .= "/auth";

        $headers = [
            'Content-Type:application/json',
            'X-Life-Sistemas-Id-Cliente:'.$cliente
        ];

        $post_data = array(
            "login"=>$usuario,
            "senha"=>$senha
        );

        $sessao = curl_init();

        curl_setopt($sessao, CURLOPT_URL, $this->url);

        curl_setopt($sessao, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($sessao, CURLOPT_POST, true);

        curl_setopt($sessao, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($sessao, CURLOPT_POSTFIELDS, $post_data);

        $output = curl_exec($sessao);

        curl_close($sessao);

//        print_r(json_decode($output, true));
        echo $output;
    }
    public function test()
    {
        $this->url .= "/test";
        $headers = [
            'Content-Type:application/json',
            'X-Life-Sistemas-Id-Cliente:teste'
        ];
        $sessao = curl_init();
        curl_setopt($sessao, CURLOPT_URL, $this->url);

        curl_setopt($sessao, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($sessao, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($sessao);

        curl_close($sessao);
        echo "Resultado: " . $output;
    }

}