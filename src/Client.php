<?php

namespace Apility\Visma;

use Apility\Visma\Exceptions\VismaBadRequestException;
use Apility\Visma\Exceptions\VismaErrorException;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use SimpleXMLElement;
use GuzzleHttp\Client as Guzzle;

class Client
{
    private string $guid;
    private Guzzle $client;
    private string $clientID;

    /**
     * Instantiates a new Visma client
     * @param $url
     * @param string $token
     * @param string $clientId
     */
    function __construct($url, string $token, string $clientId)
    {
        $this->client = new Guzzle([
            'base_uri' => $url
        ]);

        $this->guid = $token;
        $this->clientID = $clientId;
    }

    /**
     * Submits data to Visma
     * @param string $uri
     * @param SimpleXMLElement $payload
     * @return SimpleXMLElement
     * @throws GuzzleException
     * @throws VismaErrorException
     * @throws VismaBadRequestException
     * @throws Exception
     */
    public function post(
        string $uri,
        SimpleXMLElement $payload
    ): SimpleXMLElement {
        $header = $payload->addChild('Header');
        $header->addChild('ClientId', $this->clientID);
        $header->addChild('Guid', $this->guid);

        $status = $payload->addChild('Status');
        $status->addChild('MessageId');
        $status->addChild('Message');
        $status->addChild('MessageDetail');

        $request = new Request('POST', $uri, [], $payload->asXML());
        $response = $this->client->send($request);

        $responseXml = new SimpleXMLElement($response->getBody());

        if (isset($responseXml->Errors)) {
            throw new VismaErrorException(
                $responseXml->Errors[0]->Details[0]->attributes->Message[0],
                intval($responseXml->Errors[0]->attributes->Status[0]),
                $responseXml->Errors[0]->Details[0]->attributes->Method[0],
                $request,
                $response
            );
        }

        if (
            isset($responseXml->Status)
            && intval($responseXml->Status->MessageId[0]) !== 0
        ) {
            throw new VismaBadRequestException(
                $responseXml->Status->Message[0],
                intval($responseXml->Status->MessageId[0]),
                $responseXml->Status->MessageDetail[0],
                $request,
                $response,
            );
        }

        return $responseXml;
    }

    /**
     * @param SimpleXMLElement $payload
     * @return string
     */
    public function debug(SimpleXMLElement $payload): string
    {
        $header = $payload->addChild('Header');
        $header->addChild('ClientId', $this->clientID);
        $header->addChild('Guid', $this->guid);

        $status = $payload->addChild('Status');
        $status->addChild('MessageId');
        $status->addChild('Message');
        $status->addChild('MessageDetail');

        $payload = (string) $payload->asXML();
        return $payload;
    }
}
