<?php

class PinyinTest extends TestCase {

	public function testToPinyin()
	{
		$method = new ReflectionMethod(
          'AdminCommand', 'toPinyin'
        );

        $method->setAccessible(TRUE);

		$this->assertEquals('a', $method->invoke(null, 'a'));
		$this->assertEquals('long', $method->invoke(null, 'long'));
		$this->assertEquals('nasuohuaer,naxiehuaer,nesuohuaer,nexiehuaer,neisuohuaer,neixiehuaer', $method->invoke(null, '那些花儿'));
	}

}
