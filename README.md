#Google Shopping Product Feed
A PHP library to generate a Google Shopping feed. Data to fill the feed could be retrieved from a database, json or xml file, or added manually.

Issues, feature requests, and pull requests always welcome!

This has been tested on a UK, German, and French feed so far. Functions to santise data to make it pass Google's Merchant Centre validation have been used and will be added. This mainly applies to edge-cases on size and colour variations.

For more information see: https://support.google.com/merchants/answer/188494?hl=en-GB

##Installation

###Composer (.json)

```json
{
    "require": {
        "NinthYard/google-shopping-product-feed": "master"
    }
}
```

###Composer (Command Line)
```
composer require NinthYard/google-shopping-product-feed
```

###Standard Installation
If one is not using composer or vendor/autoload.php, just require the following prior to using:
```
require('src/NinthYard/GoogleShoppingFeed/Feed.php');
require('src/NinthYard/GoogleShoppingFeed/Item.php');
require('src/NinthYard/GoogleShoppingFeed/Node.php');
require('src/NinthYard/GoogleShoppingFeed/Containers/GoogleShopping.php');
```

##Usage

###Examples
Coming soon.

###Overview

```php
require('vendor/autoload.php');
use NinthYard\GoogleShoppingFeed\Containers\GoogleShopping;

GoogleShopping::title('Test Feed');
GoogleShopping::link('http://www.example.com/');
GoogleShopping::description('Test Google Shopping Feed');

$item = GoogleShopping::createItem();
$item->id('SKU0001');//A SKU code for example, or any unique identifies (eg. could be the id from a database table)
$item->title('An Example Product Title');
$item->price('29.99'); //Price one wishes to sell a product for (unless sale_price option is added, then it's the original price)
$item->mpn('ACME00001');
$item->brand('ACME');
$item->sale_price('19.99'); //The actual price one wishes to sell a product for (optional)
$item->link('http://www.example.com/example-product.html');
$item->image_link('http://www.example.com/example-image.jpg');


/** create a variant */
$variant = $item->variant();
$variant->size('L');
$variant->color('Green');

/**
 * If creating variants one should delete the initial product object as
 * the variants will have the original $item properties and will be
 * grouped under one product group with the information from the $item
 * 
 * $item->delete();
 *
**/

}

// boolean value true outputs to browser as XML
GoogleShopping::asRss(true);

// boolean value true outputs raw (to put in a file for example)
file_put_contents('myfeed.xml', GoogleShopping::asRss(false));
