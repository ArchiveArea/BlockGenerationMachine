<?php

declare(strict_types=1);

namespace NhanAZ\OreGenerator\config;

use NhanAZ\OreGenerator\OreGenerator;
use NhanAZ\OreGenerator\utils\StringToBlock;
use function is_null;
use function strval;

class ConfigManager {

	public static function checkConfigFileds() : void {
		$defaultBlock = OreGenerator::getInstance()->getConfig()->get("defaultBlock");
		$tempDefaultBlock = strval($defaultBlock);
		$defaultBlock = StringToBlock::parse(strval($defaultBlock));
		if (is_null($defaultBlock)) {
			OreGenerator::getInstance()->getLogger()->critical("defaultBlock: \"{$tempDefaultBlock}\" > Invalid block! Please set a valid value for the defaultBlock field in config.yml. Cobblestone will be used instead.");
		}
	}
}
