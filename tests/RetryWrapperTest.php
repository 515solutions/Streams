<?php
/**
 * Copyright (c) 2014 Raman Deep Bajwa <dbajwa763@gmail.com>
 * This file is licensed under the Licensed under the MIT license:
 * http://opensource.org/licenses/MIT
 */

namespace BInfotech\Streams\Tests;

class RetryWrapperTest extends WrapperTest {

	/**
	 * @param resource $source
	 * @return resource
	 */
	protected function wrapSource($source) {
		return \BInfotech\Streams\RetryWrapper::wrap(PartialWrapper::wrap($source));
	}

	public function testReadDir() {
		$this->markTestSkipped('directories not supported');
	}

	public function testRewindDir() {
		$this->markTestSkipped('directories not supported');
	}

	public function testFailedRead() {
		$source = fopen('data://text/plain,foo', 'r');
		$wrapped = \BInfotech\Streams\RetryWrapper::wrap(FailWrapper::wrap($source));
		$this->assertEquals('', fread($wrapped, 10));
	}

	public function testFailedWrite() {
		$source = fopen('php://temp', 'w');
		$wrapped = \BInfotech\Streams\RetryWrapper::wrap(FailWrapper::wrap($source));
		$this->assertFalse((bool)fwrite($wrapped, 'foo'));
	}
}
