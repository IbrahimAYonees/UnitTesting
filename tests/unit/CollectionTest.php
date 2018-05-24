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

    /** @test */
    public function collection_can_be_merged_with_another_collection(){
        $collection1 = new Collection([1,2,3]);
        $collection2 = new Collection([4,5,6]);

        $collection1->merge($collection2);
        $this->assertCount(6,$collection1->get());
        $this->assertEquals($collection2->last(),$collection1->last());
    }

    /** @test */
    public function add_array_to_collection(){
        $collection = new Collection([1,2,3]);
        $collection->add([4,5,6]);
        $this->assertCount(6,$collection->get());
    }

    /** @test */
    public function get_the_first_element_of_collection(){
        $collection = new Collection([1,2,3]);
        $this->assertEquals($collection->first(),1);
    }

    /** @test */
    public function get_the_last_element_of_the_collection(){
        $collection = new Collection([1,2,3]);
        $this->assertEquals($collection->last(),3);
    }

    /** @test */
    public function return_null_if_the_collection_is_empty_when_getting_first_or_last_element(){
        $collection = new Collection();
        $this->assertEquals(null,$collection->first());
        $this->assertEquals(null,$collection->last());
    }

    /** @test */
    public function return_json_encoded_string_from_the_collection(){
        $collection = new Collection([
            ["username" => "Ahmed"],
            ["username" => "Ibrahim"]
        ]);
        $encoded = $collection->jsonEncode();
        $this->assertInternalType('string',$encoded);
        $this->assertEquals('[{"username":"Ahmed"},{"username":"Ibrahim"}]',$encoded);
    }

    /** @test */
    public function collection_can_be_json_encoded(){
        $collection = new Collection([
            ["username" => "Ahmed"],
            ["username" => "Ibrahim"]
        ]);
        $encoded = json_encode($collection);
        $this->assertInternalType('string',$encoded);
        $this->assertEquals('[{"username":"Ahmed"},{"username":"Ibrahim"}]',$encoded);
    }
}