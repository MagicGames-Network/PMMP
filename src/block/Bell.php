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

use pocketmine\block\tile\Bell as TileBell;
use pocketmine\block\utils\BellAttachmentType;
use pocketmine\block\utils\HorizontalFacingTrait;
use pocketmine\block\utils\SupportType;
use pocketmine\data\runtime\RuntimeDataReader;
use pocketmine\data\runtime\RuntimeDataWriter;
use pocketmine\data\runtime\RuntimeEnumDeserializer;
use pocketmine\data\runtime\RuntimeEnumSerializer;
use pocketmine\item\Item;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;
use pocketmine\world\sound\BellRingSound;

final class Bell extends Transparent{
	use HorizontalFacingTrait;

	private BellAttachmentType $attachmentType;

	public function __construct(BlockIdentifier $idInfo, string $name, BlockBreakInfo $breakInfo){
		$this->attachmentType = BellAttachmentType::FLOOR();
		parent::__construct($idInfo, $name, $breakInfo);
	}

	public function getRequiredStateDataBits() : int{ return 4; }

	protected function decodeState(RuntimeDataReader $r) : void{
		$this->attachmentType = RuntimeEnumDeserializer::readBellAttachmentType($r);
		$this->facing = $r->readHorizontalFacing();
	}

	protected function encodeState(RuntimeDataWriter $w) : void{
		RuntimeEnumSerializer::writeBellAttachmentType($w, $this->attachmentType);
		$w->writeHorizontalFacing($this->facing);
	}

	protected function recalculateCollisionBoxes() : array{
		if($this->attachmentType->equals(BellAttachmentType::FLOOR())){
			return [
				AxisAlignedBB::one()->squash(Facing::axis($this->facing), 1 / 4)->trim(Facing::UP, 3 / 16)
			];
		}
		if($this->attachmentType->equals(BellAttachmentType::CEILING())){
			return [
				AxisAlignedBB::one()->contract(1 / 4, 0, 1 / 4)->trim(Facing::DOWN, 1 / 4)
			];
		}

		$box = AxisAlignedBB::one()
			->squash(Facing::axis(Facing::rotateY($this->facing, true)), 1 / 4)
			->trim(Facing::UP, 1 / 16)
			->trim(Facing::DOWN, 1 / 4);

		return [
			$this->attachmentType->equals(BellAttachmentType::ONE_WALL()) ? $box->trim($this->facing, 3 / 16) : $box
		];
	}

	public function getSupportType(int $facing) : SupportType{
		return SupportType::NONE();
	}

	public function getAttachmentType() : BellAttachmentType{ return $this->attachmentType; }

	/** @return $this */
	public function setAttachmentType(BellAttachmentType $attachmentType) : self{
		$this->attachmentType = $attachmentType;
		return $this;
	}

	private function canBeSupportedBy(Block $block) : bool{
		//TODO: this isn't the actual logic, but it's the closest approximation we can support for now
		return $block->isSolid();
	}

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if($face === Facing::UP){
			if(!$this->canBeSupportedBy($tx->fetchBlock($this->position->down()))){
				return false;
			}
			if($player !== null){
				$this->setFacing(Facing::opposite($player->getHorizontalFacing()));
			}
			$this->setAttachmentType(BellAttachmentType::FLOOR());
		}elseif($face === Facing::DOWN){
			if(!$this->canBeSupportedBy($tx->fetchBlock($this->position->up()))){
				return false;
			}
			$this->setAttachmentType(BellAttachmentType::CEILING());
		}else{
			$this->setFacing($face);
			if($this->canBeSupportedBy($tx->fetchBlock($this->position->getSide(Facing::opposite($face))))){
				$this->setAttachmentType(BellAttachmentType::ONE_WALL());
			}else{
				return false;
			}
			if($this->canBeSupportedBy($tx->fetchBlock($this->position->getSide($face)))){
				$this->setAttachmentType(BellAttachmentType::TWO_WALLS());
			}
		}
		return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
	}

	public function onNearbyBlockChange() : void{
		if(
			($this->attachmentType->equals(BellAttachmentType::CEILING()) && !$this->canBeSupportedBy($this->getSide(Facing::UP))) ||
			($this->attachmentType->equals(BellAttachmentType::FLOOR()) && !$this->canBeSupportedBy($this->getSide(Facing::DOWN))) ||
			($this->attachmentType->equals(BellAttachmentType::ONE_WALL()) && !$this->canBeSupportedBy($this->getSide(Facing::opposite($this->facing)))) ||
			($this->attachmentType->equals(BellAttachmentType::TWO_WALLS()) && (!$this->canBeSupportedBy($this->getSide($this->facing)) || !$this->canBeSupportedBy($this->getSide(Facing::opposite($this->facing)))))
		){
			$this->position->getWorld()->useBreakOn($this->position);
		}
	}

	public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if($player !== null){
			$faceHit = Facing::opposite($player->getHorizontalFacing());
			if($this->attachmentType->equals(BellAttachmentType::CEILING())){
				$this->ring($faceHit);
			}
			if($this->attachmentType->equals(BellAttachmentType::FLOOR()) && Facing::axis($faceHit) === Facing::axis($this->facing)){
				$this->ring($faceHit);
			}
			if(
				($this->attachmentType->equals(BellAttachmentType::ONE_WALL()) || $this->attachmentType->equals(BellAttachmentType::TWO_WALLS())) &&
				($faceHit === Facing::rotateY($this->facing, false) || $faceHit === Facing::rotateY($this->facing, true))
			){
				$this->ring($faceHit);
			}
		}

		return true;
	}

	public function ring(int $faceHit) : void{
		$this->position->getWorld()->addSound($this->position, new BellRingSound());
		$tile = $this->position->getWorld()->getTile($this->position);
		if($tile instanceof TileBell){
			$this->position->getWorld()->broadcastPacketToViewers($this->position, $tile->createFakeUpdatePacket($faceHit));
		}
	}
}
