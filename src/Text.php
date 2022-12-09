<?php

namespace Apility\Visma;

class Text
{

    use Traits\VismaDefaultsTrait;

    /**
     * Default xml object children
     *
     * @var array
     */
    protected static $ObjectChildren = [
        'Description' => 'string',
    ];

    /**
     * Default xml head children
     *
     * @var array
     */
    protected static $HeaderChildren = [];

    /**
     * Default xml line children
     *
     * @var array
     */
    protected static $LineChildren = [];

    /**
     * Definitions for the XML structure
     *
     * @var string
     */
    protected static $primaryKey = 'TextNo';
    protected static $primaryKeyPlacement = 'object';
    protected static $xmlElement = 'Textinfo';
    protected static $xmlObject = 'Text';
    protected static $xmlObjectWrapper = false;
    protected static $xmlHeader = false;
    protected static $xmlLineWrapper = false;
    protected static $xmlLine = false;
    protected static $endpoint = 'Extension.svc';
    protected static $listUrl = 'Text';
    protected static $getUrl = false;
    protected static $postUrl = false;
    protected static $putUrl = false;

}
