<?php

namespace Apility\Visma\Traits;

use Apility\Visma\Exceptions\VismaBadRequestException;
use Apility\Visma\Exceptions\VismaErrorException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use SimpleXMLElement;
use Apility\Visma\Facades\VismaClient;
use Exception;

/**
 * @phpstan-type VismaFilter object{
 *   field: string,
 *   compare: 'GreaterThanOrEqualTo'
 *     | 'LessThanOrEqualTo'
 *     | 'EqualTo'
 *     | 'NotEqualTo'
 *     | 'GreaterThan'
 *     | 'LessThan'
 *     | 'IntegerBitON'
 *     | 'IntegerBitOFF',
 *   operator?: 'AND'|'OR',
 *   leftParenthesis?: int|true|false,
 *   rightParenthesis?: int|true|false,
 * }
 */
trait VismaDefaultsTrait
{
    /**
     * List objects from Visma
     *
     * @param array<VismaFilter> $filters
     * @param bool $debug
     * @return Collection|string
     * @throws GuzzleException
     * @throws VismaErrorException
     * @throws VismaBadRequestException
     * @throws Exception
     */
    public static function list(array $filters, bool $debug = false)
    {
        if (!static::$listUrl) {
            throw new Exception("Method not implemented", 500);
        }

        $payload = new SimpleXMLElement('<' . static::$xmlElement . '></' . static::$xmlElement . '>');

        if (static::$xmlObjectWrapper) {
            $wrapper = $payload->addChild(static::$xmlObjectWrapper);
            $object = $wrapper->addChild(static::$xmlObject);
        } else {
            $object = $payload->addChild(static::$xmlObject);
        }

        if (static::$primaryKeyPlacement === 'object') {
            $object->addChild(static::$primaryKey);
        }

        foreach (array_keys(static::$ObjectChildren) as $key) {
            if ($key === 'CostUnitNumber' && static::$costUnitNumber) {
                $object->addChild('CostUnitNumber', static::$costUnitNumber);
            } else {
                $object->addChild($key);
            }
        }

        if (static::$xmlHeader && count(static::$HeaderChildren)) {
            $header = $object->addChild(static::$xmlHeader);

            if (static::$primaryKeyPlacement === 'header') {
                $header->addChild(static::$primaryKey);
            }

            foreach (array_keys(static::$HeaderChildren) as $key) {
                $header->addChild($key);
            }
        }

        if (static::$xmlLineWrapper && static::$xmlLine) {
            $lines = $object->addChild(static::$xmlLineWrapper);
            $line = $lines->addChild(static::$xmlLine);

            foreach (array_keys(static::$LineChildren) as $key) {
                $line->addChild($key);
            }
        }

        $filter = $payload->addChild('Filters');
        foreach ($filters as $filterItem) {
            $item = $filter->addChild($filterItem->field);
            $item->addAttribute('Compare', $filterItem->compare);
            $item->addAttribute('Value1', $filterItem->value);
            if ($filterItem->operator ?? false) {
                $item->addAttribute('Operator', $filterItem->operator);
            }
            if ($filterItem->leftParenthesis ?? false) {
                $item->addAttribute(
                    'LeftParenthesis',
                    intval($filterItem->leftParenthesis),
                );
            }
            if ($filterItem->rightParenthesis ?? false) {
                $item->addAttribute(
                    'RightParenthesis',
                    intval($filterItem->rightParenthesis),
                );
            }
        }

        if ($debug) {
            return VismaClient::debug($payload);
        }

        return static::convertList(
            VismaClient::post(
                static::$endpoint . '/' . static::$listUrl,
                $payload,
            )
        );
    }

