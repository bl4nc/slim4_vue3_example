<?php

namespace App\Frontend\Controllers;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class LoginController
{
    public function __invoke(Request $request, Response $response, $args)
    {
        $phpView = new PhpRenderer(
            "src/Frontend/Pages",
            ["title" => "Login"]
        );
        return $phpView->render($response, "Login/main.php", $args);
    }
}