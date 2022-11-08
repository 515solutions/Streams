<?php
/**
 * Copyright (c) 2016 Raman Deep Bajwa <dbajwa763@gmail.com>
 * This file is licensed under the Licensed under the MIT license:
 * http://opensource.org/licenses/MIT
 */

namespace BInfotech\Streams\Tests;

use PHPUnit\Framework\TestCase;

class PathWrapperTest extends TestCase {
	private function getDataStream($data) {
		$stream = fopen('php://temp', 'w+');
		fwrite($stream, $data);
		rewind($stream);
		return $stream;
	}

	public function testFileGetContents() {
		$data = 'foobar';
		$stream = $this->getDataStream($data);
		$path = \BInfotech\Streams\PathWrapper::getPath($stream);
		$this->assertSame($data, file_get_contents($path));
	}
}
