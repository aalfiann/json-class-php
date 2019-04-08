# JSON Class PHP

[![Version](https://img.shields.io/badge/stable-1.3.1-green.svg)](https://github.com/aalfiann/json-class-php)
[![Total Downloads](https://poser.pugx.org/aalfiann/json-class-php/downloads)](https://packagist.org/packages/aalfiann/json-class-php)
[![License](https://poser.pugx.org/aalfiann/json-class-php/license)](https://github.com/aalfiann/json-class-php/blob/HEAD/LICENSE.md)

A class for handle json in a better way.

## Installation

Install this package via [Composer](https://getcomposer.org/).
```
composer require "aalfiann/json-class-php:^1.0"
```


## Usage

### Encode
```php
require_once ('vendor/autoload.php');
use \aalfiann\JSON;

$data = [
    'result'=>'just make a test!',
    'data' => [
        'id' => '1',
        'user' => 'your name',
        'email' => 'your_email@gmail.com',
        'website' => 'http://yourdomain.com',
        'non-utf8' => 'السلام علیکم ورحمة الله وبرکاته!'
    ]
];

header('Content-Type: application/json');
$json = new JSON;
echo $json->encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
```

### Decode
```php
require_once ('vendor/autoload.php');
use \aalfiann\JSON;

$data = '{"result":"just make a test!","data":{"id":"1","user":"your name","email":"your_email@gmail.com","website":"http://yourdomain.com","non-utf8":"\u00d8\u00a7\u00d9\u0084\u00d8\u00b3\u00d9\u0084\u00d8\u00a7\u00d9\u0085 \u00d8\u00b9\u00d9\u0084\u00db\u008c\u00da\u00a9\u00d9\u0085 \u00d9\u0088\u00d8\u00b1\u00d8\u00ad\u00d9\u0085\u00d8\u00a9 \u00d8\u00a7\u00d9\u0084\u00d9\u0084\u00d9\u0087 \u00d9\u0088\u00d8\u00a8\u00d8\u00b1\u00da\u00a9\u00d8\u00a7\u00d8\u00aa\u00d9\u0087!"},"logger":{"timestamp":"2018-09-17 13:53:12","uniqid":"5b9f95a812c0f"}}';

$json = new JSON;
echo var_dump($json->decode($data,true));
```


### Debug
You can easily debug with set property `debug` to `true`.
```php
require_once ('vendor/autoload.php');
use \aalfiann\JSON;

header('Content-Type: application/json');
$json = new JSON;
$json->debug=true;
echo $json->encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
```

## Chain Usage Example

```php
require_once ('vendor/autoload.php');
use \aalfiann\JSON;

header('Content-Type: application/json');
$json = new JSON;
echo $json->withSanitizer()->withLog()->encode(['user'=>'yourname'],JSON_PRETTY_PRINT);
```

## Properties
-  `$withlog=false,$sanitize=false,$ansii=false,$debug=false,$makesimple=false,$trim=false;`

## Chain Function
- **withSanitizer($sanitize=true)** this will sanitize your data array before execute json_encode.  
- **withTrim($trim=true)** this will trimmed your data array or string before execute json_encode or json_decode.  
- **withLog($withlog=true)** this will append the logger data into your json.
- **setAnsii($ansii=true)** this will make sanitizer works to handle ANSII chars.
- **setDebug($debug=true)** this is for debugging purpose.
- **makeSimple($makesimple=true)** this will hide the additional data in debug output.

## Main Function
- **encode($data,$options=0,$depth=512)** encode array or string to json format.
- **decode($json,$assoc=false,$depth=512,$options=0)** decode json string to `stdClass/array`.
- **isValid($json=null)** to determine json string is valid or not.

## Helper Function
- **convertToUTF8($string)** convert string to valid UTF8 chars.
- **convertToUTF8Ansii($string)** convert string to valid UTF8 chars (support ANSII chars).
- **trimValue($string)** trim the data array or string to strip the whitespace or any characters consider to blank value.
- **debug_encode($string,$options=0,$depth=512)** debugger to test json encode.
- **debug_decode($json,$assoc=false,$depth=512,$options=0)** debugger to test json decode.
- **errorMessage($jsonlasterror,$content)** case error message about json.
- **fixControlChar($string)** Most common fixed hidden control char in json string which made json decode fails.
- **modifyJsonStringInArray($data,$jsonfield,$setnewfield="")** modify json data string in some field array to be nice json data structure.
- **concatenate($data,$escape=true,$options=0,$depth=512)** concatenate json data
- **minify($json)** Minify the json string