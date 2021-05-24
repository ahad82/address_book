<?php
use classes\AddressBook;
use classes\Store;
//auto loader
spl_autoload_register(function ($class_name) {
    $class_name = str_replace('\\', '/', $class_name);
    require_once ("{$class_name}.php");
});

/**
 * Removing the existing address books,
 * Taking inputs still need to be refined
 */
@unlink("store/book1.json");
@unlink("store/book2.json");

/**
 * Raw mocked up inputs
 * 
 */
AddressBook::saveDetails("book1", "bob", "123445");
AddressBook::saveDetails("book1", "marry", "123445");
AddressBook::saveDetails("book1", "jane", "123445");

AddressBook::saveDetails("book2", "alice", "123445");
AddressBook::saveDetails("book2", "marry", "123445");
AddressBook::saveDetails("book2", "jane", "123445");

$results = AddressBook::getAll();
displayAll($results);

$result = AddressBook::getUnique();
displayUniqueResult($result);



function displayUniqueResult($result) {
    echo "------------------------------------\n";
    echo "Here are people unique to address books::\n";
    foreach ($result as $key => $value) {
        echo "Name : $key \n";
    }
}

function displayAll($results) {

    echo "------------------------------------\n";
    echo "List of people in the address books\n";
    
    foreach ($results as $addressBook) {
        foreach($addressBook as $personDetails) {
            echo "Name: " . $personDetails["name"] . " || Phone Number: " . $personDetails["phoneNumber"] . "\n";
        }
    }
    
}

?>