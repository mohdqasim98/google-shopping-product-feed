<?php
namespace NinthYard\GoogleShoppingFeed;

use NinthYard\GoogleShoppingFeed\Node;
use NinthYard\GoogleShoppingFeed\Containers\GoogleShopping;

class Item
{

    CONST INSTOCK = 'in stock';

    CONST OUTOFSTOCK = 'out of stock';

    CONST PREORDER = 'preorder';

    CONST BRANDNEW = 'new';

    CONST USED = 'used';

    CONST REFURBISHED = 'refurbished';

    CONST MALE = 'male';

    CONST FEMALE = 'female';

    CONST UNISEX = 'unisex';

    CONST NEWBORN = 'newborn';

    CONST INFANT = 'infant';

    CONST TODDLER = 'toddler';

    CONST KIDS = 'kids';

    CONST ADULT = 'adult';

    CONST EXTRASMALL = 'XS';

    CONST SMALL = 'S';

    CONST MEDIUM = 'M';

    CONST LARGE = 'L';

    CONST EXTRALARGE = 'XL';

    CONST EXTRAEXTRALARGE = 'XXL';

    /**
     * [$nodes - Stores all of the product nodes]
     * @var array
     */
    private $nodes = array();

    /**
     * [$index description]
     * @var null
     */
    private $index = null;

    /**
     * [$namespace - (g:) namespace definition]
     * @var string
     */
    protected $namespace = 'http://base.google.com/ns/1.0';

    /**
     * [__construct]
     */
    public function __construct()
    {
    }

    /**
     * [id - Set the ID of the product]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function id($id)
    {
        $node = new Node('id');
        $this->nodes['id'] = $node->value($id)->_namespace($this->namespace);
    }

    /**
     * [title - Set the title of the product]
     * @param  [type] $title [description]
     * @return [type]        [description]
     */
    public function title($title)
    {
        $node = new Node('title');
        $title = $this->safeCharEncodeText($title);
        $this->nodes['title'] = $node->value($title)->addCdata();
    }

    /**
     * [link - Set the link/URL of the product]
     * @param  [type] $link [description]
     * @return [type]       [description]
     */
    public function link($link)
    {
        $node = new Node('link');
        $link = $this->safeCharEncodeURL($link);
        $this->nodes['link'] = $node->value($link)->addCdata();
    }

    /**
     * [link - Set the link/URL of the product]
     * @param  [type] $adwords_redirect [description]
     * @return [type]                   [description]
     */
    public function adwords_redirect($adwords_redirect)
    {
        $node = new Node('adwords_redirect');
        $adwords_redirect = $this->safeCharEncodeURL($adwords_redirect);
        $this->nodes['adwords_redirect'] = $node->value($adwords_redirect)->addCdata();
    }

    /**
     * [price - Set the price of the product, do not format before passing]
     * @param  [type] $price [description]
     * @return [type]        [description]
     */
    public function price($price)
    {
        $node = new Node('price');
        $this->nodes['price'] = $node->value(number_format($price, 2, '.', ''))->_namespace($this->namespace);
    }

    /**
     * [sale_price - set the sale price, do not format before passing]
     * @param  [type] $sale_price [description]
     * @return [type]             [description]
     */
    public function sale_price($sale_price)
    {
        $node = new Node('sale_price');
        $this->nodes['sale_price'] = $node->value(number_format($sale_price, 2, '.', ''))->_namespace($this->namespace);
    }

    /**
     * [description - Set the description of the product]
     * @param  [type] $description [description]
     * @return [type]              [description]
     */
    public function description($description)
    {
        $node = new Node('description');
        $description = $this->safeCharEncodeText($description);
        $this->nodes['description'] = $node->value(substr($description, 0, 5000))->_namespace($this->namespace)->addCdata();
    }

    /**
     * [condition - Set the condition of the product (pass in the constants above to standardise the values)]
     * @param  [type] $condition [description]
     * @return [type]            [description]
     */
    public function condition($condition = 'new')
    {
        $node = new Node('condition');
        $this->nodes['condition'] = $node->value($condition)->_namespace($this->namespace)->addCdata();
    }

    /**
     * [expiration_date description]
     * @param  [type] $expiration_date [description]
     * @return [type]                  [description]
     */
    public function expiration_date($expiration_date)
    {
        $node = new Node('expiration_date');
        $this->nodes['expiration_date'] = $node->value($expiration_date)->_namespace($this->namespace)->addCdata();
    }

    /**
     * [image_link description]
     * @param  [type] $image_link [description]
     * @return [type]             [description]
     */
    public function image_link($image_link)
    {
        $node = new Node('image_link');
        $image_link = $this->safeCharEncodeURL($image_link);
        $this->nodes['image_link'] = $node->value($image_link)->_namespace($this->namespace)->addCdata();
    }

