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

namespace pocketmine\block;

use pocketmine\data\runtime\RuntimeDataReader;
use pocketmine\data\runtime\RuntimeDataWriter;
use pocketmine\item\Hoe;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\sound\ItemUseOnBlockSound;

class Dirt extends Opaque{
	protected bool $coarse = false;

	public function getRequiredTypeDataBits() : int{ return 1; }

	protected function decodeType(RuntimeDataReader $r) : void{
		$this->coarse = $r->readBool();
	}

	protected function encodeType(RuntimeDataWriter $w) : void{
		$w->writeBool($this->coarse);
	}

	public function isCoarse() : bool{ return $this->coarse; }

	/** @return $this */
	public function setCoarse(bool $coarse) : self{
		$this->coarse = $coarse;
		return $this;
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		if($face === Facing::UP && $item instanceof Hoe){
			$item->applyDamage(1);

			$newBlock = $this->coarse ? VanillaBlocks::DIRT() : VanillaBlocks::FARMLAND();
			$this->position->getWorld()->addSound($this->position->add(0.5, 0.5, 0.5), new ItemUseOnBlockSound($newBlock));
			$this->position->getWorld()->setBlock($this->position, $newBlock);

			return true;
		}

		return false;
	}
}
