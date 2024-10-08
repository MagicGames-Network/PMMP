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

namespace pocketmine\data\bedrock\block;

final class CachingBlockStateSerializer implements DelegatingBlockStateSerializer{

	/**
	 * @var BlockStateData[]
	 * @phpstan-var array<int, BlockStateData>
	 */
	private array $cache = [];

	public function __construct(
		private BlockStateSerializer $realSerializer
	){}

	public function serialize(int $stateId) : BlockStateData{
		return $this->cache[$stateId] ??= $this->realSerializer->serialize($stateId);
	}

	public function getRealSerializer() : BlockStateSerializer{ return $this->realSerializer; }
}
