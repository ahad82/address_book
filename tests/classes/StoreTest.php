<?php
use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use classes\Store;

class StoreTest extends TestCase
{

    /**
     * Verifying object setup
     */
    public function testFileName()
    {

        $store = Store::getInstance("test1", "store");
        $this->assertEquals($store->fileName, "store/test1.json");

        $store = Store::getInstance("test1.json", "jsonfiles");
        $this->assertEquals($store->fileName, "jsonfiles/test1.json");
        $this->assertEquals($store->storeRepository, "jsonfiles");
    }

    /**
     * Tests with virtual dir,
     * whether it strips off the dots fine
     */
    public function testGetFiles()
    {
        $structure = [
            "tmp" => [
                "store" => [
                    "." => "123",
                    ".." => "2132",
                    "file1.json" => "12312",
                    "file2.json" => "1232",
                    "file3.json" => "1232"
                ]
            ]
        ];
        $vfs = vfsStream::setup('root');
        vfsStream::create($structure, $vfs);

        $store = vfsStream::url('root/tmp/store');
        $this->assertEquals(Store::getFiles($store), [2 => "file1.json", 3 => "file2.json", 4 => "file3.json"]);
    }
}