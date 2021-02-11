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
    protected $ObjectChildren = [
        'CostUnitNumber' => 'int',
        'Name' => 'string',
        'CustomerNo' => 'int',
        'Status' => 'string'
    ];

    /**
     * Default xml head children
     *
     * @var array
     */
    protected $HeaderChildren = [];

    /**
     * Default xml line children
     *
     * @var array
     */
    protected $LineChildren = [];

    /**
     * Definitions for the XML structure
     *
     * @var string
     */
    protected $primaryKey = 'OrgUnit2';
    protected $primaryKeyPlacement = 'object';
    protected $xmlElement = 'CostUnitinfo';
    protected $xmlObject = 'CostUnit';
    protected $xmlObjectWrapper = false;
    protected $xmlHeader = false;
    protected $xmlLineWrapper = false;
    protected $xmlLine = false;
    protected $endpoint = 'Accounting.svc';
    protected $listUrl = 'getCostUnits';
    protected $getUrl = 'getCostUnit';
    protected $postUrl = 'postCostUnit';
    protected $putUrl = 'putCostUnit';

}