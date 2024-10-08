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
use pocketmine\event\block\BlockGrowEvent;
use pocketmine\item\Fertilizer;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

class Sugarcane extends Flowable{
	public const MAX_AGE = 15;

	protected int $age = 0;

	public function getRequiredStateDataBits() : int{ return 4; }

	protected function decodeState(RuntimeDataReader $r) : void{
		$this->age = $r->readBoundedInt(4, 0, self::MAX_AGE);
	}

	protected function encodeState(RuntimeDataWriter $w) : void{
		$w->writeBoundedInt(4, 0, self::MAX_AGE, $this->age);
	}

	private function grow() : bool{
		$grew = false;
		for($y = 1; $y < 3; ++$y){
			if(!$this->position->getWorld()->isInWorld($this->position->x, $this->position->y + $y, $this->position->z)){
				break;
			}
			$b = $this->position->getWorld()->getBlockAt($this->position->x, $this->position->y + $y, $this->position->z);
			if($b->getTypeId() === BlockTypeIds::AIR){
				$ev = new BlockGrowEvent($b, VanillaBlocks::SUGARCANE());
				$ev->call();
				if($ev->isCancelled()){
					break;
				}
				$this->position->getWorld()->setBlock($b->position, $ev->getNewState());
				$grew = true;
			}else{
				break;
			}
		}
		$this->age = 0;
		$this->position->getWorld()->setBlock($this->position, $this);
		return $grew;
	}

	public function getAge() : int{ return $this->age; }

	/** @return $this */
	public function setAge(int $age) : self{
		if($age < 0 || $age > self::MAX_AGE){
			throw new \InvalidArgumentException("Age must be in range 0 ... " . self::MAX_AGE);
		}
		$this->age = $age;
		return $this;
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []) : bool{
		if($item instanceof Fertilizer){
			if(!$this->getSide(Facing::DOWN)->isSameType($this) && $this->grow()){
				$item->pop();
			}

			return true;
		}

		return false;
	}

	public function onNearbyBlockChange() : void{
		$down = $this->getSide(Facing::DOWN);
		if($down->isTransparent() && !$down->isSameType($this)){
			$this->position->getWorld()->useBreakOn($this->position);
		}
	}

	public function ticksRandomly() : bool{
		return true;
	}

	public function onRandomTick() : void{
		if(!$this->getSide(Facing::DOWN)->isSameType($this)){
			if($this->age === self::MAX_AGE){
				$this->grow();
			}else{
				++$this->age;
				$this->position->getWorld()->setBlock($this->position, $this);
			}
		}
	}

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		$down = $this->getSide(Facing::DOWN);
		if($down->isSameType($this)){
			return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
		}elseif($down->getTypeId() === BlockTypeIds::GRASS || $down->getTypeId() === BlockTypeIds::DIRT || $down->getTypeId() === BlockTypeIds::SAND || $down->getTypeId() === BlockTypeIds::RED_SAND || $down->getTypeId() === BlockTypeIds::PODZOL){
			foreach(Facing::HORIZONTAL as $side){
				if($down->getSide($side) instanceof Water){
					return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
				}
			}
		}

		return false;
	}
}
