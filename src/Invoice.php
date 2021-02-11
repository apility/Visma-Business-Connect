<?php

namespace Apility\Visma;

class Invoice
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
        'InvoiceDate' => 'string',
        'CustomerNo' => 'int',
        'OrderNo' => 'int',
        'Description' => 'string',
        'ProductNo' => 'int',
        'Quantity' => 'float',
        'Price' => 'float',
        'Amount' => 'float'
    ];

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
    protected $primaryKey = 'InvoiceNo';
    protected $primaryKeyPlacement = 'object';
    protected $xmlElement = 'Invoiceinfo';
    protected $xmlObject = 'InvoiceLine';
    protected $xmlObjectWrapper = 'Invoice';
    protected $xmlHeader = false;
    protected $xmlLineWrapper = false;
    protected $xmlLine = false;
    protected $endpoint = 'Accounting.svc';
    protected $listUrl = 'getInvoices';
    protected $getUrl = false;
    protected $postUrl = false;
    protected $putUrl = false;

}