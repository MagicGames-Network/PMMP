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

use pocketmine\block\tile\Tile;
use pocketmine\utils\Utils;

class BlockIdentifier{
	/**
	 * @phpstan-param class-string<Tile>|null $tileClass
	 */
	public function __construct(
		private int $blockTypeId,
		private int $legacyBlockId,
		private int $legacyVariant,
		private ?int $legacyItemId = null,
		private ?string $tileClass = null
	){
		if($blockTypeId < 0){
			throw new \InvalidArgumentException("Block type ID may not be negative");
		}
		if($legacyBlockId < 0){
			throw new \InvalidArgumentException("Legacy block ID may not be negative");
		}
		if($legacyVariant < 0){
			throw new \InvalidArgumentException("Legacy block variant may not be negative");
		}

		if($tileClass !== null){
			Utils::testValidInstance($tileClass, Tile::class);
		}
	}

	public function getBlockTypeId() : int{ return $this->blockTypeId; }

	/**
	 * @deprecated
	 */
	public function getLegacyBlockId() : int{
		return $this->legacyBlockId;
	}

	/**
	 * @deprecated
	 */
	public function getLegacyVariant() : int{
		return $this->legacyVariant;
	}

	/**
	 * @deprecated
	 */
	public function getLegacyItemId() : int{
		return $this->legacyItemId ?? ($this->legacyBlockId > 255 ? 255 - $this->legacyBlockId : $this->legacyBlockId);
	}

	/**
	 * @phpstan-return class-string<Tile>|null
	 */
	public function getTileClass() : ?string{
		return $this->tileClass;
	}
}
