<?php

namespace Apility\Visma;

class Project
{
    use Traits\VismaDefaultsTrait;

    /**
     * Default xml object children
     *
     * @var array
     */
    protected static $ObjectChildren = [
        'CostUnitNumber' => 'int',
        'Name' => 'string',
        'CustomerNo' => 'int'
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
    protected static $primaryKey = 'OrgUnit2';
    protected static $primaryKeyPlacement = 'object';
    protected static $xmlElement = 'CostUnitinfo';
    protected static $xmlObject = 'CostUnit';
    protected static $xmlObjectWrapper = false;
    protected static $xmlHeader = false;
    protected static $xmlLineWrapper = false;
    protected static $xmlLine = false;
    protected static $endpoint = 'Accounting.svc';
    protected static $listUrl = 'getCostUnits';
    protected static $getUrl = 'getCostUnit';
    protected static $postUrl = 'postCostUnit';
    protected static $putUrl = 'putCostUnit';
    protected static $costUnitNumber = '2';
}
