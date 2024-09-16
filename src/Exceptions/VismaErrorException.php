<?php

namespace Apility\Visma\Exceptions;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class VismaErrorException extends \Exception
{
    public int $status;
    public string $method;
    public RequestInterface $request;
    public ResponseInterface $response;

    /**
     * @param string $message
     * @param int $status
     * @param string $method
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(
        string $message,
        int $status,
        string $method,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        parent::__construct($message, $status);
        $this->status = $status;
        $this->method = $method;
        $this->request = $request;
        $this->response = $response;
    }
}
