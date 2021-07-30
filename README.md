# Laravel Messages
library that provides multilingual export from specified file
## Installation
### Composer
require maatwebsite/excel >= ^3.1
```php
$ composer require nta/messages
```
### Laravel
In your ``config/app.php`` add ``DevNta\Messages\NtaMessageProvider::class`` to the end of the providers array:
### Publish config
```php
php artisan vendor:publish --provider="DevNta\Messages\NtaMessageProvider" --tag="config"
```
### Other Config

#### Use Lang
The default configuration of 2 languages is **English** and **Japanese**, if you want to add other languages, please add `languages` array of config `nta_message.php`.

#### Set import length for each file
```php
'sheet' => [
    'base_lang' => [
        'common' => [
            'length' => [1, 65]
        ]
    ]
    ```
]
```
> **_common:_** Tt is set to be the filename when adding a new {filename}.php

> **_length:_** Length get value in column STT of sheet.


#### Url file import
if you don't want to use angular file of library, please setting ``path_url_file`` in file config ``nta_message.php``

### Start import command
```php
php artisan nta-message:generate
```
> **_If success:_**  The import process has been completed.

> **_If failure:_**  Import failed.

### Publish lang
```php
php artisan vendor:publish --provider="DevNta\Messages\NtaMessageProvider" --tag="lang"
```
