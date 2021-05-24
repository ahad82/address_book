<?php
use classes\AddressBook;
use classes\Store;

//auto loader
spl_autoload_register(function ($class_name) {
    $class_name = str_replace('\\', '/', $class_name);
    require_once("{$class_name}.php");
});

/**
 * Removing the existing address books,
 * Taking inputs still need to be refined
 */
@unlink("store/book1.json");
@unlink("store/book2.json");

$inputData = file_get_contents("input/input.json");
$inputData = json_decode($inputData, true);

saveDetails($inputData);
displayAll();
displayUniqueResult();

/**
 * @param $inputData
 */
function saveDetails($inputData)
{
    if (empty($inputData)) {
        return false;
    }
    foreach ($inputData as $addressBook) {
        foreach ($addressBook as $details) {
            AddressBook::saveDetails($details["address_book"], $details["person_name"], $details["phone_number"]);
        }
    }
}

/**
 *
 */
function displayUniqueResult()
{
    $result = AddressBook::getUnique();
    echo "------------------------------------\n";
    echo "Here are people unique to address books::\n";
    foreach ($result as $key => $value) {
        echo "Name : $key \n";
    }
}

/**
 *
 */
function displayAll()
{
    $results = AddressBook::getAll();
    echo "------------------------------------\n";
    echo "List of people in the address books\n";

    foreach ($results as $addressBook) {
        foreach ($addressBook as $personDetails) {
            echo "Name: " . $personDetails["name"] . " || Phone Number: " . $personDetails["phoneNumber"] . "\n";
        }
    }

}

?>