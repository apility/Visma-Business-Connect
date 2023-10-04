<?php
namespace Apility\Visma;

use GuzzleHttp\Exception\GuzzleException;
use SimpleXMLElement;
use GuzzleHttp\Client as Guzzle;
use Exception;

class Client {

    private string $guid;
    private Guzzle $client;
    private string $clientID;

    /**
     * Instantiates a new Visma client
     * @param $url
     * @param string $token
     * @param string $clientId
     */
	function __construct ($url, string $token, string $clientId) {

		$this->client = new Guzzle([
			'base_uri' => $url
		]);

		$this->guid = $token;
		$this->clientID = $clientId;

	}

    /**
     * Submits data to Visma
     * @param string $url
     * @param SimpleXMLElement $payload
     * @return SimpleXMLElement Response
     * @throws GuzzleException|Exception
     */
    public function post (string $url, SimpleXMLElement $payload): SimpleXMLElement {

        $header = $payload->addChild('Header');
	    $header->addChild('ClientId', $this->clientID);
	    $header->addChild('Guid', $this->guid);

		$status = $payload->addChild('Status');
	    $status->addChild('MessageId');
	    $status->addChild('Message');
	    $status->addChild('MessageDetail');

	    $payload = (string) $payload->asXML();

	    $request = $this->client->post($url, ['body' => $payload]);
	    $response = (string) $request->getBody();
	    $response = new SimpleXMLElement($response);

	    if (isset($response->Errors)) {
	      $errors = $response->Errors[0];
	      $details = $errors->Details[0];
	      $message = $errors->attributes->Status[0];
	      $message .= ', ' . $details->attributes->Method[0];
	      $message .= ': ' . $details->attributes->Message[0];

	      throw new Exception($message);
	    }

	    if (isset($response->Status) && intval($response->Status->MessageId[0])) {
	      $message = $response->Status->Message[0];
	      if ($response->Status->MessageDetail[0]) {
	        $message .= ', ' . $response->StatusMessageDetail[0];
	      }

		  throw new Exception($message);

	    }

		return $response;

	}

  /**
   * @param SimpleXMLElement $payload
   * @return string
   */
	public function debug(SimpleXMLElement $payload): string {

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
