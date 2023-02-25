<?php

namespace App\Middleware;

use App\Provider\JwtService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class AuthMiddlewareFront
{
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface
    {
        $token = $_COOKIE['usu_token'] ?? '';

        $decoded = JwtService::Decode($token);
        // Valida se o token que o usuário enviou é valido
        if (!$decoded) {
            unset($_COOKIE['usu_token']);
            setcookie('usu_token', null, -1, '/');
        }
        //Valida se o token expirou 
        $expire = $decoded['exp'] ?? '';
        if (date('Y-m-d H:i:s') > $expire) {
            unset($_COOKIE['usu_token']);
            setcookie('usu_token', null, -1, '/');

        }
        $response = new Response();
        //Envia o usuário para o /
        if (!$_COOKIE['usu_token']) {
            $response = $response->withStatus(302);
            return $response->withHeader('Location', '/');
        }
        $response = new Response();

        //Dados do usuário para usar nas paginas.
        $request = $request->withAttribute(
            'dados_usuario',
            $decoded['user']
        );

        $response = $handler->handle($request);
        return $response;
    }


}