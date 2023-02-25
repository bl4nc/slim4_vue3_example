<?php

namespace App\Controllers;

use App\DAO\UsuarioDAO;
use App\Interfaces\Controllers\AuthControllerInterface;
use App\UseCases\Auth\Auth;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class AuthController
{

    public function Auth(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $body = $request->getParsedBody();
        $useCase = Auth::execute($body['login'], sha1($body['senha']));
        $response = $response->withJson($useCase, $useCase['success'] ? 200 : 401);
        return $response;
    }


    public function ValidateToken(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response = $response->withJson(
            array(
                "success" => true,
            )
            ,
            500
        );
        return $response;
    }
}