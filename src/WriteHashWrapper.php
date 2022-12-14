<?php
/**
 * @copyright Copyright (c) 2019 Raman Deep Bajwa <dbajwa763@gmail.com>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace BInfotech\Streams;

/**
 * Wrapper that calculates the hash on the stream on write
 *
 * The stream and hash should be passed in when wrapping the stream.
 * On close the callback will be called with the calculated checksum.
 *
 * For supported hashes see: http://php.net/manual/en/function.hash-algos.php
 */
class WriteHashWrapper extends HashWrapper {
	public function stream_write($data) {
		$this->updateHash($data);
		return parent::stream_write($data);
	}
}
