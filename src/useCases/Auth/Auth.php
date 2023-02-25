<?php

namespace App\UseCases\Auth;

use App\DAO\UsuarioDAO;
use App\Provider\JwtService;


abstract class Auth
{
    public static function execute(string $login, string $senha): array
    {
        if ($login == '' || $senha == '') {
            return array(
                "success" => false,
                "message" => "Credenciais não enviadas"
            );
        }

        $DAO = new UsuarioDAO;
        $user = $DAO->getUsuarioData($login, $senha);

        if (count($user) == 0) {
            return array(
                "success" => false,
                "message" => "Credenciais invalidas!"
            );
        }

        $payload = array(
            "user" => $user,
            "exp" => date("Y-m-d H:i:s", strtotime("+ 1 DAYS")),
        );

        $token = JwtService::EncodeJwt($payload);
        if (!$token) {
            return array(
                "success" => false,
                "message" => "Erro ao gerar Token"
            );
        }

        return array(
            "success" => true,
            "message" => "Autenticado.",
            "token" => $token
        );
    }
}