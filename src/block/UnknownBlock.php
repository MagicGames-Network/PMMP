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
use pocketmine\item\Item;

class UnknownBlock extends Transparent{

	private int $stateData;

	public function __construct(BlockIdentifier $idInfo, BlockBreakInfo $breakInfo, int $stateData){
		parent::__construct($idInfo, "Unknown", $breakInfo);
		$this->stateData = $stateData;
	}

	protected function decodeType(RuntimeDataReader $r) : void{
		//use type instead of state, so we don't lose any information like colour
		//this might be an improperly registered plugin block
		$this->stateData = $r->readInt(Block::INTERNAL_STATE_DATA_BITS);
	}

	protected function encodeType(RuntimeDataWriter $w) : void{
		$w->writeInt(Block::INTERNAL_STATE_DATA_BITS, $this->stateData);
	}

	public function canBePlaced() : bool{
		return false;
	}

	public function getDrops(Item $item) : array{
		return [];
	}
}
