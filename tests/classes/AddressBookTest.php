<?php
use PHPUnit\Framework\TestCase;
use classes\AddressBook;

class AddressBookTest extends TestCase
{

    public function setUp() {
        $this->mockData = [
            [
                ["name" => "bob"],
                ["name" => "jane"],
                ["name" => "marry"],
            ],
            [
                ["name" => "rob"],
                ["name" => "jane"],
                ["name" => "marry"],

            ],
            [
                ["name" => "alice"],
                ["name" => "jane"],
                ["name" => "marry"],

            ]
        ];

    }

    /**
     *
     */
    public function testInArrayMulti()
    {

        $this->assertEquals(AddressBook::inArrayMulti("bob", $this->mockData), 1);
        $this->assertEquals(AddressBook::inArrayMulti("jane", $this->mockData), 3);
        $this->assertEquals(AddressBook::inArrayMulti("marry", $this->mockData), 3);
        $this->assertEquals(AddressBook::inArrayMulti("alice", $this->mockData), 1);
    }

    /**
     *
     */
    public function testGetUnique(){
        $mock = $this->getMockBuilder(AddressBook::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mock->method('getAll')
            ->willReturn($this->mockData);

        $ret = AddressBook::getUnique();

        $this->assertEquals($ret["bob"], 1);
        $this->assertEquals($ret["alice"], 1);
    }
}