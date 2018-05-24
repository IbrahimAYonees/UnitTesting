<?php
namespace App\Support;

use IteratorAggregate;
use ArrayIterator;
use JsonSerializable;

class Collection implements IteratorAggregate,JsonSerializable{
    protected $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function get(){
        return $this->items;
    }

    public function count(){
        return count($this->items);
    }

    public function isEmpty(){
        return $this->count() <= 0;
    }

    public function first(){
        if(!$this->isEmpty()){
            return $this->items[0];
        }else{
            return null;
        }
    }

    public function last(){
        if(!$this->isEmpty()) {
            return $this->items[$this->count() - 1];
        }else{
            return null;
        }
    }

    public function merge(Collection $collection){
        return $this->add($collection->get());
    }

    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    public function add(array $items){
        $this->items = array_merge($this->get(),$items);
    }

    public function jsonEncode(){
        return json_encode($this->items);
    }

    public function jsonSerialize()
    {
        return $this->items;
    }
}