    /**
     * Get single object from Visma
     *
     * @param string $primaryKey
     * @param bool $returnList
     * @param bool $debug
     * @return object|string
     * @throws GuzzleException
     * @throws VismaErrorException
     * @throws VismaBadRequestException
     * @throws Exception
     */
    public static function get(string $primaryKey, bool $returnList = false, bool $debug = false)
    {
        if (!static::$getUrl) {
            throw new Exception("Method not implemented", 500);
        }

        $payload = new SimpleXMLElement('<' . static::$xmlElement . '></' . static::$xmlElement . '>');

        if (static::$xmlObjectWrapper) {
            $wrapper = $payload->addChild(static::$xmlObjectWrapper);
            $object = $wrapper->addChild(static::$xmlObject);
        } else {
            $object = $payload->addChild(static::$xmlObject);
        }

        if (static::$primaryKeyPlacement === 'object') {
            $object->addChild(static::$primaryKey, $primaryKey);
        }

        foreach (array_keys(static::$ObjectChildren) as $key) {
            if (isset(static::$costUnitNumber) && static::$costUnitNumber) {
                /**
                 * For CostUnits (projects) a default value has to be set.
                 */
                $object->addChild('CostUnitNumber', static::$costUnitNumber);
                continue;
            }

            if ($key === 'WareHouseNo') {
                /**
                 * WareHouseNo has to be 1.
                 */
                $object->addChild('WareHouseNo', 1);
                continue;
            }

            $object->addChild($key);
        }

        if (static::$xmlHeader && count(static::$HeaderChildren)) {
            $header = $object->addChild(static::$xmlHeader);

            if (static::$primaryKeyPlacement === 'header') {
                $header->addChild(static::$primaryKey, $primaryKey);
            }

            foreach (array_keys(static::$HeaderChildren) as $key) {
                $header->addChild($key);
            }
        }

        if (static::$xmlLineWrapper && static::$xmlLine) {
            $lines = $object->addChild(static::$xmlLineWrapper);
            $line = $lines->addChild(static::$xmlLine);

            foreach (array_keys(static::$LineChildren) as $key) {
                $line->addChild($key);
            }
        }

        if ($debug) {
            return VismaClient::debug($payload);
        }

        if ($returnList) {
            return static::convertList(VismaClient::post(static::$endpoint . '/' . static::$getUrl, $payload));
        }

        return static::convertSingle(VismaClient::post(static::$endpoint . '/' . static::$getUrl, $payload));
    }

    /**
     * Create new object in visma
     *
     * @param array $objectItems
     * @param array $headerItems
     * @param array $lineItems
     * @param array<VismaFilter> $filters
     * @param bool $debug
     * @return object|string
     * @throws GuzzleException
     * @throws VismaErrorException
     * @throws VismaBadRequestException
     * @throws Exception
     */
    public static function create(
        array $objectItems = [],
        array $headerItems = [],
        array $lineItems = [],
        array $filters = [],
        bool $debug = false
    ) {
        if (!static::$postUrl) {
            throw new Exception("Method not implemented", 500);
        }

        $payload = new SimpleXMLElement('<' . static::$xmlElement . '></' . static::$xmlElement . '>');

        if (static::$xmlObjectWrapper) {
            $wrapper = $payload->addChild(static::$xmlObjectWrapper);
            $object = $wrapper->addChild(static::$xmlObject);
        } else {
            $object = $payload->addChild(static::$xmlObject);
        }

        if (static::$primaryKeyPlacement === 'object' && !in_array(static::$primaryKey, array_keys($objectItems))) {
            $object->addChild(static::$primaryKey);
        }

        foreach ($objectItems as $key => $value) {
            $object->addChild($key, e($value));
        }

        if (static::$xmlHeader && count(static::$HeaderChildren)) {
            $header = $object->addChild(static::$xmlHeader);

            if (static::$primaryKeyPlacement === 'header' && !in_array(static::$primaryKey, $headerItems)) {
                $header->addChild(static::$primaryKey);
            }

            foreach ($headerItems as $key => $value) {
                $header->addChild($key, e($value));
            }
        }

        if (static::$xmlLineWrapper && static::$xmlLine) {
            $lines = $object->addChild(static::$xmlLineWrapper);
            foreach ($lineItems as $lineItem) {
                $line = $lines->addChild(static::$xmlLine);
                foreach ($lineItem as $key => $value) {
                    $line->addChild($key, e($value));
                }
            }
        }

        if (count($filters)) {
            $filter = $payload->addChild('Filters');
            foreach ($filters as $filterItem) {
                $item = $filter->addChild($filterItem->field);
                $item->addAttribute('Compare', $filterItem->compare);
                $item->addAttribute('Value1', $filterItem->value);
                if ($filterItem->operator ?? false) {
                    $item->addAttribute('Operator', $filterItem->operator);
                }
                if ($filterItem->leftParenthesis ?? false) {
                    $item->addAttribute(
                        'LeftParenthesis',
                        intval($filterItem->leftParenthesis),
                    );
                }
                if ($filterItem->rightParenthesis ?? false) {
                    $item->addAttribute(
                        'RightParenthesis',
                        intval($filterItem->rightParenthesis),
                    );
                }
            }
        }

        if ($debug) {
            return VismaClient::debug($payload);
        }

        return static::convertSingle(VismaClient::post(static::$endpoint . '/' . static::$postUrl, $payload));
    }

