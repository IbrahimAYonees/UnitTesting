<?php

use PHPUnit\Framework\TestCase;
use App\Support\Collection;

class CollectionTest extends TestCase{
    /** @test */
    public function empty_instantiated_collection_return_no_items(){
        $collection = new Collection();
        $this->assertEmpty($collection->get());
    }

    /** @test */
    public function count_collection_return_the_correct_count(){
        $collection = new Collection([
            'Ibrahim','Mohamed','Ali'
        ]);
        $this->assertEquals($collection->count(),3);
    }

    /** @test */
    public function the_passed_items_are_returned_correctly(){
        $collection = new Collection([1,2,3,4,5]);
        $this->assertCount(5,$collection->get());
        $this->assertEquals($collection->get()[0],1);
        $this->assertEquals($collection->get()[1],2);
        $this->assertEquals($collection->get()[4],5);
    }

    /** @test */
    public function collection_are_instance_of_iteratorAggregate(){
        $collection = new Collection();
        $this->assertInstanceOf(IteratorAggregate::class,$collection);
    }

    /** @test */
    public function can_be_iterated(){
        $collection = new Collection([1,2,3,4]);
        $items = [];
        foreach ($collection as $item) {
            $items[] = $item;
        }
        $this->assertCount(4,$items);
        $this->assertInstanceOf(ArrayIterator::class,$collection->getIterator());
    }
}