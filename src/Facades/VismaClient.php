<?php

namespace Apility\Visma\Facades;

use Illuminate\Support\Facades\Facade;
use RuntimeException;
use SimpleXMLElement;

/**
 * @method static SimpleXMLElement post (string $url, SimpleXMLElement $payload)
 * @method static string debug (SimpleXMLElement $payload)
 *
 * @see \Apility\Visma\Client
 */
class VismaClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'visma.client';
    }
}
