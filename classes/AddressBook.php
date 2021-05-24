<?php
namespace classes;

use classes\Store;

/**
 * Class AddressBook
 * Takes the book name, person name and phone number and uses the data class to persist data.
 *
 * @package classes
 */
class AddressBook
{

    public $bookName;
    public $personName;
    public $phoneNumber;

    /**
     * AddressBook constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return static
     */
    public static function getInstance()
    {
        return new static();
    }


    /**
     * @param $bookName
     * @param $personName
     * @param $phoneNumber
     * @throws \Exception
     */
    public static function saveDetails($bookName, $personName, $phoneNumber)
    {
        $bookName = filter_var($bookName, FILTER_SANITIZE_STRING);
        $personName = filter_var($personName, FILTER_SANITIZE_STRING);
        $phoneNumber = filter_var($phoneNumber, FILTER_SANITIZE_STRING);

        $arr = [$bookName, $personName, $phoneNumber];
        if (in_array("", $arr) || in_array(null, $arr)) {
            throw new \Exception("invalid data provided");
        }

        $obj = static::getInstance();
        $obj->save($bookName, $personName, $phoneNumber);
    }

    /**
     * @param $bookName -Address book name
     * @param $personName
     * @param $phoneNumber
     */
    private function save($bookName, $personName, $phoneNumber)
    {
        $arrayData = [
            "name" => $personName,
            "phoneNumber" => $phoneNumber
        ];
        Store::save($bookName, $arrayData);
    }

    /**
     * @return array
     */
    public static function getAll()
    {
        return Store::getAll();
    }

    /**'
     *
     */
    public static function getUnique()
    {
        $uniquelist = [];
        $addressBooks = static::getAll();
        foreach ($addressBooks as $k => $addressBook) {
            foreach ($addressBook as $person) {
                $foundCounter = static::inArrayMulti($person["name"], $addressBooks);
                if ($foundCounter == 1)
                    $uniquelist[$person["name"]] = $foundCounter;
            }
        }
        return $uniquelist;
    }

    /**
     * @param $needle
     * @param $haystack
     * @param int $foundCounter
     * @return bool|int
     */
    public static function inArrayMulti($needle, $haystack, $foundCounter = 0)
    {
        $needle = trim($needle);
        if (!is_array($haystack))
            return False;

        foreach ($haystack as $key => $value) {
            if (is_array($value)) {
                $foundCounter = static::inArrayMulti($needle, $value, $foundCounter);
            } else
                if (trim($value) === trim($needle)) {
                    $foundCounter++;
                }
        }

        return $foundCounter;
    }

}

?>