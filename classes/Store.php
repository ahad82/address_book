<?php
namespace classes;

/**
 * Class Store
 * A loosely coupled, File storage class
 *
 * @package classes
 */
class Store
{

    /**
     * The directory
     */
    const STORE_REPOSITORY = "store";

    /**
     * @var
     */
    public $bookName;

    /**
     * @var string
     */
    public $fileName;

    public function __construct($storeName, $storeRepository = self::STORE_REPOSITORY)
    {
        $this->storeName = $storeName;
        $ext = "";
        if (!strstr($storeName, ".json")) {
            $ext = ".json";
        }
        $this->storeRepository = $storeRepository;
        $this->fileName = $storeRepository . "/{$storeName}{$ext}";
    }

    /**
     * @param $storeName
     * @return static
     */
    public static function getInstance($storeName, $storeRepository)
    {
        return new static($storeName, $storeRepository);
    }

    /**
     * @return array|mixed|string
     */
    public function getMasterRecord()
    {
        if (@file($this->fileName)) {
            $masterRecord = file_get_contents($this->fileName);
            $masterRecord = json_decode($masterRecord, true);

        } else {
            $masterRecord = [];
        }
        return $masterRecord;
    }

    /**
     * @param $storeName
     * @param $arrayData
     * @return bool
     */
    public static function save($storeName, $arrayData, $storeRepository = self::STORE_REPOSITORY)
    {

        $store = self::getInstance($storeName, $storeRepository);
        $masterRecord = $store->getMasterRecord();
        array_push($masterRecord, $arrayData);
        $masterRecord = json_encode($masterRecord);

        return file_put_contents($store->fileName, $masterRecord);

    }

    /**
     * @return mixed
     */
    public static function getFiles($storeRepository)
    {
        $list = scandir($storeRepository);
        unset($list[array_search("..", $list)]);
        unset($list[array_search(".", $list)]);
        return $list;
    }

    /**
     * @param string $storeRepository
     * @return array
     */
    public static function getAll($storeRepository = self::STORE_REPOSITORY)
    {
        $files = Store::getFiles($storeRepository);

        $allRecords = [];
        foreach ($files as $file) {
            $store = static::getInstance($file, $storeRepository);
            $masterRecord = file_get_contents($store->fileName);
            $masterRecord = json_decode($masterRecord, true);
            array_push($allRecords, $masterRecord);
        }
        return $allRecords;
    }
}

?>