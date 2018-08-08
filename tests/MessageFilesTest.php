<?php

namespace trk\uikit\tests;

use luya\testsuite\cases\WebApplicationTestCase;
use luya\testsuite\traits\MessageFileCompareTrait;

class MessageFilesTest extends WebApplicationTestCase
{
	use MessageFileCompareTrait;
	
	public function getConfigArray()
	{
		return [
			'id' => 'migrationtestcase',
			 'basePath' => dirname(__DIR__),
		];
	}
	
	public function testCompareMessage()
	{
		$this->compareMessages(__DIR__.'/../src/messages', 'en');
	}
}
