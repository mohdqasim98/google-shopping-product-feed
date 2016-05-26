<?php

use NinthYard\GoogleShoppingFeed\Feed;

class GoogleShoppingFeedTest extends PHPUnit_Framework_TestCase
{

	public function TestFeedItems()
	{
		$google_shopping_feed = new Feed();
		$this->assertTrue($google_shopping_feed->feed_items());
	}

}
