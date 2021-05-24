<?php
namespace classes;
use classes\Store;

/**
 * Class AddressBook
 * Takes the book name, person name and phone number and uses the data class to persist data.
 * 
 * @package classes
 */
class AddressBook {

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
    public static function getInstance() {
        return new static();
    }

    /**
     * @param $bookName-Address book name
     * @param $personName
     * @param $phoneNumber
     */
    public static function saveDetails($bookName, $personName, $phoneNumber) {

        $obj = static::getInstance();
        $obj->save($bookName, $personName, $phoneNumber);
    }

    /**
     * @param $bookName-Address book name
     * @param $personName
     * @param $phoneNumber
     */
    private function save($bookName, $personName, $phoneNumber) {
        $arrayData = [
            "name"=> $personName,
            "phoneNumber" => $phoneNumber
        ];
        Store::save($bookName, $arrayData);
    }

    /**
     * @return array
     */
    public static function getAll() {
        
        return Store::getAll();
    }

    /**'
     *
     */
    public static function getUnique() {
        $uniquelist = [];
        $addressBooks = self::getAll();
        foreach ($addressBooks as $k=>$addressBook) {
           foreach($addressBook as $person) {
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
    public static function inArrayMulti($needle, $haystack, $foundCounter = 0){
        $needle = trim($needle);
        if(!is_array($haystack))
            return False;

        foreach($haystack as $key=>$value){
            if(is_array($value)){
                $foundCounter = self::inArrayMulti($needle, $value, $foundCounter);
            }
            else
                if(trim($value) === trim($needle)){
                    $foundCounter ++;
                }
        }

        return $foundCounter;
    }

}

?>