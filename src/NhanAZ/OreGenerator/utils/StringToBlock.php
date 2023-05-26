<?php

declare(strict_types=1);

namespace NhanAZ\OreGenerator\utils;

use Exception;
use pocketmine\block\Block;
use pocketmine\item\LegacyStringToItemParser;
use pocketmine\item\StringToItemParser;
use function is_null;

class StringToBlock {

	public static function parse(string $string) : ?Block {
		try {
			$item = StringToItemParser::getInstance()->parse($string);
			if (is_null($item)) {
				$item = LegacyStringToItemParser::getInstance()->parse($string);
			}
			$block = $item->getBlock();
		} catch (Exception $e) {
			$block = null;
		}
		return $block;
	}
}
