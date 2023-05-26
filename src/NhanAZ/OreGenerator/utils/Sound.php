<?php

declare(strict_types=1);

namespace NhanAZ\OreGenerator\utils;

use pocketmine\world\Position;
use pocketmine\world\sound\FizzSound;
use pocketmine\world\sound\NoteInstrument;
use pocketmine\world\sound\NoteSound;

class Sound {

	public static function playFizz(Position $blockPos) : void {
		$blockPos->getWorld()->addSound($blockPos->add(0.5, 0.5, 0.5), new FizzSound());
	}

	public static function playNote(Position $blockPos) : void {
		$blockPos->getWorld()->addSound($blockPos, new NoteSound(NoteInstrument::PIANO(), 1));
	}
}
