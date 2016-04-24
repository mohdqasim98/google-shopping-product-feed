<?php
/*
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
*/
//Using composer
use NinthYard\GoogleShoppingFeed\Containers\GoogleShopping;

GoogleShopping::title('Test Feed');
GoogleShopping::link('http://www.example.com/');
GoogleShopping::description('Test Google Shopping Feed');

$item = GoogleShopping::createItem();
$item->id('SKU0001');//A SKU code for example, or any unique identifier (eg. could be the id from a database table)
$item->title('An Example Product Title');
$item->price('29.99'); //Price one wishes to sell a product for (unless sale_price option is added, then it's the original price)
$item->mpn('ACME00001');
$item->brand('ACME');
$item->sale_price('19.99'); //The actual price one wishes to sell a product for (optional)
$item->link('http://www.example.com/example-product.html');
$item->image_link('http://www.example.com/example-image.jpg');


/** Create a variant */
$variant = $item->variant();
$variant->size('L');
$variant->color('Green');

/** Create more variants */
$variant = $item->variant();
$variant->size('L');
$variant->color('Blue');

$variant = $item->variant();
$variant->size('L');
$variant->color('Red');

$variant = $item->variant();
$variant->size('M');
$variant->color('Green');

$variant = $item->variant();
$variant->size('M');
$variant->color('Blue');

$variant = $item->variant();
$variant->size('M');
$variant->color('Red');

$variant = $item->variant();
$variant->size('S');
$variant->color('Green');

$variant = $item->variant();
$variant->size('S');
$variant->color('Blue');

$variant = $item->variant();
$variant->size('S');
$variant->color('Red');

/** Delete initial $item as we're using variants and it will not be needed */
$item->delete();


// boolean value true outputs to browser as XML
GoogleShopping::asRss(true);
