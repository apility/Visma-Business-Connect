<?php

namespace Apility\Visma;

class Customer
{
    use Traits\VismaDefaultsTrait;

    /**
     * Default xml object children
     *
     * @var array
     */
    protected static $ObjectChildren = [
        'Name' => 'string',
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
    protected static $primaryKey = 'CustomerNo';
    protected static $primaryKeyPlacement = 'object';
    protected static $xmlElement = 'Customerinfo';
    protected static $xmlObject = 'Customer';
    protected static $xmlObjectWrapper = false;
    protected static $xmlHeader = false;
    protected static $xmlLineWrapper = false;
    protected static $xmlLine = false;
    protected static $endpoint = 'Customer.svc';
    protected static $listUrl = 'getCustomers';
    protected static $getUrl = 'getCustomer';
    protected static $postUrl = 'postcustomer';
    protected static $putUrl = 'putCustomer';
}
