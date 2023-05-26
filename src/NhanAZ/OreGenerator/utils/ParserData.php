<?php

declare(strict_types=1);

namespace NhanAZ\OreGenerator\utils;

use function explode;

class ParserData {

	/**
	 * Data format: "isOreGenerator:(bool) owner:(string) level:(int) durability:(int)"
	 *
	 * Example data format: "isOreGenerator:true owner:NhanAZ level:1 durability:1000"
	 *
	 * @return array<string, bool|string|int|int>
	 */
	public static function parse(string $data) : array {
		$data = explode(" ", $data);
		return [
			"isOreGenerator" => (bool) explode(":", $data[0])[1],
			"owner" => (string) explode(":", $data[1])[1],
			"level" => (int) explode(":", $data[2])[1],
			"durability" => (int) explode(":", $data[3])[1],
		];
	}
}
