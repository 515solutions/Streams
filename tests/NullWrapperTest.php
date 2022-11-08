<?php
/**
 * Copyright (c) 2014 Raman Deep Bajwa <dbajwa763@gmail.com>
 * This file is licensed under the Licensed under the MIT license:
 * http://opensource.org/licenses/MIT
 */

namespace BInfotech\Streams\Tests;

class NullWrapperTest extends WrapperTest {

	/**
	 * @param resource $source
	 * @return resource
	 */
	protected function wrapSource($source) {
		return \BInfotech\Streams\NullWrapper::wrap($source);
	}

	public function testNoContext() {
		$this->expectException(\BadMethodCallException::class);
		stream_wrapper_register('null', '\BInfotech\Streams\NullWrapper');
		$context = stream_context_create([]);
		try {
			fopen('null://', 'r+', false, $context);
			stream_wrapper_unregister('null');
		} catch (\Exception $e) {
			stream_wrapper_unregister('null');
			throw $e;
		}
	}

	public function testNoSource() {
		$this->expectException(\BadMethodCallException::class);
		stream_wrapper_register('null', '\BInfotech\Streams\NullWrapper');
		$context = stream_context_create([
			'null' => [
				'source' => 'bar'
			]
		]);
		try {
			fopen('null://', 'r+', false, $context);
		} catch (\Exception $e) {
			stream_wrapper_unregister('null');
			throw $e;
		}
	}

	public function testWrapInvalidSource() {
		$this->expectException(\BadMethodCallException::class);
		$this->wrapSource('foo');
	}
}
