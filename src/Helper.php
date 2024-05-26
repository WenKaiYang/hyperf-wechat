<?php

namespace Ella123\HyperfWechat;

use Hyperf\Context\Context;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Symfony\Component\HttpFoundation\Response;
class Helper
{
    public static function Response(Response $response)
    {
        $psrResponse = Context::get(PsrResponseInterface::class);
        $psrResponse = $psrResponse->withBody(new SwooleStream($response->getContent()))->withStatus($response->getStatusCode());
        foreach ($response->headers->all() as $key => $item) {
            $psrResponse = $psrResponse->withHeader($key, $item);
        }
        return $psrResponse;
    }
}