<?php

namespace Apility\Visma;


class Article
{

    use Traits\VismaDefaultsTrait;

    /**
     * Default xml object children
     *
     * @var array
     */
    protected $ObjectChildren = [
        'Description' => 'string',
        'Information1' => 'string',
        'TaxAndAccountingGroup' => 'string',
        'Information5' => 'int'
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
    protected $primaryKey = 'ProductNo';
    protected $primaryKeyPlacement = 'object';
    protected $xmlElement = 'Articleinfo';
    protected $xmlObject = 'Article';
    protected $xmlObjectWrapper = false;
    protected $xmlHeader = false;
    protected $xmlLineWrapper = false;
    protected $xmlLine = false;
    protected $endpoint = 'Article.svc';
    protected $listUrl = 'getArticles';
    protected $getUrl = 'getArticle';
    protected $postUrl = 'postArticle';
    protected $putUrl = 'putArticle';

}