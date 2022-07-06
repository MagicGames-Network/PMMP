<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
 */

declare(strict_types=1);

namespace pocketmine\block\utils;

use pocketmine\block\Block;
use pocketmine\data\runtime\RuntimeDataReader;
use pocketmine\data\runtime\RuntimeDataWriter;
use pocketmine\data\runtime\RuntimeEnumDeserializer;
use pocketmine\data\runtime\RuntimeEnumSerializer;

trait ColoredTrait{
	/** @var DyeColor */
	private $color;

	public function getRequiredTypeDataBits() : int{ return 4; }

	/** @see Block::decodeType() */
	protected function decodeType(RuntimeDataReader $r) : void{
		$this->color = RuntimeEnumDeserializer::readDyeColor($r);
	}

	/** @see Block::encodeType() */
	protected function encodeType(RuntimeDataWriter $w) : void{
		RuntimeEnumSerializer::writeDyeColor($w, $this->color);
	}

	public function getColor() : DyeColor{ return $this->color; }

	/** @return $this */
	public function setColor(DyeColor $color) : self{
		$this->color = $color;
		return $this;
	}
}
