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
    protected static $ObjectChildren = [];

    /**
     * Default xml head children
     *
     * @var array
     */
    protected static $HeaderChildren = [
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
    protected static $LineChildren = [];

    /**
     * Definitions for the XML structure
     *
     * @var string
     */
    protected static $primaryKey = 'InvoiceNo';
    protected static $primaryKeyPlacement = 'object';
    protected static $xmlElement = 'Invoiceinfo';
    protected static $xmlObject = 'InvoiceLine';
    protected static $xmlObjectWrapper = 'Invoice';
    protected static $xmlHeader = false;
    protected static $xmlLineWrapper = false;
    protected static $xmlLine = false;
    protected static $endpoint = 'Accounting.svc';
    protected static $listUrl = 'getInvoices';
    protected static $getUrl = false;
    protected static $postUrl = false;
    protected static $putUrl = false;
}
