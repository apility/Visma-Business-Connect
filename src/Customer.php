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
    protected $ObjectChildren = [
        'AssociateNo' => 'int',
        'Name' => 'string',
        'ShortName' => 'string',
        'CompanyNo' => 'string',
        'AddressLine1' => 'string',
        'AddressLine2' => 'string',
        'AddressLine3' => 'string',
        'AddressLine4' => 'string',
        'PostCode' => 'string',
        'PostalArea' => 'string',
        'Information1' => 'int',
        'Group5' => 'int'
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
    protected $primaryKey = 'CustomerNo';
    protected $primaryKeyPlacement = 'object';
    protected $xmlElement = 'Customerinfo';
    protected $xmlObject = 'Customer';
    protected $xmlObjectWrapper = false;
    protected $xmlHeader = false;
    protected $xmlLineWrapper = false;
    protected $xmlLine = false;
    protected $endpoint = 'Customer.svc';
    protected $listUrl = 'getCustomers';
    protected $getUrl = 'getCustomer';
    protected $postUrl = 'postcustomer';
    protected $putUrl = 'putCustomer';

}