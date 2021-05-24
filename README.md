# Address book manager
A basic command line app with mocked up data to save/retrieve records,
Data is persisted as json object in a file, a file represents an address book. e.g. store/book1.json

## Installation
```bash
1- git clone https://github.com/ahad82/catch_project.git
2- composer install
```

## Usage
While inside the root directory, execute the command below
```python
php index.php
```

## Unit tests
```python
vendor/bin/phpunit --bootstrap tests/customAutoLoad.php tests/classes
```
