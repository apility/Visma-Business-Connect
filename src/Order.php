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
    protected $ObjectChildren = [];
    
    /**
     * Default xml head children
     *
     * @var array
     */
    protected $HeaderChildren = [
        'Ordertype' => 'int',
        'OrderDate' => 'string',
        'CustomerNo' => 'int',
        'OrgUnit2' => 'int',
        'Group5' => 'int',
        'YourReference' => 'string',
        'OurReference' => 'string',
        'CustomerOrSupplierOrderNo' => 'string',
        'PaymentTerms' => 'int',
        'DueDate' => 'string',
    ];

    /**
     * Default xml line children
     *
     * @var array
     */
    protected $LineChildren = [
        'LineNo' => 'int', 
        'Description' => 'string', 
        'Quantity' => 'float',
        'InvoicedOrRealised' => 'float',
        'ProductNo' => 'string', 
        'PriceInCurrency' => 'float',
        'OrgUnit2' => 'int',
        'Free4' => 'int'
    ];

    /**
     * Definitions for the XML structure
     *
     * @var string
     */
    protected $primaryKey = 'OrderNo';
    protected $primaryKeyPlacement = 'header';
    protected $xmlElement = 'Orderinfo';
    protected $xmlObject = 'Order';
    protected $xmlObjectWrapper = false;
    protected $xmlHeader = 'OrderHead';
    protected $xmlLineWrapper = 'OrderLines';
    protected $xmlLine = 'OrderLine';
    protected $endpoint = 'Order.svc';
    protected $listUrl = 'getOrders';
    protected $getUrl = 'getOrder';
    protected $postUrl = 'postOrder';
    protected $putUrl = 'putOrder';

}