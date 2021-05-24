<?php
use PHPUnit\Framework\TestCase;
use classes\AddressBook;
use classes\Store;

/**
 * Class mockAddressBook
 * mock class
 */
class mockAddressBook extends AddressBook {

    /**
     * @param $storeRepository - overridden function to return mocked data
     * @return array
     */
    public static function getAll()
    {
        return [
            [
                ["name" => "bob"],
                ["name" => "jane"],
                ["name" => "marry"]
            ],
            [
                ["name" => "rob"],
                ["name" => "jane"],
                ["name" => "marry"]
            ],
            [
                ["name" => "alice"],
                ["name" => "jane"],
                ["name" => "marry"]
            ]
        ];
    }
}

class AddressBookTest extends TestCase
{

    public function setUp()
    {
        $this->mockData = [
            [
                ["name" => "bob"],
                ["name" => "jane"],
                ["name" => "marry"]
            ],
            [
                ["name" => "rob"],
                ["name" => "jane"],
                ["name" => "marry"]
            ],
            [
                ["name" => "alice"],
                ["name" => "jane"],
                ["name" => "marry"]
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
    public function testGetUnique()
    {
        $ret = mockAddressBook::getUnique();
        $this->assertEquals($ret["bob"], 1);
        $this->assertEquals($ret["alice"], 1);
    }
}