<?php

namespace Apility\Visma;


class StockQuantity
{

    use Traits\VismaDefaultsTrait;

    /**
     * Default xml object children
     *
     * @var array
     */
    protected static $ObjectChildren = [
        'WareHouseNo' => 'int',
        'UnrealisedStockIncrease' => 'int',
        'RealisedStock' => 'int',
        'ReservedFromStock' => 'int'
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
    protected static $primaryKey = 'ProductNo';
    protected static $primaryKeyPlacement = 'object';
    protected static $primaryKeyType = 'string';
    protected static $xmlElement = 'StockQuantityinfo';
    protected static $xmlObject = 'StockQuantity';
    protected static $xmlObjectWrapper = false;
    protected static $xmlHeader = false;
    protected static $xmlLineWrapper = false;
    protected static $xmlLine = false;
    protected static $endpoint = 'Article.svc';
    protected static $listUrl = 'getStockQuantities';
    protected static $getUrl = 'getStockQuantity';
    protected static $postUrl = false;
    protected static $putUrl = false;

}
