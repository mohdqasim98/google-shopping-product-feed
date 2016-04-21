<?php
namespace NinthYard\GoogleShoppingFeed;

use SimpleXMLElement;
use NinthYard\GoogleShoppingFeed\Item;

class Feed {

	/**
	 * [$namespace description]
	 * @var string
	 */
	protected $namespace = 'http://base.google.com/ns/1.0';

	/**
	 * [$version description]
	 * @var string
	 */
	protected $version = '2.0';

	/**
	 * [$items Stores the list of items for the feed]
	 * @var array
	 */
	private $items = array();

	/**
	 * [$channelCreated description]
	 * @var boolean
	 */
	private $channelCreated = false;

	/**
	 * [$feed The base for the feed]
	 * @var null
	 */
	private $feed = null;

	/**
	 * [$title description]
	 * @var string
	 */
	private $title = '';

	/**
	 * [$description description]
	 * @var string
	 */
	private $description = '';

	/**
	 * [$link description]
	 * @var string
	 */
	private $link = '';

	/**
	 * [__construct description]
	 */
	public function __construct()
	{
		$this->feed = new SimpleXMLElement('<rss xmlns:g="' . $this->namespace . '" version="' . $this->version . '"></rss>');
	}

	/**
	 * [title description]
	 * @param  [type] $string [description]
	 * @return [type]         [description]
	 */
	public function title($string)
	{
		$this->title = (string)$string;
	}

	/**
	 * [description description]
	 * @param  [type] $string [description]
	 * @return [type]         [description]
	 */
	public function description($string)
	{
		$this->description = (string)$string;
	}

	/**
	 * [link description]
	 * @param  [type] $string [description]
	 * @return [type]         [description]
	 */
	public function link($string)
	{
		$this->link = (string)$string;
	}

	/**
	 * [channel description]
	 * @return [type] [description]
	 */
	private function channel()
	{
		if (!$this->channelCreated)
		{
			$channel = $this->feed->addChild('channel');
			$channel->addChild('title', $this->title);
	        $channel->addChild('link', $this->link);
	        $channel->addChild('description', $this->description);
	        $this->channelCreated = true;
	    }
	}

	/**
	 * [createItem description]
	 * @return [type] [description]
	 */
	public function createItem()
	{
		$this->channel();
		$item = new Item;
		$index = 'index_' . md5(microtime());
		$this->items[$index] = $item;
		$item->setIndex($index); 
		return $item;
	}

	/**
	 * [removeItemByIndex description]
	 * @param  [type] $index [description]
	 * @return [type]        [description]
	 */
	public function removeItemByIndex($index)
	{
		unset($this->items[$index]);
	}

	/**
	 * [standardiseSizeVarient description]
	 * @param  [type] $value [description]
	 * @return [type]        [description]
	 */
	public function standardiseSizeVarient($value)
	{
		return $value;
	}

	/**
	 * [standardiseSizeVarient description]
	 * @param  [type] $value [description]
	 * @return [type]        [description]
	 */
	public function standardiseColourVarient($value)
	{
		return $value;
	}

	/**
	 * [isVariant description]
	 * @param  [type]  $group [description]
	 * @return boolean        [description]
	 */
	public function isVariant($group)
	{
		if (preg_match("#^\s*colou?rs?\s*$#is", trim($group))) return 'color';
		if (preg_match("#^\s*sizes?\s*$#is", trim($group))) return 'size';
		if (preg_match("#^\s*materials?\s*$#is", trim($group))) return 'material';
		if (preg_match("#^\s*patterns?\s*$#is", trim($group))) return 'pattern';
		return false;
	}

	/**
	 * [addItemsToFeed description]
	 */
	private function addItemsToFeed()
	{
		foreach($this->items as $item)
		{
			$feed_item_node = $this->feed->channel->addChild('item');
			foreach ($item->nodes() as $item_node)
			{
				if (is_array($item_node))
				{
					foreach($item_node as $node)
					{
						$feed_item_node->addChild($node->get('name'), $node->get('value'), $node->get('_namespace'));
					}
				}
				else
				{
					$item_node->attachNodeTo($feed_item_node);
				}
			}
		}
	}

	/**
	 * [asRss description]
	 * @return [type] [description]
	 */
	public function asRss($output = false)
	{
		ob_end_clean();
		$this->addItemsToFeed();
		$data = html_entity_decode($this->feed->asXml());
		if ($output)
		{
			header('Content-Type: application/xml; charset=utf-8');
			die($data);
		}
		return $data;
	}

	/**
	 * [removeLastItem description]
	 * @return [type] [description]
	 */
	public function removeLastItem()
	{
		array_pop($this->items);
	}

}
