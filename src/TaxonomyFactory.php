<?php
/**
 * Created by PhpStorm.
 * User: ageorgin
 * Date: 19/11/14
 * Time: 14:48
 */

namespace Ftven\SdkTaxonomy;

use Ftven\SdkTaxonomy\Entity\AccessToken;
use Ftven\SdkTaxonomy\Service\AccessToken\GenerateAccessToken;
use Ftven\SdkTaxonomy\Service\AccessToken\ParserAccessToken;
use Ftven\SdkTaxonomy\Service\AccessTokenService;
use Ftven\SdkTaxonomy\Service\Content\CreateContent;
use Ftven\SdkTaxonomy\Service\Content\DeleteContent;
use Ftven\SdkTaxonomy\Service\Content\MapperContent;
use Ftven\SdkTaxonomy\Service\Content\SearchContent;
use Ftven\SdkTaxonomy\Service\Content\SerializerContent;
use Ftven\SdkTaxonomy\Service\Content\UpdateContent;
use Ftven\SdkTaxonomy\Service\ContentService;
use Ftven\SdkTaxonomy\Service\ExceptionService;
use Ftven\SdkTaxonomy\Service\GuzzleService;
use Ftven\SdkTaxonomy\Service\Tag\AutocompleteTag;
use Ftven\SdkTaxonomy\Service\Tag\CreateTag;
use Ftven\SdkTaxonomy\Service\Tag\MapperTag;
use Ftven\SdkTaxonomy\Service\Tag\ReadTag;
use Ftven\SdkTaxonomy\Service\Tag\SerializerTag;
use Ftven\SdkTaxonomy\Service\TagService;
use Pimple\Container;

class TaxonomyFactory
{
    public static function getTagService($apiUrl, $apiProductId)
    {
        $container = self::getContainer($apiUrl, $apiProductId);
        return $container['service.tag'];
    }

    public static function getContentService($apiUrl, $apiProductId)
    {
        $container = self::getContainer($apiUrl, $apiProductId);
        return $container['service.content'];
    }

    private static function getContainer($apiUrl, $apiProductId)
    {
        $container = new Container();

        $container['api_url'] = $apiUrl;
        $container['api_product_id'] = $apiProductId;

        // ExceptionService
        $container['service.exception'] = function ($c) {
            return new ExceptionService();
        };

        // GuzzleService
        $container['service.guzzle'] = function ($c) {
            $svc = new GuzzleService();
            $svc->setUrl($c['api_url']);
            $svc->setExceptionService($c['service.exception']);

            return $svc;
        };

        //ParserAccessToken
        $container['service.access_token.parser'] = function ($c) {
            return new ParserAccessToken();
        };

        // GenerateAccessToken
        $container['service.access_token.generate'] = function ($c) {
            $svc = new GenerateAccessToken();
            $svc->setGuzzleService($c['service.guzzle']);
            $svc->setParserService($c['service.access_token.parser']);
            return $svc;
        };

        // AccessTokenService
        $container['service.access_token'] = function ($c) {
            $entity = new AccessToken();
            $entity->setId($c['api_product_id']);

            $svc = new AccessTokenService();
            $svc->setAccessToken($entity);
            $svc->setGenerateService($c['service.access_token.generate']);

            return $svc;
        };

        // MapperContent
        $container['service.content.mapper'] = function ($c) {
            return new MapperContent();
        };

        // SerializerContent
        $container['service.content.serializer'] = function ($c) {
          return new SerializerContent();
        };

        // CreateContent
        $container['service.content.create'] = function ($c) {
            $svc = new CreateContent();
            $svc->setAccessTokenSvc($c['service.access_token']);
            $svc->setGuzzleSvc($c['service.guzzle']);
            $svc->setMapperSvc($c['service.content.mapper']);
            $svc->setSerialiserSvc($c['service.content.serializer']);
            return $svc;
        };

        // DeleteContent
        $container['service.content.delete'] = function ($c) {
            $svc = new DeleteContent();
            $svc->setAccessTokenSvc($c['service.access_token']);
            $svc->setGuzzleSvc($c['service.guzzle']);
            $svc->setMapperSvc($c['service.content.mapper']);
            $svc->setSerialiserSvc($c['service.content.serializer']);
            return $svc;
        };

        // SearchContent
        $container['service.content.search'] = function ($c) {
            $svc = new SearchContent();
            $svc->setAccessTokenSvc($c['service.access_token']);
            $svc->setGuzzleSvc($c['service.guzzle']);
            $svc->setMapperSvc($c['service.content.mapper']);
            $svc->setSerialiserSvc($c['service.content.serializer']);
            return $svc;
        };

        // UpdateContent
        $container['service.content.update'] = function ($c) {
            $svc = new UpdateContent();
            $svc->setAccessTokenSvc($c['service.access_token']);
            $svc->setGuzzleSvc($c['service.guzzle']);
            $svc->setMapperSvc($c['service.content.mapper']);
            $svc->setSerialiserSvc($c['service.content.serializer']);
            return $svc;
        };

        // ContentService
        $container['service.content'] = function ($c) {
            $svc = new ContentService();
            $svc->setCreateSvc($c['service.content.create']);
            $svc->setDeleteSvc($c['service.content.delete']);
            $svc->setSearchSvc($c['service.content.search']);
            $svc->setUpdateSvc($c['service.content.update']);
            return $svc;
        };

        // MapperTag
        $container['service.tag.mapper'] = function ($c) {
            return new MapperTag();
        };

        // SerializerTag
        $container['service.tag.serializer'] = function ($c) {
            return new SerializerTag();
        };

        // AutocompleteTag
        $container['service.tag.autocomplete'] = function ($c) {
            $svc = new AutocompleteTag();
            $svc->setMapperSvc($c['service.tag.mapper']);
            $svc->setGuzzleSvc($c['service.guzzle']);
            $svc->setAccessTokenSvc($c['service.access_token']);
            return $svc;
        };

        // CreateTag
        $container['service.tag.create'] = function ($c) {
            $svc = new CreateTag();
            $svc->setSerializerSvc($c['service.tag.serializer']);
            $svc->setMapperSvc($c['service.tag.mapper']);
            $svc->setGuzzleSvc($c['service.guzzle']);
            $svc->setAccessTokenSvc($c['service.access_token']);
            return $svc;
        };

        $container['service.tag.read'] = function ($c) {
            $svc = new ReadTag();
            $svc->setAccessTokenSvc($c['service.access_token']);
            $svc->setGuzzleSvc($c['service.guzzle']);
            $svc->setMapperSvc($c['service.tag.mapper']);
            return $svc;
        };

        // TagService
        $container['service.tag'] = function ($c) {
            $svc = new TagService();
            $svc->setAutocompleteSvc($c['service.tag.autocomplete']);
            $svc->setCreateSvc($c['service.tag.create']);
            $svc->setReadSvc($c['service.tag.read']);
            return $svc;
        };

        return $container;
    }
}
