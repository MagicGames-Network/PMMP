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

use pocketmine\block\tile\Skull as TileSkull;
use pocketmine\block\utils\InvalidBlockStateException;
use pocketmine\block\utils\SkullType;
use pocketmine\data\runtime\block\BlockDataReader;
use pocketmine\data\runtime\block\BlockDataReaderHelper;
use pocketmine\data\runtime\block\BlockDataWriter;
use pocketmine\data\runtime\block\BlockDataWriterHelper;
use pocketmine\item\Item;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;
use function assert;
use function floor;

class Skull extends Flowable{
	public const MIN_ROTATION = 0;
	public const MAX_ROTATION = 15;

	protected SkullType $skullType;

	protected int $facing = Facing::NORTH;
	protected int $rotation = self::MIN_ROTATION; //TODO: split this into floor skull and wall skull handling

	public function __construct(BlockIdentifier $idInfo, string $name, BlockBreakInfo $breakInfo){
		$this->skullType = SkullType::SKELETON(); //TODO: this should be a parameter
		parent::__construct($idInfo, $name, $breakInfo);
	}

	public function getRequiredTypeDataBits() : int{ return 3; }

	protected function decodeType(BlockDataReader $r) : void{
		$this->skullType = BlockDataReaderHelper::readSkullType($r);
	}

	protected function encodeType(BlockDataWriter $w) : void{
		BlockDataWriterHelper::writeSkullType($w, $this->skullType);
	}

	public function getRequiredStateDataBits() : int{ return 3; }

	protected function decodeState(BlockDataReader $r) : void{
		$facing = $r->readFacing();
		if($facing === Facing::DOWN){
			throw new InvalidBlockStateException("Skull may not face down");
		}
		$this->facing = $facing;
	}

	protected function encodeState(BlockDataWriter $w) : void{
		$w->writeFacing($this->facing);
	}

	public function readStateFromWorld() : void{
		parent::readStateFromWorld();
		$tile = $this->position->getWorld()->getTile($this->position);
		if($tile instanceof TileSkull){
			$this->skullType = $tile->getSkullType();
			$this->rotation = $tile->getRotation();
		}
	}

	public function writeStateToWorld() : void{
		parent::writeStateToWorld();
		//extra block properties storage hack
		$tile = $this->position->getWorld()->getTile($this->position);
		assert($tile instanceof TileSkull);
		$tile->setRotation($this->rotation);
		$tile->setSkullType($this->skullType);
	}

	public function getSkullType() : SkullType{
		return $this->skullType;
	}

	/** @return $this */
	public function setSkullType(SkullType $skullType) : self{
		$this->skullType = $skullType;
		return $this;
	}

	public function getFacing() : int{ return $this->facing; }

	/** @return $this */
	public function setFacing(int $facing) : self{
		if($facing === Facing::DOWN){
			throw new \InvalidArgumentException("Skull may not face DOWN");
		}
		$this->facing = $facing;
		return $this;
	}

	public function getRotation() : int{ return $this->rotation; }

	/** @return $this */
	public function setRotation(int $rotation) : self{
		if($rotation < self::MIN_ROTATION || $rotation > self::MAX_ROTATION){
			throw new \InvalidArgumentException("Rotation must be in range " . self::MIN_ROTATION . " ... " . self::MAX_ROTATION);
		}
		$this->rotation = $rotation;
		return $this;
	}

	/**
	 * @return AxisAlignedBB[]
	 */
	protected function recalculateCollisionBoxes() : array{
		$collisionBox = AxisAlignedBB::one()->contract(0.25, 0, 0.25)->trim(Facing::UP, 0.5);
		return match($this->facing){
			Facing::NORTH => [$collisionBox->offset(0, 0.25, 0.25)],
			Facing::SOUTH => [$collisionBox->offset(0, 0.25, -0.25)],
			Facing::WEST => [$collisionBox->offset(0.25, 0.25, 0)],
			Facing::EAST => [$collisionBox->offset(-0.25, 0.25, 0)],
			default => [$collisionBox]
		};
	}

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if($face === Facing::DOWN){
			return false;
		}

		$this->facing = $face;
		if($player !== null && $face === Facing::UP){
			$this->rotation = ((int) floor(($player->getLocation()->getYaw() * 16 / 360) + 0.5)) & 0xf;
		}
		return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
	}
}
