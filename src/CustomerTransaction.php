<?php

namespace Apility\Visma;

class CustomerTransaction
{
    use Traits\VismaDefaultsTrait;

    /**
     * Default xml object children
     *
     * @var array
     */
    protected static $ObjectChildren = [
        'CustomerNo' => 'int',
        'InvoiceNo' => 'int',
        'AmountInCurrency' => 'float',
        'OutstandingAmountInCurrency' => 'float',
        'VoucherNo' => 'int',
        'VoucherDate' => 'string',
        'ChangedDate' => 'string',
        'DueDate' => 'string'
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
    protected static $primaryKey = 'InvoiceNo';
    protected static $primaryKeyPlacement = 'object';
    protected static $xmlElement = 'CustomerTransactionInfo';
    protected static $xmlObjectWrapper = 'CustomerTransactions';
    protected static $xmlObject = 'CustomerTransaction';
    protected static $xmlHeader = false;
    protected static $xmlLineWrapper = false;
    protected static $xmlLine = false;
    protected static $endpoint = 'Extension.svc';
    protected static $listUrl = 'getTableValue';
    protected static $getUrl = false;
    protected static $postUrl = false;
    protected static $putUrl = false;
}
