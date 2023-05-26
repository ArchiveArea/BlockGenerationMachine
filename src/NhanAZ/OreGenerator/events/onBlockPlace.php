<?php

declare(strict_types=1);

namespace NhanAZ\OreGenerator\events;

use NhanAZ\OreGenerator\data\OreGeneratorData;
use NhanAZ\OreGenerator\OreGenerator;
use NhanAZ\OreGenerator\utils\ParserData;
use NhanAZ\OreGenerator\utils\Sound;
use NhanAZ\OreGenerator\utils\StringToBlock;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\math\Facing;
use function is_null;
use function strval;

class onBlockPlace implements Listener {

	/** Y coordinate can build the highest OreGenerator of the world */
	const HIGHEST_BUILDABLE_Y = 319;

	public function onBlockPlace(BlockPlaceEvent $event) : void {
		$block = $event->getBlock();
		$item = $event->getItem();
		$blockPos = $block->getPosition();
		$getSideUP = $block->getSide(Facing::UP);
		if ($block->isSameType(VanillaBlocks::LEGACY_STONECUTTER())) {
			if (!$item->hasCustomBlockData()) {
				return;
			}
			if (is_null($item->getCustomBlockData())) {
				return;
			}
			$tempData = $item->getCustomBlockData()->getString("data");
			$data = ParserData::parse($tempData);
			if ($data["isOreGenerator"]) {
				if ($blockPos->y == self::HIGHEST_BUILDABLE_Y) {
					OreGenerator::getInstance()->onInvalidPosition($event, $blockPos);
					return;
				}
				if ($getSideUP->isSameType(VanillaBlocks::AIR())) {
					$data = new OreGeneratorData($tempData);
					OreGenerator::getInstance()->getManager()->get($blockPos->getWorld())->setBlockDataAt((int) $blockPos->x, (int) $blockPos->y, (int) $blockPos->z, $data);
					if (OreGenerator::getInstance()->getConfig()->getNested("sounds.invalidPosition")) {
						Sound::playFizz($blockPos);
					}
					$block = StringToBlock::parse(strval(OreGenerator::getInstance()->getConfig()->get("defaultBlock")));
					if (is_null($block)) {
						$block = VanillaBlocks::COBBLESTONE();
					}
					$blockPos->getWorld()->setBlock($blockPos->add(0, 1, 0), $block);
				} else {
					OreGenerator::getInstance()->onInvalidPosition($event, $blockPos);
					return;
				}
			}
		}
	}
}
