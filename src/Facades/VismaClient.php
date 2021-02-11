<?php

namespace Apility\Visma\Facades;

use Illuminate\Support\Facades\Facade;

class VismaClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'visma.client';
    }
}