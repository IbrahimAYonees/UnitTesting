<?php
namespace App\Support;

use IteratorAggregate;
use ArrayIterator;
use JsonSerializable;

/**
 * Class Collection
 *
 * @package App\Support
 */
class Collection implements IteratorAggregate,JsonSerializable{
    /**
     * @var array
     */
    protected $items;

    /**
     * Collection constructor.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * returns an array of the collection elements
     *
     * @return array
     */
    public function get(){
        return $this->items;
    }

    /**
     * returns the count of the collection elements
     *
     * @return int
     */
    public function count(){
        return count($this->items);
    }

    /**
     * check if collection has no elements
     *
     * @return bool
     */
    public function isEmpty(){
        return $this->count() <= 0;
    }

    /**
     * returns the first element in the collection
     *
     * @return mixed|null
     */
    public function first(){
        if(!$this->isEmpty()){
            foreach ($this->items as $item){
                return $item;
            }
        }else{
            return null;
        }
    }

    /**
     * return the last element in collection
     *
     * @return mixed|null
     */
    public function last(){
        if(!$this->isEmpty()) {
            return end($this->items);
        }else{
            return null;
        }
    }

    /**
     * merge tow  collections
     *
     * @param Collection $collection
     */
    public function merge(Collection $collection){
        return $this->add($collection->get());
    }

    /**
     * make the collection iterate able
     *
     * @return ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * merge an array to the collection
     *
     * @param array $items
     */
    public function add(array $items){
        $this->items = array_merge($this->get(),$items);
    }

    /**
     * json encode the collection
     *
     * @return string
     */
    public function jsonEncode(){
        return json_encode($this->items);
    }

    /**
     * make the collection instance can be json encoded
     *
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return $this->items;
    }
}