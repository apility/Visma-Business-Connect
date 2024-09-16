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
    protected static $ObjectChildren = [
        'Description' => 'string',
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
    protected static $primaryKeyType = 'string';
    protected static $xmlElement = 'Articleinfo';
    protected static $xmlObject = 'Article';
    protected static $xmlObjectWrapper = false;
    protected static $xmlHeader = false;
    protected static $xmlLineWrapper = false;
    protected static $xmlLine = false;
    protected static $endpoint = 'Article.svc';
    protected static $listUrl = 'getArticles';
    protected static $getUrl = 'getArticle';
    protected static $postUrl = 'postArticle';
    protected static $putUrl = 'putArticle';
}
