<?php

namespace Apility\Visma;

class VoucherBatch
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
        'VoucherSeriesNo' => 'int',
        'ValueDate' => 'string',
        'Description' => 'string',
        'Origin' => 'int',
    ];

    /**
     * Default xml line children
     *
     * @var array
     */
    protected static $LineChildren = [
        'VoucherNo' => 'int',
        'VoucherDate' => 'string',
        'VoucherType' => 'string',
        'ValueDate' => 'string',
        'Text' => 'string',
        'DebitAccountType' => 'int',
        'DebitAccountNo' => 'int',
        'DebitTaxCode' => 'string',
        'CreditAccountType' => 'string',
        'CreditAccountNo' => 'int',
        'CreditTaxCode' => 'string',
        'CurrencyNo' => 'string',
        'ExchangeRate' => 'string',
        'AmountInCurrency' => 'string',
        'AmountDomestic' => 'string',
        'InvoiceNo' => 'int',
        'CrossReference' => 'string',
        'DueDate' => 'string',
        'ExternalReference1' => 'string',
    ];

    /**
     * Definitions for the XML structure
     *
     * @var string
     */
    protected static $primaryKey = 'BatchNo';
    protected static $primaryKeyPlacement = 'head';
    protected static $xmlElement = 'Batchinfo';
    protected static $xmlObject = 'Batch';
    protected static $xmlObjectWrapper = false;
    protected static $xmlHeader = 'BatchHead';
    protected static $xmlLineWrapper = 'BatchLines';
    protected static $xmlLine = 'BatchLine';
    protected static $endpoint = 'Voucher.svc';
    protected static $listUrl = null;
    protected static $getUrl = 'getVoucherBatch';
    protected static $postUrl = 'postVoucherBatch';
    protected static $putUrl = 'putVoucherBatch';
}