    /**
     * [image_link description]
     * @param  [type] $additional_image_link [description]
     * @return [type]                        [description]
     */
    public function additional_image_link($additional_image_link)
    {
        $node = new Node('additional_image_link');
        $additional_image_link = $this->safeCharEncodeURL($additional_image_link);
        $this->nodes['additional_image_link'] = $node->value($additional_image_link)->_namespace($this->namespace)->addCdata();
    }

    /**
     * [brand description]
     * @param  [type] $brand [description]
     * @return [type]        [description]
     */
    public function brand($brand)
    {
        $node = new Node('brand');
        $brand = $this->safeCharEncodeText($brand);
        $this->nodes['brand'] = $node->value($brand)->_namespace($this->namespace)->addCdata();
    }

    /**
     * [mpn description]
     * @param  [type] $mnp [description]
     * @return [type]      [description]
     */
    public function mpn($mpn)
    {
        $node = new Node('mpn');
        $this->nodes['mpn'] = $node->value($mpn)->_namespace($this->namespace)->addCdata();
    }

    /**
     * [gtin description]
     * @param  [type] $gtin [description]
     * @return [type]       [description]
     */
    public function gtin($gtin)
    {
        $node = new Node('gtin');
        $this->nodes['gtin'] = $node->value($gtin)->_namespace($this->namespace)->addCdata();
    }

    /**
     * [product_type description]
     * @param  [type] $product_type [description]
     * @return [type]               [description]
     */
    public function product_type($product_type)
    {
        $node = new Node('product_type');
        $product_type = $this->safeCharEncodeText($product_type);
        $this->nodes['product_type'] = $node->value($product_type)->_namespace($this->namespace)->addCdata();
    }

    /**
     * [google_product_category description]
     * @param  [type] $google_product_category [description]
     * @return [type]                          [description]
     */
    public function google_product_category($google_product_category)
    {
        $node = new Node('google_product_category');
        $this->nodes['google_product_category'] = $node->value($google_product_category)->_namespace($this->namespace)->addCdata();
    }

    /**
     * [availability description]
     * @param  [type] $availability [description]
     * @return [type]               [description]
     */
    public function availability($availability)
    {
        $node = new Node('availability');
        $this->nodes['availability'] = $node->value($availability)->_namespace($this->namespace);
    }

    /**
     * [shipping description]
     * @param  [type] $code    [description]
     * @param  [type] $service [description]
     * @param  [type] $cost    [description]
     * @return [type]          [description]
     */
    public function shipping($code, $service, $cost)
    {
        $node = new Node('shipping');
        $value = "<g:country>{$code}</g:country><g:service>{$service}</g:service><g:price>{$cost}</g:price>";
        if (!isset($this->nodes['shipping'])) {
            $this->nodes['shipping'] = array();
        }
        $this->nodes['shipping'][] = $node->value($value)->_namespace($this->namespace);
    }

    /**
     * [size description]
     * @param  [type] $size [description]
     * @return [type]       [description]
     */
    public function size($size)
    {
        $node = new Node('size');
        $this->nodes['size'] = $node->value($size)->_namespace($this->namespace);
    }

    /**
     * [size description]
     * @param  [type] $size_type [description]
     * @return [type]            [description]
     */
    public function size_type($size_type)
    {
        $node = new Node('size_type');
        $this->nodes['size_type'] = $node->value($size_type)->_namespace($this->namespace);
    }

    /**
     * [size_system description]
     * @param  [type] $size_system [description]
     * @return [type]              [description]
     */
    public function size_system($size_system)
    {
        $node = new Node('size_system');
        $this->nodes['size_system'] = $node->value($size_system)->_namespace($this->namespace);
    }

    /**
     * [gender description]
     * @param  [type] $gender [description]
     * @return [type]         [description]
     */
    public function gender($gender)
    {
        $node = new Node('gender');
        $this->nodes['gender'] = $node->value($gender)->_namespace($this->namespace);
    }

    /**
     * [age_group description]
     * @param  [type] $age_group [description]
     * @return [type]            [description]
     */
    public function age_group($age_group)
    {
        $node = new Node('age_group');
        $this->nodes['age_group'] = $node->value($age_group)->_namespace($this->namespace);
    }

    /**
     * [color description]
     * @param  [type] $color [description]
     * @return [type]        [description]
     */
    public function color($colour)
    {
        $node = new Node('color');
        $this->nodes['color'] = $node->value($colour)->_namespace($this->namespace);
    }

    /**
     * [material description]
     * @param  [type] $material [description]
     * @return [type]           [description]
     */
    public function material($material)
    {
        $node = new Node('material');
        $this->nodes['material'] = $node->value($material)->_namespace($this->namespace);
    }

