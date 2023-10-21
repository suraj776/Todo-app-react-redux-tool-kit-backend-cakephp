<?php
declare(strict_types = 1);

// src/Middleware/CorsMiddleware.php
namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

class CORSMiddleware implements MiddlewareInterface
{

    /**
     *
     * {@inheritdoc}
     * @see \Psr\Http\Server\MiddlewareInterface::process()
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);
        $response = $this->setHeaders($request, $response);

        return $response;
    }

    public function setHeaders(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if ($request->getHeader('Origin')) {
            $allowedDomains = [
                'https://myapp.it',
                'https://www.myapp.it',
                'http://localhost:3000'
            ];

            $origins = $request->getHeader('Origin');
            $lastOrigin = end($origins);
            if (in_array($lastOrigin, $allowedDomains, true)) {
                $response = $response->withHeader('Access-Control-Allow-Origin', $lastOrigin);
            }

            if (strtoupper($request->getMethod()) === 'OPTIONS') {
                $response = $response->withHeader('Access-Control-Allow-Methods', 'POST, GET, PUT, PATCH, DELETE, OPTIONS')->withHeader('Access-Control-Allow-Headers', '*');
            }
        }

        return $response;
    }
}

