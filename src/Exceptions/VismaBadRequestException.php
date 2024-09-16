<?php

namespace Apility\Visma\Exceptions;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class VismaBadRequestException extends \Exception
{
    public int $messageId;
    public string $messageDetail;
    public RequestInterface $request;
    public ResponseInterface $response;

    /**
     * @param string $message
     * @param int $messageId
     * @param string $messageDetail
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(
        string $message,
        int $messageId,
        string $messageDetail,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        parent::__construct($message, $messageId);
        $this->messageId = $messageId;
        $this->messageDetail = $messageDetail;
        $this->request = $request;
        $this->response = $response;
    }
}
