<?php

namespace Apility\Visma\Traits;

use SimpleXMLElement;
use Apility\Visma\Facades\VismaClient;
use Exception;

trait VismaDefaultsTrait {

    /**
     * List objects from Visma
     *
     * @param object $filters
     * @param bool $debug
     * @return object
     */
    public function list(array $filters, $debug = false) {

        $payload = new SimpleXMLElement('<' . $this->xmlElement . '></' . $this->xmlElement . '>');
        
        if($this->xmlObjectWrapper) {
            $wrapper = $payload->addChild($this->xmlObjectWrapper);
            $object = $wrapper->addChild($this->xmlObject);
        } else {
            $object = $payload->addChild($this->xmlObject);
        }
        
        if($this->primaryKeyPlacement === 'object') {
            $object->addChild($this->primaryKey);
        }

        foreach(array_keys($this->ObjectChildren) as $key) {
            $object->addChild($key);
        }

        if($this->xmlHeader && count($this->HeaderChildren)) {
            
            $header = $object->addChild($this->xmlHeader);
            
            if($this->primaryKeyPlacement === 'header') {
                $header->addChild($this->primaryKey);
            }

            foreach(array_keys($this->HeaderChildren) as $key) {
                $header->addChild($key);
            }

        }
        
        if($this->xmlLineWrapper && $this->xmlLine) {

            $lines = $object->addChild($this->xmlLineWrapper);
            $line = $lines->addChild($this->xmlLine);
            
            foreach(array_keys($this->LineChildren) as $key) {
                $line->addChild($key);
            }

        }

        $filter = $payload->addChild('Filters');
        foreach($filters as $filterItem) {
            $item = $filter->addChild($filterItem->field);
            $item->addAttribute('Compare', $filterItem->compare);
            $item->addAttribute('Value1', $filterItem->value);
            $item->addAttribute('Operator', $filterItem->operator);
        }

        if($debug) {
            return $this->debug($payload);
        }

        return $this->convertList(VismaClient::post($this->endpoint . '/' . $this->listUrl , $payload));

    }
    
    /**
     * Get single object from Visma
     *
     * @param int $primaryKey
     * @param bool $debug
     * @return object
     */
    public function get(int $primaryKey, $debug = false) {

        if(!$this->getUrl) {
            throw new Exception("Method not implemented", 500);
        }
        
        $payload = new SimpleXMLElement('<' . $this->xmlElement . '></' . $this->xmlElement . '>');
        
        if($this->xmlObjectWrapper) {
            $wrapper = $payload->addChild($this->xmlObjectWrapper);
            $object = $wrapper->addChild($this->xmlObject);
        } else {
            $object = $payload->addChild($this->xmlObject);
        }
        
        if($this->primaryKeyPlacement === 'object') {
            $object->addChild($this->primaryKey, $primaryKey);
        }

        foreach(array_keys($this->ObjectChildren) as $key) {
            
            if($key === 'CostUnitNumber') {
                /**
                 * For CostUnits (projects) a default value has to be set.
                 */
                $object->addChild('CostUnitNumber', 2);    
                continue;
            } 

            $object->addChild($key);

        }

        if($this->xmlHeader && count($this->HeaderChildren)) {
            
            $header = $object->addChild($this->xmlHeader);
            
            if($this->primaryKeyPlacement === 'header') {
                $header->addChild($this->primaryKey, $primaryKey);
            }

            foreach(array_keys($this->HeaderChildren) as $key) {
                $header->addChild($key);
            }

        }
        
        if($this->xmlLineWrapper && $this->xmlLine) {

            $lines = $object->addChild($this->xmlLineWrapper);
            $line = $lines->addChild($this->xmlLine);
            
            foreach(array_keys($this->LineChildren) as $key) {
                $line->addChild($key);
            }

        }

        if($debug) {
            return $this->debug($payload);
        }

        return $this->convertSingle(VismaClient::post($this->endpoint . '/' . $this->getUrl , $payload));

    }

