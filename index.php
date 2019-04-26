<?php
declare(strict_types=1);
use Bref\Bridge\Slim\SlimAdapter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Bref\Application;

require __DIR__.'/vendor/autoload.php';
// HTTP application using Slim
$slim = new Slim\App;
$slim->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
    $response->getBody()->write(json_encode(['hello' => 'json']));
    $response = $response->withHeader('Content-Type', 'application/json');
    return $response;
});
// Instead of calling `$slim->run()` we use Bref
$slim->run();