    /**
     * [pattern description]
     * @param  [type] $pattern [description]
     * @return [type]          [description]
     */
    public function pattern($pattern)
    {
        $node = new Node('pattern');
        $this->nodes['pattern'] = $node->value($pattern)->_namespace($this->namespace);
    }

    /**
     * [pattern description]
     * @param  [type] $custom_label_0 [description]
     * @return [type]                 [description]
     */
    public function custom_label_0($custom_label_0)
    {
        $node = new Node('custom_label_0');
        $this->nodes['custom_label_0'] = $node->value($custom_label_0)->_namespace($this->namespace);
    }

    /**
     * [pattern description]
     * @param  [type] $custom_label_1 [description]
     * @return [type]                 [description]
     */
    public function custom_label_1($custom_label_1)
    {
        $node = new Node('custom_label_1');
        $this->nodes['custom_label_1'] = $node->value($custom_label_1)->_namespace($this->namespace);
    }

    /**
     * [pattern description]
     * @param  [type] $custom_label_2 [description]
     * @return [type]                 [description]
     */
    public function custom_label_2($custom_label_2)
    {
        $node = new Node('custom_label_2');
        $this->nodes['custom_label_2'] = $node->value($custom_label_2)->_namespace($this->namespace);
    }

    /**
     * [pattern description]
     * @param  [type] $custom_label_3 [description]
     * @return [type]                 [description]
     */
    public function custom_label_3($custom_label_3)
    {
        $node = new Node('custom_label_3');
        $this->nodes['custom_label_3'] = $node->value($custom_label_3)->_namespace($this->namespace);
    }

    /**
     * [pattern description]
     * @param  [type] $custom_label_4 [description]
     * @return [type]                 [description]
     */
    public function custom_label_4($custom_label_4)
    {
        $node = new Node('custom_label_4');
        $this->nodes['custom_label_4'] = $node->value($custom_label_4)->_namespace($this->namespace);
    }

    /**
     * [item_group_id description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */

    public function item_group_id($id)
    {
        $node = new Node('item_group_id');
        $this->nodes['item_group_id'] = $node->value($id)->_namespace($this->namespace);
    }

    /**
     * [nodes description]
     * @return [type] [description]
     */
    public function nodes()
    {
        return $this->nodes;
    }

    /**
     * [setIndex description]
     * @param [type] $index [description]
     */
    public function setIndex($index)
    {
        $this->index = $index;
    }

    /**
     * [delete description]
     * @return [type] [description]
     */
    public function delete()
    {
        GoogleShopping::removeItemByIndex($this->index);
    }

    /**
     * [clone description]
     * @return [type] [description]
     */
    public function cloneIt()
    {
        $item = GoogleShopping::createItem();
        $this->item_group_id($this->nodes['mpn']->get('value') . '_group');
        foreach ($this->nodes as $node) {
            if (is_array($node)) {
                $name = $node[0]->get('name');
                foreach ($node as $_node) {
                    if ($name == 'shipping') {
                        $xml = simplexml_load_string('<foo>' . trim(str_replace('g:', '',
                                $_node->get('value'))) . '</foo>');
                        $item->{$_node->get('name')}($xml->country, $xml->service, $xml->price);
                    } else {
                        $item->{$name}($_node->get('value'));
                    }
                }
                $item->{$node->get('name')}($node->get('value'));
            }
        }
        return $item;
    }

    /**
     * [variant description]
     * @return [type] [description]
     */
    public function variant()
    {
        $item = $this->cloneIt();
        $item->item_group_id($this->nodes['mpn']->get('value') . '_group');
        return $item;
    }

    /**
     * [safeCharEncode description]
     * @param  [type] $string [description]
     * @return [type]         [description]
     */
    private function safeCharEncodeURL($string)
    {
        return str_replace(
            array('%', '[', ']', '{', '}', '|', ' ', '"', '<', '>', '#', '\\', '^', '~', '`'),
            array(
                '%25',
                '%5b',
                '%5d',
                '%7b',
                '%7d',
                '%7c',
                '%20',
                '%22',
                '%3c',
                '%3e',
                '%23',
                '%5c',
                '%5e',
                '%7e',
                '%60'
            ),
            $string);
    }

    /**
     * [safeCharEncodeText description]
     * @param  [type] $string [description]
     * @return [type]         [description]
     */
    private function safeCharEncodeText($string)
    {
        return str_replace(
            array('•', '”', '“', '’', '‘', '™', '®', '°'),
            array('&#8226;', '&#8221;', '&#8220;', '&#8217;', '&#8216;', '&trade;', '&reg;', '&deg;'),
            $string);
    }

}
