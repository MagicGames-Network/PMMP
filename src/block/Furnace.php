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

use pocketmine\block\tile\Furnace as TileFurnace;
use pocketmine\block\utils\FacesOppositePlacingPlayerTrait;
use pocketmine\block\utils\HorizontalFacingTrait;
use pocketmine\data\runtime\RuntimeDataReader;
use pocketmine\data\runtime\RuntimeDataWriter;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use function mt_rand;

class Furnace extends Opaque{
	use FacesOppositePlacingPlayerTrait;
	use HorizontalFacingTrait;

	protected bool $lit = false;

	public function getRequiredStateDataBits() : int{ return 3; }

	protected function decodeState(RuntimeDataReader $r) : void{
		$this->facing = $r->readHorizontalFacing();
		$this->lit = $r->readBool();
	}

	protected function encodeState(RuntimeDataWriter $w) : void{
		$w->writeHorizontalFacing($this->facing);
		$w->writeBool($this->lit);
	}

	public function getLightLevel() : int{
		return $this->lit ? 13 : 0;
	}

	public function isLit() : bool{
		return $this->lit;
	}

	/**
	 * @return $this
	 */
	public function setLit(bool $lit = true) : self{
		$this->lit = $lit;
		return $this;
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		if($player instanceof Player){
			$furnace = $this->position->getWorld()->getTile($this->position);
			if($furnace instanceof TileFurnace && $furnace->canOpenWith($item->getCustomName())){
				$player->setCurrentWindow($furnace->getInventory());
			}
		}

		return true;
	}

	public function onScheduledUpdate() : void{
		$furnace = $this->position->getWorld()->getTile($this->position);
		if($furnace instanceof TileFurnace && $furnace->onUpdate()){
			if(mt_rand(1, 60) === 1){ //in vanilla this is between 1 and 5 seconds; try to average about 3
				$this->position->getWorld()->addSound($this->position, $furnace->getFurnaceType()->getCookSound());
			}
			$this->position->getWorld()->scheduleDelayedBlockUpdate($this->position, 1); //TODO: check this
		}
	}
}
