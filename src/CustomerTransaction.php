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
    protected $ObjectChildren = [
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
    protected $primaryKey = 'InvoiceNo';
    protected $primaryKeyPlacement = 'object';
    protected $xmlElement = 'CustomerTransactionInfo';
    protected $xmlObjectWrapper = 'CustomerTransactions';
    protected $xmlObject = 'CustomerTransaction';
    protected $xmlHeader = false;
    protected $xmlLineWrapper = false;
    protected $xmlLine = false;
    protected $endpoint = 'Extension.svc';
    protected $listUrl = 'getTableValue';
    protected $getUrl = false;
    protected $postUrl = false;
    protected $putUrl = false;

}