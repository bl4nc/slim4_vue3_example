<?php

namespace App\Frontend\Controllers;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class HomeController
{
    public function __invoke(Request $request, Response $response, $args)
    {
        $phpView = new PhpRenderer(
            "src/Frontend/Pages",
            ["title" => "Home"]
        );
        return $phpView->render($response, "Home/Home.php", $args);
    }
}