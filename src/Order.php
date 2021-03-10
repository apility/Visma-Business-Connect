<?php

namespace Apility\Visma;

class Order
{

    use Traits\VismaDefaultsTrait;

    /**
     * Default xml object children
     *
     * @var array
     */
    protected static $ObjectChildren = [];
    
    /**
     * Default xml head children
     *
     * @var array
     */
    protected static $HeaderChildren = [
        'Ordertype' => 'int',
        'OrderDate' => 'string',
        'CustomerNo' => 'int',
        'YourReference' => 'string',
        'CustomerOrSupplierOrderNo' => 'string',
    ];

    /**
     * Default xml line children
     *
     * @var array
     */
    protected static $LineChildren = [
        'LineNo' => 'int', 
        'Description' => 'string', 
        'Quantity' => 'float',
        'ProductNo' => 'string',
        'PriceInCurrency' => 'float',
    ];

    /**
     * Definitions for the XML structure
     *
     * @var string
     */
    protected static $primaryKey = 'OrderNo';
    protected static $primaryKeyPlacement = 'header';
    protected static $xmlElement = 'Orderinfo';
    protected static $xmlObject = 'Order';
    protected static $xmlObjectWrapper = false;
    protected static $xmlHeader = 'OrderHead';
    protected static $xmlLineWrapper = 'OrderLines';
    protected static $xmlLine = 'OrderLine';
    protected static $endpoint = 'Order.svc';
    protected static $listUrl = 'getOrders';
    protected static $getUrl = 'getOrder';
    protected static $postUrl = 'postOrder';
    protected static $putUrl = 'putOrder';

}