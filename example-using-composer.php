<?php
/*
 * Forked from: Luke Snowden - https://github.com/lukesnowden/google-shopping-feed
 * Added additional methods such as size_system, five custom custom labels (for AdWord campaigns). 
*/

//Without composor (standard installation)
/**
require('src/NinthYard/GoogleShoppingFeed/Feed.php');
require('src/NinthYard/GoogleShoppingFeed/Item.php');
require('src/NinthYard/GoogleShoppingFeed/Node.php');
require('src/NinthYard/GoogleShoppingFeed/Containers/GoogleShopping.php');
**/

//Using composer
require('vendor/autoload.php');
use NinthYard\GoogleShoppingFeed\Containers\GoogleShopping;

GoogleShopping::title('Test Feed');
GoogleShopping::link('http://www.example.com/');
GoogleShopping::description('Test Google Shopping Feed');

$item = GoogleShopping::createItem();
$item->title('An Example Product Title');
$item->price('29.99'); //Price one wishes to sell a product for (unless sale_price option is added, then it's the original price)
$item->mpn('ACME00001');
$item->brand('ACME');
$item->sale_price('19.99'); //The actual price one wishes to sell a product for (optional)
$item->link('http://www.example.com/example-product.html');
$item->image_link('http://www.example.com/example-image.jpg');


/** Create a variant */
$variant = $item->variant();
$variant->id('SKU0001');//A SKU code for example, or any unique identifier (eg. could be the id from a database table)
$variant->size('L');
$variant->color('Green');

/** Create more variants */
$variant = $item->variant();
$variant->id('SKU0002');//A SKU code for example, or any unique identifier (eg. could be the id from a database table)
$variant->size('L');
$variant->color('Blue');

$variant = $item->variant();
$variant->id('SKU0003');//A SKU code for example, or any unique identifier (eg. could be the id from a database table)
$variant->size('L');
$variant->color('Red');

$variant = $item->variant();
$variant->id('SKU0004');//A SKU code for example, or any unique identifier (eg. could be the id from a database table)
$variant->size('M');
$variant->color('Green');

$variant = $item->variant();
$variant->id('SKU0005');//A SKU code for example, or any unique identifier (eg. could be the id from a database table)
$variant->size('M');
$variant->color('Blue');

$variant = $item->variant();
$variant->id('SKU0006');//A SKU code for example, or any unique identifier (eg. could be the id from a database table)
$variant->size('M');
$variant->color('Red');

$variant = $item->variant();
$variant->id('SKU0007');//A SKU code for example, or any unique identifier (eg. could be the id from a database table)
$variant->size('S');
$variant->color('Green');

$variant = $item->variant();
$variant->id('SKU0008');//A SKU code for example, or any unique identifier (eg. could be the id from a database table)
$variant->size('S');
$variant->color('Blue');

$variant = $item->variant();
$variant->id('SKU0009');//A SKU code for example, or any unique identifier (eg. could be the id from a database table)
$variant->size('S');
$variant->color('Red');

// Delete initial $item as we're using variants and it will not be needed
$item->delete();

// boolean value true outputs to browser as XML
GoogleShopping::asRss(true);
