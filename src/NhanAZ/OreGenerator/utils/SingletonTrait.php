<?php

declare(strict_types=1);

namespace NhanAZ\OreGenerator\utils;

use NhanAZ\OreGenerator\OreGenerator;

trait SingletonTrait {

	public static OreGenerator $instance;

	public static function setInstance(OreGenerator $instance) : void {
		self::$instance = $instance;
	}

	public static function getInstance() : OreGenerator {
		return self::$instance;
	}
}