    /**
     * Create new object in visma
     * 
     * @param array $objectItems
     * @param array $headerItems
     * @param array $lineItems
     * @param array $filters
     * @param bool $debug
     * @return object
     */
    public function create(array $objectItems = [], array $headerItems = [], array $lineItems = [], array $filters = [], $debug = false) {

        if(!$this->postUrl) {
            throw new Exception("Method not implemented", 500);
        }
        
        $payload = new SimpleXMLElement('<' . $this->xmlElement . '></' . $this->xmlElement . '>');
        
        if($this->xmlObjectWrapper) {
            $wrapper = $payload->addChild($this->xmlObjectWrapper);
            $object = $wrapper->addChild($this->xmlObject);
        } else {
            $object = $payload->addChild($this->xmlObject);
        }

        if($this->primaryKeyPlacement === 'object' && !in_array($this->primaryKey, array_keys($objectItems))) {
            $object->addChild($this->primaryKey);
        }

        foreach($objectItems as $key => $value) {
            $object->addChild($key, e($value));
        }

        if($this->xmlHeader && count($this->HeaderChildren)) {
            
            $header = $object->addChild($this->xmlHeader);
    
            if($this->primaryKeyPlacement === 'header' &&  !in_array($this->primaryKey, $headerItems)) {
                $header->addChild($this->primaryKey);
            }

            foreach($headerItems as $key => $value) {
                $header->addChild($key, e($value));
            }

        }

        if($this->xmlLineWrapper && $this->xmlLine) {

            $lines = $object->addChild($this->xmlLineWrapper);
            foreach($lineItems as $lineItem) {
                $line = $lines->addChild($this->xmlLine);
                foreach($lineItem as $key => $value) {
                    $line->addChild($key, e($value));
                } 
            }

        }

        if(count($filters)) {
            $filter = $payload->addChild('Filters');
            foreach($filters as $filterItem) {
                $item = $filter->addChild($filterItem->field);
                $item->addAttribute('Compare', $filterItem->compare);
                $item->addAttribute('Value1', $filterItem->value);
                $item->addAttribute('Operator', $filterItem->operator);
            }
        }

        if($debug) {
            return $this->debug($payload);
        }

        return $this->convertSingle(VismaClient::post($this->endpoint . '/' . $this->postUrl , $payload));

    }

    /**
     * Update object from Visma
     *
     * @param int $primaryKey
     * @param array $header
     * @param array $lines
     * @param bool $debug
     * @return object
     */
    public function update(int $primaryKey, array $header, array $lines, $debug = false) {

        if(!$this->putUrl) {
            throw new Exception("Method not implemented", 500);
        }
        $payload = new SimpleXMLElement('<' . $this->xmlElement . '></' . $this->xmlElement . '>');
        
        if($this->xmlObjectWrapper) {
            $wrapper = $payload->addChild($this->xmlObjectWrapper);
            $object = $wrapper->addChild($this->xmlObject);
        } else {
            $object = $payload->addChild($this->xmlObject);
        }
        
        $header = $object->addChild($this->xmlHeader);
		$header->addChild($this->primaryKey, $primaryKey);
        
        foreach($header as $key => $value) {
            $header->addChild($key, $value);
        }
        
        $lines = $object->addChild($this->xmlLineWrapper);
        foreach($lines as $line) {
            $line = $lines->addChild($this->xmlLine);
            foreach($line as $key => $value) {
                $line->addChild($key, $value);
            } 
        }

        if($debug) {
            return $this->debug($payload);
        }

        return $this->convertSingle(VismaClient::post($this->endpoint . '/' . $this->putUrl , $payload));

    }

    /**
     * Convert array of xmlObjects to collection of items
     *
     * @param SimpleXMLElement $xml
     * @return object
     */
    private function convertList(SimpleXMLElement $xml) {

        $collection = collect([]); 
        if($this->xmlObjectWrapper) {
            foreach($xml->{$this->xmlObjectWrapper}->{$this->xmlObject} as $item) {
                $collection->add($this->convert(json_decode(json_encode((array) $item))));
            }
        } else {
            foreach($xml->{$this->xmlObject} as $item) {
                $collection->add($this->convert(json_decode(json_encode((array) $item))));
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
    private function convertSingle(SimpleXMLElement $xml) {
        return $this->convert(json_decode(json_encode((array) $xml->{$this->xmlObject})));
    }

    /**
     * Convert xmlObject item to item
     *
     * @param SimpleXmlElement $xml
     * @param bool $single
     * @return object
     */
    private function convert(object $object) {

        if($this->xmlObject && count($this->ObjectChildren)) {
            
            foreach($object as $key => $value) {
                
                if(($this->xmlHeader && $key === $this->xmlHeader) || ($this->xmlLineWrapper && $key === $this->xmlLineWrapper)) {
                    continue;
                }
                
                $type = $this->ObjectChildren[$key] ?? 'string';
                if($key === $this->primaryKey) {
                    $type = 'int';
                }

                if(is_object($value)) {
                    $object->{$key} = null;
                }

                settype($object->{$key}, $type);
            }

        }

        if($this->xmlHeader && count($this->HeaderChildren)) {

            foreach($object->{$this->xmlHeader} as $key => $value) {
                
                $type = $this->HeaderChildren[$key] ?? 'string';
                if($key === $this->primaryKey) {
                    $type = 'int';
                }

                if(is_object($value)) {
                    $object->{$this->xmlHeader}->{$key} = null;
                }

                settype($object->{$this->xmlHeader}->{$key}, $type);
            }

        }

        if($this->xmlLineWrapper && $this->xmlLine && count($this->LineChildren)) {
            
            $object->{$this->xmlLineWrapper} = $object->{$this->xmlLineWrapper}->{$this->xmlLine};
            foreach($object->{$this->xmlLineWrapper} as $no => $line) {

                foreach($line as $key => $value) {

                    $type = $this->LineChildren[$key] ?? 'string';

                    if(is_object($value)) {
                        $object->{$this->xmlLineWrapper}[$no]->{$key} = null;
                    }

                    settype($object->{$this->xmlLineWrapper}[$no]->{$key}, $type);

                }

            }

        }
        
        return (object) $object;

    }

}