    /**
     * Update object from Visma
     *
     * @param string $primaryKey
     * @param array $_1 Unused parameter
     * @param array $_2 Unused parameter
     * @param bool $debug
     * @return object|string
     * @throws GuzzleException
     * @throws VismaErrorException
     * @throws VismaBadRequestException
     * @throws Exception
     */
    public static function update(string $primaryKey, array $_1, array $_2, bool $debug = false)
    {
        if (!static::$putUrl) {
            throw new Exception("Method not implemented", 500);
        }
        $payload = new SimpleXMLElement('<' . static::$xmlElement . '></' . static::$xmlElement . '>');

        if (static::$xmlObjectWrapper) {
            $wrapper = $payload->addChild(static::$xmlObjectWrapper);
            $object = $wrapper->addChild(static::$xmlObject);
        } else {
            $object = $payload->addChild(static::$xmlObject);
        }

        $header = $object->addChild(static::$xmlHeader);
        $header->addChild(static::$primaryKey, $primaryKey);

        foreach ($header as $key => $value) {
            $header->addChild($key, $value);
        }

        $lines = $object->addChild(static::$xmlLineWrapper);
        foreach ($lines as $line) {
            $line = $lines->addChild(static::$xmlLine);
            foreach ($line as $key => $value) {
                $line->addChild($key, $value);
            }
        }

        if ($debug) {
            return VismaClient::debug($payload);
        }

        return static::convertSingle(VismaClient::post(static::$endpoint . '/' . static::$putUrl, $payload));
    }

    /**
     * Convert array of xmlObjects to collection of items
     *
     * @param SimpleXMLElement $xml
     * @return Collection
     */
    private static function convertList(SimpleXMLElement $xml): Collection
    {
        $collection = collect([]);
        if (static::$xmlObjectWrapper) {
            foreach ($xml->{static::$xmlObjectWrapper}->{static::$xmlObject} as $item) {
                $collection->add(static::convert(json_decode(json_encode((array) $item))));
            }
        } else {
            foreach ($xml->{static::$xmlObject} as $item) {
                $collection->add(static::convert(json_decode(json_encode((array) $item))));
            }
        }
        return $collection;
    }

    /**
     * Convert xmlObject to item
     *
     * @param SimpleXMLElement $xml
     * @return object
     */
    private static function convertSingle(SimpleXMLElement $xml): object
    {
        return static::convert(json_decode(json_encode((array) $xml->{static::$xmlObject})));
    }

    /**
     * Convert xmlObject item to item
     *
     * @param object $object
     * @return object
     */
    private static function convert(object $object): object
    {
        if (static::$xmlObject && count(static::$ObjectChildren)) {
            foreach ($object as $key => $value) {
                if ((static::$xmlHeader && $key === static::$xmlHeader) || (static::$xmlLineWrapper && $key === static::$xmlLineWrapper)) {
                    continue;
                }

                $type = static::$ObjectChildren[$key] ?? 'string';
                if ($key === static::$primaryKey) {
                    $type = static::$primaryKeyType ?? 'int';
                }

                if (is_object($value)) {
                    $object->{$key} = null;
                }

                settype($object->{$key}, $type);
            }
        }

        if (static::$xmlHeader && count(static::$HeaderChildren)) {
            foreach ($object->{static::$xmlHeader} as $key => $value) {
                $type = static::$HeaderChildren[$key] ?? 'string';
                if ($key === static::$primaryKey) {
                    $type = static::$primaryKeyType ?? 'int';
                }

                if (is_object($value)) {
                    $object->{static::$xmlHeader}->{$key} = null;
                }

                settype($object->{static::$xmlHeader}->{$key}, $type);
            }
        }

        if (static::$xmlLineWrapper && static::$xmlLine && count(static::$LineChildren)) {
            $object->{static::$xmlLineWrapper} = $object->{static::$xmlLineWrapper}->{static::$xmlLine};
            if (!is_array($object->{static::$xmlLineWrapper})) {
                $object->{static::$xmlLineWrapper} = [$object->{static::$xmlLineWrapper}];
            }

            foreach ($object->{static::$xmlLineWrapper} as $no => $line) {
                foreach ($line as $key => $value) {
                    $type = static::$LineChildren[$key] ?? 'string';

                    if (is_object($value)) {
                        $object->{static::$xmlLineWrapper}[$no]->{$key} = null;
                    }

                    settype($object->{static::$xmlLineWrapper}[$no]->{$key}, $type);
                }
            }
        }

        return $object;
    }
}
