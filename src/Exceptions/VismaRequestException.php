<?php

namespace Apility\Visma\Exceptions;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class VismaRequestException extends \Exception
{
    public RequestInterface $request;
    public ResponseInterface $response;

    /**
     * @param string $message
     * @param int $code
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(
        string $message,
        int $code,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        parent::__construct($message, $code);
        $this->request = $request;
        $this->response = $response;
    }
}
