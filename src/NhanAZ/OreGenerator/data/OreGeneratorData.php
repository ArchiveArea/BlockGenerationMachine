<?php

declare(strict_types=1);

namespace NhanAZ\OreGenerator\data;

use cosmicpe\blockdata\BlockData;
use pocketmine\nbt\tag\CompoundTag;

class OreGeneratorData implements BlockData {

	public static function nbtDeserialize(CompoundTag $nbt) : BlockData {
		return new OreGeneratorData(
			$nbt->getString("data")
		);
	}

	private string $data;

	public function __construct(?string $data = null) {
		$this->data = $data ?? "";
	}

	public function getData() : string {
		return $this->data;
	}

	public function setData(?string $data = null) : void {
		$this->data = $data ?? "";
	}

	public function nbtSerialize() : CompoundTag {
		return CompoundTag::create()
			->setString("data", $this->data);
	}
}
