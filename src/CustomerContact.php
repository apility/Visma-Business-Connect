<?php

namespace Apility\Visma;

class CustomerContact
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
    protected static $primaryKey = 'AssociateNo';
    protected static $primaryKeyPlacement = 'object';
    protected static $xmlElement = 'Customerinfo';
    protected static $xmlObject = 'CustomerContact';
    protected static $xmlObjectWrapper = false;
    protected static $xmlHeader = false;
    protected static $xmlLineWrapper = false;
    protected static $xmlLine = false;
    protected static $endpoint = 'Customer.svc';
    protected static $listUrl = 'getCustomerContacts';
    protected static $getUrl = 'getCustomerContact';
    protected static $postUrl = 'postCustomerContact';
    protected static $putUrl = 'PutCustomerContact';

}