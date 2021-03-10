<?php

namespace Apility\Visma;


class ArticlePrice
{

    use Traits\VismaDefaultsTrait;

    /**
     * Default xml object children
     *
     * @var array
     */
    protected static $ObjectChildren = [
        'CustomerNo' => 'int',
        'SalesPrice1' => 'float',
        'SuggestedPriceInCurrency' => 'float',
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
    protected static $primaryKey = 'ProductNo';
    protected static $primaryKeyPlacement = 'object';
    protected static $xmlElement = 'ArticlePriceinfo';
    protected static $xmlObject = 'ArticlePrice';
    protected static $xmlObjectWrapper = false;
    protected static $xmlHeader = false;
    protected static $xmlLineWrapper = false;
    protected static $xmlLine = false;
    protected static $endpoint = 'Article.svc';
    protected static $listUrl = 'getArticlePrices';
    protected static $getUrl = 'getArticlePrice';
    protected static $postUrl = false;
    protected static $putUrl = false;

}