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

namespace pocketmine\data\bedrock\block\convert;

use pocketmine\block\ActivatorRail;
use pocketmine\block\Anvil;
use pocketmine\block\Bamboo;
use pocketmine\block\BambooSapling;
use pocketmine\block\Barrel;
use pocketmine\block\Bed;
use pocketmine\block\Beetroot;
use pocketmine\block\Bell;
use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\block\BoneBlock;
use pocketmine\block\BrewingStand;
use pocketmine\block\BrownMushroomBlock;
use pocketmine\block\Button;
use pocketmine\block\Cactus;
use pocketmine\block\Cake;
use pocketmine\block\Carpet;
use pocketmine\block\Carrot;
use pocketmine\block\CarvedPumpkin;
use pocketmine\block\ChemistryTable;
use pocketmine\block\Chest;
use pocketmine\block\CocoaBlock;
use pocketmine\block\Concrete;
use pocketmine\block\ConcretePowder;
use pocketmine\block\Coral;
use pocketmine\block\CoralBlock;
use pocketmine\block\DaylightSensor;
use pocketmine\block\DetectorRail;
use pocketmine\block\Dirt;
use pocketmine\block\Door;
use pocketmine\block\DoublePlant;
use pocketmine\block\DoubleTallGrass;
use pocketmine\block\DyedShulkerBox;
use pocketmine\block\EnderChest;
use pocketmine\block\EndPortalFrame;
use pocketmine\block\EndRod;
use pocketmine\block\Farmland;
use pocketmine\block\FenceGate;
use pocketmine\block\Fire;
use pocketmine\block\FloorBanner;
use pocketmine\block\FloorCoralFan;
use pocketmine\block\FloorSign;
use pocketmine\block\FrostedIce;
use pocketmine\block\Furnace;
use pocketmine\block\GlazedTerracotta;
use pocketmine\block\HayBale;
use pocketmine\block\Hopper;
use pocketmine\block\ItemFrame;
use pocketmine\block\Ladder;
use pocketmine\block\Lantern;
use pocketmine\block\Lava;
use pocketmine\block\Leaves;
use pocketmine\block\Lectern;
use pocketmine\block\Lever;
use pocketmine\block\Light;
use pocketmine\block\LitPumpkin;
use pocketmine\block\Loom;
use pocketmine\block\MelonStem;
use pocketmine\block\NetherPortal;
use pocketmine\block\NetherWartPlant;
use pocketmine\block\Potato;
use pocketmine\block\PoweredRail;
use pocketmine\block\PumpkinStem;
use pocketmine\block\Rail;
use pocketmine\block\RedMushroomBlock;
use pocketmine\block\RedstoneComparator;
use pocketmine\block\RedstoneLamp;
use pocketmine\block\RedstoneOre;
use pocketmine\block\RedstoneRepeater;
use pocketmine\block\RedstoneTorch;
use pocketmine\block\RedstoneWire;
use pocketmine\block\Sapling;
use pocketmine\block\SeaPickle;
use pocketmine\block\SimplePillar;
use pocketmine\block\SimplePressurePlate;
use pocketmine\block\Skull;
use pocketmine\block\Slab;
use pocketmine\block\SnowLayer;
use pocketmine\block\Sponge;
use pocketmine\block\StainedGlass;
use pocketmine\block\StainedGlassPane;
use pocketmine\block\StainedHardenedClay;
use pocketmine\block\StainedHardenedGlass;
use pocketmine\block\StainedHardenedGlassPane;
use pocketmine\block\Stair;
use pocketmine\block\StoneButton;
use pocketmine\block\Stonecutter;
use pocketmine\block\StonePressurePlate;
use pocketmine\block\Sugarcane;
use pocketmine\block\SweetBerryBush;
use pocketmine\block\TNT;
use pocketmine\block\Torch;
use pocketmine\block\Trapdoor;
use pocketmine\block\TrappedChest;
use pocketmine\block\Tripwire;
use pocketmine\block\TripwireHook;
use pocketmine\block\UnderwaterTorch;
use pocketmine\block\utils\BrewingStandSlot;
use pocketmine\block\utils\CoralType;
use pocketmine\block\utils\DyeColor;
use pocketmine\block\utils\LeverFacing;
use pocketmine\block\VanillaBlocks as Blocks;
use pocketmine\block\Vine;
use pocketmine\block\Wall;
use pocketmine\block\WallBanner;
use pocketmine\block\WallCoralFan;
use pocketmine\block\WallSign;
use pocketmine\block\Water;
use pocketmine\block\WeightedPressurePlateHeavy;
use pocketmine\block\WeightedPressurePlateLight;
use pocketmine\block\Wheat;
use pocketmine\block\Wood;
use pocketmine\block\WoodenButton;
use pocketmine\block\WoodenDoor;
use pocketmine\block\WoodenPressurePlate;
use pocketmine\block\WoodenStairs;
use pocketmine\block\WoodenTrapdoor;
use pocketmine\block\Wool;
use pocketmine\data\bedrock\block\BlockLegacyMetadata;
use pocketmine\data\bedrock\block\BlockStateData;
use pocketmine\data\bedrock\block\BlockStateNames as StateNames;
use pocketmine\data\bedrock\block\BlockStateSerializeException;
use pocketmine\data\bedrock\block\BlockStateSerializer;
use pocketmine\data\bedrock\block\BlockStateStringValues as StringValues;
use pocketmine\data\bedrock\block\BlockTypeNames as Ids;
use pocketmine\data\bedrock\block\convert\BlockStateSerializerHelper as Helper;
use pocketmine\data\bedrock\block\convert\BlockStateWriter as Writer;
use pocketmine\math\Axis;
use pocketmine\math\Facing;
use pocketmine\utils\AssumptionFailedError;
use function class_parents;
use function get_class;

final class BlockObjectToBlockStateSerializer implements BlockStateSerializer{
	/**
	 * These callables actually accept Block, but for the sake of type completeness, it has to be never, since we can't
	 * describe the bottom type of a type hierarchy only containing Block.
	 *
	 * @var \Closure[][]
	 * @phpstan-var array<int, array<class-string, \Closure(never) : Writer>>
	 */
	private array $serializers = [];

	public function __construct(){
		$this->registerSerializers();
	}

	public function serialize(int $stateId) : BlockStateData{
		//TODO: singleton usage not ideal
		return $this->serializeBlock(BlockFactory::getInstance()->fromStateId($stateId));
	}

	/**
	 * @phpstan-template TBlockType of Block
	 * @phpstan-param TBlockType $block
	 * @phpstan-param \Closure(TBlockType) : Writer $serializer
	 */
	public function map(Block $block, \Closure $serializer) : void{
		if(isset($this->serializers[$block->getTypeId()])){
			//TODO: REMOVE ME
			throw new AssumptionFailedError("Registering the same block twice!");
		}
		$this->serializers[$block->getTypeId()][get_class($block)] = $serializer;
	}

	public function mapSimple(Block $block, string $id) : void{
		$this->map($block, fn() => Writer::create($id));
	}

	public function mapSlab(Slab $block, string $singleId, string $doubleId) : void{
		$this->map($block, fn(Slab $block) => Helper::encodeSlab($block, $singleId, $doubleId));
	}

	public function mapStairs(Stair $block, string $id) : void{
		$this->map($block, fn(Stair $block) => Helper::encodeStairs($block, Writer::create($id)));
	}

	/**
	 * @phpstan-template TBlockType of Block
	 * @phpstan-param TBlockType $blockState
	 *
	 * @throws BlockStateSerializeException
	 */
	public function serializeBlock(Block $blockState) : BlockStateData{
		$typeId = $blockState->getTypeId();

		$locatedSerializer = $this->serializers[$typeId][get_class($blockState)] ?? null;
		if($locatedSerializer === null){
			$parents = class_parents($blockState);
			if($parents === false){
				throw new AssumptionFailedError("A block class should always have at least one parent");
			}
			foreach($parents as $parent){
				if(isset($this->serializers[$typeId][$parent])){
					$locatedSerializer = $this->serializers[$typeId][$parent];
					break;
				}
			}
		}

		if($locatedSerializer === null){
			throw new BlockStateSerializeException("No serializer registered for " . get_class($blockState) . " with type ID $typeId");
		}

		/**
		 * @var \Closure $serializer
		 * @phpstan-var \Closure(TBlockType) : Writer $serializer
		 */
		$serializer = $locatedSerializer;

		/** @var Writer $writer */
		$writer = $serializer($blockState);
		return $writer->getBlockStateData();
	}

	private function registerSerializers() : void{
		$this->map(Blocks::ACACIA_BUTTON(), fn(WoodenButton $block) => Helper::encodeButton($block, new Writer(Ids::ACACIA_BUTTON)));
		$this->map(Blocks::ACACIA_DOOR(), fn(WoodenDoor $block) => Helper::encodeDoor($block, new Writer(Ids::ACACIA_DOOR)));
		$this->map(Blocks::ACACIA_FENCE(), fn() => Writer::create(Ids::FENCE)
				->writeString(StateNames::WOOD_TYPE, StringValues::WOOD_TYPE_ACACIA));
		$this->map(Blocks::ACACIA_FENCE_GATE(), fn(FenceGate $block) => Helper::encodeFenceGate($block, new Writer(Ids::ACACIA_FENCE_GATE)));
		$this->map(Blocks::ACACIA_LEAVES(), fn(Leaves $block) => Helper::encodeLeaves2($block, StringValues::NEW_LEAF_TYPE_ACACIA));
		$this->map(Blocks::ACACIA_LOG(), fn(Wood $block) => Helper::encodeLog2($block, StringValues::NEW_LOG_TYPE_ACACIA, Ids::STRIPPED_ACACIA_LOG));
		$this->map(Blocks::ACACIA_PLANKS(), fn() => Writer::create(Ids::PLANKS)
				->writeString(StateNames::WOOD_TYPE, StringValues::WOOD_TYPE_ACACIA));
		$this->map(Blocks::ACACIA_PRESSURE_PLATE(), fn(WoodenPressurePlate $block) => Helper::encodeSimplePressurePlate($block, new Writer(Ids::ACACIA_PRESSURE_PLATE)));
		$this->map(Blocks::ACACIA_SAPLING(), fn(Sapling $block) => Helper::encodeSapling($block, StringValues::SAPLING_TYPE_ACACIA));
		$this->map(Blocks::ACACIA_SIGN(), fn(FloorSign $block) => Helper::encodeFloorSign($block, new Writer(Ids::ACACIA_STANDING_SIGN)));
		$this->map(Blocks::ACACIA_SLAB(), fn(Slab $block) => Helper::encodeWoodenSlab($block, StringValues::WOOD_TYPE_ACACIA));
		$this->map(Blocks::ACACIA_STAIRS(), fn(WoodenStairs $block) => Helper::encodeStairs($block, new Writer(Ids::ACACIA_STAIRS)));
		$this->map(Blocks::ACACIA_TRAPDOOR(), fn(WoodenTrapdoor $block) => Helper::encodeTrapdoor($block, new Writer(Ids::ACACIA_TRAPDOOR)));
		$this->map(Blocks::ACACIA_WALL_SIGN(), fn(WallSign $block) => Helper::encodeWallSign($block, new Writer(Ids::ACACIA_WALL_SIGN)));
		$this->map(Blocks::ACACIA_WOOD(), fn(Wood $block) => Helper::encodeAllSidedLog($block));
		$this->map(Blocks::ACTIVATOR_RAIL(), function(ActivatorRail $block) : Writer{
			return Writer::create(Ids::ACTIVATOR_RAIL)
				->writeBool(StateNames::RAIL_DATA_BIT, $block->isPowered())
				->writeInt(StateNames::RAIL_DIRECTION, $block->getShape());
		});
		$this->mapSimple(Blocks::AIR(), Ids::AIR);
		$this->map(Blocks::ALLIUM(), fn() => Helper::encodeRedFlower(StringValues::FLOWER_TYPE_ALLIUM));
		$this->map(Blocks::ALL_SIDED_MUSHROOM_STEM(), fn() => Writer::create(Ids::BROWN_MUSHROOM_BLOCK)
				->writeInt(StateNames::HUGE_MUSHROOM_BITS, BlockLegacyMetadata::MUSHROOM_BLOCK_ALL_STEM));
		$this->mapSimple(Blocks::AMETHYST(), Ids::AMETHYST_BLOCK);
		$this->mapSimple(Blocks::ANCIENT_DEBRIS(), Ids::ANCIENT_DEBRIS);
		$this->map(Blocks::ANDESITE(), fn() => Helper::encodeStone(StringValues::STONE_TYPE_ANDESITE));
		$this->map(Blocks::ANDESITE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab3($block, StringValues::STONE_SLAB_TYPE_3_ANDESITE));
		$this->map(Blocks::ANDESITE_STAIRS(), fn(Stair $block) => Helper::encodeStairs($block, new Writer(Ids::ANDESITE_STAIRS)));
		$this->map(Blocks::ANDESITE_WALL(), fn(Wall $block) => Helper::encodeLegacyWall($block, StringValues::WALL_BLOCK_TYPE_ANDESITE));
		$this->map(Blocks::ANVIL(), function(Anvil $block) : Writer{
			return Writer::create(Ids::ANVIL)
				->writeLegacyHorizontalFacing($block->getFacing())
				->writeString(StateNames::DAMAGE, match($damage = $block->getDamage()){
					0 => StringValues::DAMAGE_UNDAMAGED,
					1 => StringValues::DAMAGE_SLIGHTLY_DAMAGED,
					2 => StringValues::DAMAGE_VERY_DAMAGED,
					default => throw new BlockStateSerializeException("Invalid Anvil damage {$damage}"),
				});
		});
		$this->map(Blocks::AZURE_BLUET(), fn() => Helper::encodeRedFlower(StringValues::FLOWER_TYPE_HOUSTONIA));
		$this->map(Blocks::BAMBOO(), function(Bamboo $block) : Writer{
			return Writer::create(Ids::BAMBOO)
				->writeBool(StateNames::AGE_BIT, $block->isReady())
				->writeString(StateNames::BAMBOO_LEAF_SIZE, match($block->getLeafSize()){
					Bamboo::NO_LEAVES => StringValues::BAMBOO_LEAF_SIZE_NO_LEAVES,
					Bamboo::SMALL_LEAVES => StringValues::BAMBOO_LEAF_SIZE_SMALL_LEAVES,
					Bamboo::LARGE_LEAVES => StringValues::BAMBOO_LEAF_SIZE_LARGE_LEAVES,
					default => throw new BlockStateSerializeException("Invalid Bamboo leaf thickness " . $block->getLeafSize()),
				})
				->writeString(StateNames::BAMBOO_STALK_THICKNESS, $block->isThick() ? StringValues::BAMBOO_STALK_THICKNESS_THICK : StringValues::BAMBOO_STALK_THICKNESS_THIN);
		});
		$this->map(Blocks::BAMBOO_SAPLING(), function(BambooSapling $block) : Writer{
			return Writer::create(Ids::BAMBOO_SAPLING)
				->writeBool(StateNames::AGE_BIT, $block->isReady())

				//TODO: bug in MCPE
				->writeString(StateNames::SAPLING_TYPE, StringValues::SAPLING_TYPE_OAK);
		});
		$this->map(Blocks::BANNER(), function(FloorBanner $block) : Writer{
			return Writer::create(Ids::STANDING_BANNER)
				->writeInt(StateNames::GROUND_SIGN_DIRECTION, $block->getRotation());
		});
		$this->map(Blocks::BARREL(), function(Barrel $block) : Writer{
			return Writer::create(Ids::BARREL)
				->writeBool(StateNames::OPEN_BIT, $block->isOpen())
				->writeFacingDirection($block->getFacing());
		});
		$this->mapSimple(Blocks::BARRIER(), Ids::BARRIER);
		$this->map(Blocks::BASALT(), function(SimplePillar $block) : Writer{
			return Writer::create(Ids::BASALT)
				->writePillarAxis($block->getAxis());
		});
		$this->mapSimple(Blocks::BEACON(), Ids::BEACON);
		$this->map(Blocks::BED(), function(Bed $block) : Writer{
			return Writer::create(Ids::BED)
				->writeBool(StateNames::HEAD_PIECE_BIT, $block->isHeadPart())
				->writeBool(StateNames::OCCUPIED_BIT, $block->isOccupied())
				->writeLegacyHorizontalFacing($block->getFacing());
		});
		$this->map(Blocks::BEDROCK(), function(Block $block) : Writer{
			return Writer::create(Ids::BEDROCK)
				->writeBool(StateNames::INFINIBURN_BIT, $block->burnsForever());
		});
		$this->map(Blocks::BEETROOTS(), fn(Beetroot $block) => Helper::encodeCrops($block, new Writer(Ids::BEETROOT)));
		$this->map(Blocks::BELL(), function(Bell $block) : Writer{
			return Writer::create(Ids::BELL)
				->writeBellAttachmentType($block->getAttachmentType())
				->writeBool(StateNames::TOGGLE_BIT, false) //we don't care about this; it's just to keep MCPE happy
				->writeLegacyHorizontalFacing($block->getFacing());

		});
		$this->map(Blocks::BIRCH_BUTTON(), fn(WoodenButton $block) => Helper::encodeButton($block, new Writer(Ids::BIRCH_BUTTON)));
		$this->map(Blocks::BIRCH_DOOR(), fn(WoodenDoor $block) => Helper::encodeDoor($block, new Writer(Ids::BIRCH_DOOR)));
		$this->map(Blocks::BIRCH_FENCE(), fn() => Writer::create(Ids::FENCE)
				->writeString(StateNames::WOOD_TYPE, StringValues::WOOD_TYPE_BIRCH));
		$this->map(Blocks::BIRCH_FENCE_GATE(), fn(FenceGate $block) => Helper::encodeFenceGate($block, new Writer(Ids::BIRCH_FENCE_GATE)));
		$this->map(Blocks::BIRCH_LEAVES(), fn(Leaves $block) => Helper::encodeLeaves1($block, StringValues::OLD_LEAF_TYPE_BIRCH));
		$this->map(Blocks::BIRCH_LOG(), fn(Wood $block) => Helper::encodeLog1($block, StringValues::OLD_LOG_TYPE_BIRCH, Ids::STRIPPED_BIRCH_LOG));
		$this->map(Blocks::BIRCH_PLANKS(), fn() => Writer::create(Ids::PLANKS)
				->writeString(StateNames::WOOD_TYPE, StringValues::WOOD_TYPE_BIRCH));
		$this->map(Blocks::BIRCH_PRESSURE_PLATE(), fn(WoodenPressurePlate $block) => Helper::encodeSimplePressurePlate($block, new Writer(Ids::BIRCH_PRESSURE_PLATE)));
		$this->map(Blocks::BIRCH_SAPLING(), fn(Sapling $block) => Helper::encodeSapling($block, StringValues::SAPLING_TYPE_BIRCH));
		$this->map(Blocks::BIRCH_SIGN(), fn(FloorSign $block) => Helper::encodeFloorSign($block, new Writer(Ids::BIRCH_STANDING_SIGN)));
		$this->map(Blocks::BIRCH_SLAB(), fn(Slab $block) => Helper::encodeWoodenSlab($block, StringValues::WOOD_TYPE_BIRCH));
		$this->mapStairs(Blocks::BIRCH_STAIRS(), Ids::BIRCH_STAIRS);
		$this->map(Blocks::BIRCH_TRAPDOOR(), fn(WoodenTrapdoor $block) => Helper::encodeTrapdoor($block, new Writer(Ids::BIRCH_TRAPDOOR)));
		$this->map(Blocks::BIRCH_WALL_SIGN(), fn(WallSign $block) => Helper::encodeWallSign($block, new Writer(Ids::BIRCH_WALL_SIGN)));
		$this->map(Blocks::BIRCH_WOOD(), fn(Wood $block) => Helper::encodeAllSidedLog($block));
		$this->mapSimple(Blocks::BLACKSTONE(), Ids::BLACKSTONE);
		$this->mapSlab(Blocks::BLACKSTONE_SLAB(), Ids::BLACKSTONE_SLAB, Ids::BLACKSTONE_DOUBLE_SLAB);
		$this->mapStairs(Blocks::BLACKSTONE_STAIRS(), Ids::BLACKSTONE_STAIRS);
		$this->map(Blocks::BLACKSTONE_WALL(), fn(Wall $block) => Helper::encodeWall($block, new Writer(Ids::BLACKSTONE_WALL)));
		$this->map(Blocks::BLAST_FURNACE(), fn(Furnace $block) => Helper::encodeFurnace($block, Ids::BLAST_FURNACE, Ids::LIT_BLAST_FURNACE));
		$this->mapSimple(Blocks::BLUE_ICE(), Ids::BLUE_ICE);
		$this->map(Blocks::BLUE_ORCHID(), fn() => Helper::encodeRedFlower(StringValues::FLOWER_TYPE_ORCHID));
		$this->map(Blocks::BLUE_TORCH(), fn(Torch $block) => Helper::encodeColoredTorch($block, false, Writer::create(Ids::COLORED_TORCH_BP)));
		$this->map(Blocks::BONE_BLOCK(), function(BoneBlock $block) : Writer{
			return Writer::create(Ids::BONE_BLOCK)
				->writeInt(StateNames::DEPRECATED, 0)
				->writePillarAxis($block->getAxis());
		});
		$this->mapSimple(Blocks::BOOKSHELF(), Ids::BOOKSHELF);
		$this->map(Blocks::BREWING_STAND(), function(BrewingStand $block) : Writer{
			return Writer::create(Ids::BREWING_STAND)
				->writeBool(StateNames::BREWING_STAND_SLOT_A_BIT, $block->hasSlot(BrewingStandSlot::EAST()))
				->writeBool(StateNames::BREWING_STAND_SLOT_B_BIT, $block->hasSlot(BrewingStandSlot::SOUTHWEST()))
				->writeBool(StateNames::BREWING_STAND_SLOT_C_BIT, $block->hasSlot(BrewingStandSlot::NORTHWEST()));
		});
		$this->mapSimple(Blocks::BRICKS(), Ids::BRICK_BLOCK);
		$this->map(Blocks::BRICK_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab1($block, StringValues::STONE_SLAB_TYPE_BRICK));
		$this->mapStairs(Blocks::BRICK_STAIRS(), Ids::BRICK_STAIRS);
		$this->map(Blocks::BRICK_WALL(), fn(Wall $block) => Helper::encodeLegacyWall($block, StringValues::WALL_BLOCK_TYPE_BRICK));
		$this->mapSimple(Blocks::BROWN_MUSHROOM(), Ids::BROWN_MUSHROOM);
		$this->map(Blocks::BROWN_MUSHROOM_BLOCK(), fn(BrownMushroomBlock $block) => Helper::encodeMushroomBlock($block, new Writer(Ids::BROWN_MUSHROOM_BLOCK)));
		$this->map(Blocks::CACTUS(), function(Cactus $block) : Writer{
			return Writer::create(Ids::CACTUS)
				->writeInt(StateNames::AGE, $block->getAge());
		});
		$this->map(Blocks::CAKE(), function(Cake $block) : Writer{
			return Writer::create(Ids::CAKE)
				->writeInt(StateNames::BITE_COUNTER, $block->getBites());
		});
		$this->mapSimple(Blocks::CALCITE(), Ids::CALCITE);
		$this->map(Blocks::CARPET(), function(Carpet $block) : Writer{
			return Writer::create(Ids::CARPET)
				->writeColor($block->getColor());
		});
		$this->map(Blocks::CARROTS(), fn(Carrot $block) => Helper::encodeCrops($block, new Writer(Ids::CARROTS)));
		$this->map(Blocks::CARVED_PUMPKIN(), function(CarvedPumpkin $block) : Writer{
			return Writer::create(Ids::CARVED_PUMPKIN)
				->writeLegacyHorizontalFacing($block->getFacing());
		});
		$this->mapSimple(Blocks::CHEMICAL_HEAT(), Ids::CHEMICAL_HEAT);
		$this->map(Blocks::CHEST(), function(Chest $block) : Writer{
			return Writer::create(Ids::CHEST)
				->writeHorizontalFacing($block->getFacing());
		});
		$this->mapSimple(Blocks::CHISELED_DEEPSLATE(), Ids::CHISELED_DEEPSLATE);
		$this->mapSimple(Blocks::CHISELED_NETHER_BRICKS(), Ids::CHISELED_NETHER_BRICKS);
		$this->mapSimple(Blocks::CHISELED_POLISHED_BLACKSTONE(), Ids::CHISELED_POLISHED_BLACKSTONE);
		$this->map(Blocks::CHISELED_QUARTZ(), fn(SimplePillar $block) => Helper::encodeQuartz(StringValues::CHISEL_TYPE_CHISELED, $block->getAxis()));
		$this->map(Blocks::CHISELED_RED_SANDSTONE(), fn() => Helper::encodeSandstone(Ids::RED_SANDSTONE, StringValues::SAND_STONE_TYPE_HEIROGLYPHS));
		$this->map(Blocks::CHISELED_SANDSTONE(), fn() => Helper::encodeSandstone(Ids::SANDSTONE, StringValues::SAND_STONE_TYPE_HEIROGLYPHS));
		$this->map(Blocks::CHISELED_STONE_BRICKS(), fn() => Helper::encodeStoneBricks(StringValues::STONE_BRICK_TYPE_CHISELED));
		$this->mapSimple(Blocks::CLAY(), Ids::CLAY);
		$this->mapSimple(Blocks::COAL(), Ids::COAL_BLOCK);
		$this->mapSimple(Blocks::COAL_ORE(), Ids::COAL_ORE);
		$this->mapSimple(Blocks::COBBLED_DEEPSLATE(), Ids::COBBLED_DEEPSLATE);
		$this->mapSlab(Blocks::COBBLED_DEEPSLATE_SLAB(), Ids::COBBLED_DEEPSLATE_SLAB, Ids::COBBLED_DEEPSLATE_DOUBLE_SLAB);
		$this->mapStairs(Blocks::COBBLED_DEEPSLATE_STAIRS(), Ids::COBBLED_DEEPSLATE_STAIRS);
		$this->map(Blocks::COBBLED_DEEPSLATE_WALL(), fn(Wall $block) => Helper::encodeWall($block, new Writer(Ids::COBBLED_DEEPSLATE_WALL)));
		$this->mapSimple(Blocks::COBBLESTONE(), Ids::COBBLESTONE);
		$this->map(Blocks::COBBLESTONE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab1($block, StringValues::STONE_SLAB_TYPE_COBBLESTONE));
		$this->mapStairs(Blocks::COBBLESTONE_STAIRS(), Ids::STONE_STAIRS);
		$this->map(Blocks::COBBLESTONE_WALL(), fn(Wall $block) => Helper::encodeLegacyWall($block, StringValues::WALL_BLOCK_TYPE_COBBLESTONE));
		$this->mapSimple(Blocks::COBWEB(), Ids::WEB);
		$this->map(Blocks::COCOA_POD(), function(CocoaBlock $block) : Writer{
			return Writer::create(Ids::COCOA)
				->writeInt(StateNames::AGE, $block->getAge())
				->writeLegacyHorizontalFacing(Facing::opposite($block->getFacing()));
		});
		$this->map(Blocks::COMPOUND_CREATOR(), fn(ChemistryTable $block) => Helper::encodeChemistryTable($block, StringValues::CHEMISTRY_TABLE_TYPE_COMPOUND_CREATOR, new Writer(Ids::CHEMISTRY_TABLE)));
		$this->map(Blocks::CONCRETE(), function(Concrete $block) : Writer{
			return Writer::create(Ids::CONCRETE)
				->writeColor($block->getColor());
		});
		$this->map(Blocks::CONCRETE_POWDER(), function(ConcretePowder $block) : Writer{
			return Writer::create(Ids::CONCRETE_POWDER)
				->writeColor($block->getColor());
		});
		$this->mapSimple(Blocks::COPPER_ORE(), Ids::COPPER_ORE);
		$this->map(Blocks::CORAL(), function(Coral $block) : Writer{
			return Writer::create(Ids::CORAL)
				->writeBool(StateNames::DEAD_BIT, $block->isDead())
				->writeCoralType($block->getCoralType());
		});
		$this->map(Blocks::CORAL_BLOCK(), function(CoralBlock $block) : Writer{
			return Writer::create(Ids::CORAL_BLOCK)
				->writeBool(StateNames::DEAD_BIT, $block->isDead())
				->writeCoralType($block->getCoralType());
		});
		$this->map(Blocks::CORAL_FAN(), function(FloorCoralFan $block) : Writer{
			return Writer::create($block->isDead() ? Ids::CORAL_FAN_DEAD : Ids::CORAL_FAN)
				->writeCoralType($block->getCoralType())
				->writeInt(StateNames::CORAL_FAN_DIRECTION, match($axis = $block->getAxis()){
					Axis::X => 0,
					Axis::Z => 1,
					default => throw new BlockStateSerializeException("Invalid axis {$axis}"),
				});
		});
		$this->map(Blocks::CORNFLOWER(), fn() => Helper::encodeRedFlower(StringValues::FLOWER_TYPE_CORNFLOWER));
		$this->mapSimple(Blocks::CRACKED_DEEPSLATE_BRICKS(), Ids::CRACKED_DEEPSLATE_BRICKS);
		$this->mapSimple(Blocks::CRACKED_DEEPSLATE_TILES(), Ids::CRACKED_DEEPSLATE_TILES);
		$this->mapSimple(Blocks::CRACKED_NETHER_BRICKS(), Ids::CRACKED_NETHER_BRICKS);
		$this->mapSimple(Blocks::CRACKED_POLISHED_BLACKSTONE_BRICKS(), Ids::CRACKED_POLISHED_BLACKSTONE_BRICKS);
		$this->map(Blocks::CRACKED_STONE_BRICKS(), fn() => Helper::encodeStoneBricks(StringValues::STONE_BRICK_TYPE_CRACKED));
		$this->mapSimple(Blocks::CRAFTING_TABLE(), Ids::CRAFTING_TABLE);
		$this->map(Blocks::CRIMSON_BUTTON(), fn(Button $block) => Helper::encodeButton($block, new Writer(Ids::CRIMSON_BUTTON)));
		$this->map(Blocks::CRIMSON_DOOR(), fn(Door $block) => Helper::encodeDoor($block, new Writer(Ids::CRIMSON_DOOR)));
		$this->mapSimple(Blocks::CRIMSON_FENCE(), Ids::CRIMSON_FENCE);
		$this->map(Blocks::CRIMSON_FENCE_GATE(), fn(FenceGate $block) => Helper::encodeFenceGate($block, new Writer(Ids::CRIMSON_FENCE_GATE)));
		$this->map(Blocks::CRIMSON_HYPHAE(), fn(Wood $block) => Helper::encodeNewLog($block, Ids::CRIMSON_HYPHAE, Ids::STRIPPED_CRIMSON_HYPHAE));
		$this->mapSimple(Blocks::CRIMSON_PLANKS(), Ids::CRIMSON_PLANKS);
		$this->map(Blocks::CRIMSON_PRESSURE_PLATE(), fn(SimplePressurePlate $block) => Helper::encodeSimplePressurePlate($block, new Writer(Ids::CRIMSON_PRESSURE_PLATE)));
		$this->map(Blocks::CRIMSON_SIGN(), fn(FloorSign $block) => Helper::encodeFloorSign($block, new Writer(Ids::CRIMSON_STANDING_SIGN)));
		$this->mapSlab(Blocks::CRIMSON_SLAB(), Ids::CRIMSON_SLAB, Ids::CRIMSON_DOUBLE_SLAB);
		$this->mapStairs(Blocks::CRIMSON_STAIRS(), Ids::CRIMSON_STAIRS);
		$this->map(Blocks::CRIMSON_STEM(), fn(Wood $block) => Helper::encodeNewLog($block, Ids::CRIMSON_STEM, Ids::STRIPPED_CRIMSON_STEM));
		$this->map(Blocks::CRIMSON_TRAPDOOR(), fn(Trapdoor $block) => Helper::encodeTrapdoor($block, new Writer(Ids::CRIMSON_TRAPDOOR)));
		$this->map(Blocks::CRIMSON_WALL_SIGN(), fn(WallSign $block) => Helper::encodeWallSign($block, new Writer(Ids::CRIMSON_WALL_SIGN)));
		$this->map(Blocks::CUT_RED_SANDSTONE(), fn() => Helper::encodeSandstone(Ids::RED_SANDSTONE, StringValues::SAND_STONE_TYPE_CUT));
		$this->map(Blocks::CUT_RED_SANDSTONE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab4($block, StringValues::STONE_SLAB_TYPE_4_CUT_RED_SANDSTONE));
		$this->map(Blocks::CUT_SANDSTONE(), fn() => Helper::encodeSandstone(Ids::SANDSTONE, StringValues::SAND_STONE_TYPE_CUT));
		$this->map(Blocks::CUT_SANDSTONE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab4($block, StringValues::STONE_SLAB_TYPE_4_CUT_SANDSTONE));
		$this->mapSimple(Blocks::DANDELION(), Ids::YELLOW_FLOWER);
		$this->map(Blocks::DARK_OAK_BUTTON(), fn(WoodenButton $block) => Helper::encodeButton($block, new Writer(Ids::DARK_OAK_BUTTON)));
		$this->map(Blocks::DARK_OAK_DOOR(), fn(WoodenDoor $block) => Helper::encodeDoor($block, new Writer(Ids::DARK_OAK_DOOR)));
		$this->map(Blocks::DARK_OAK_FENCE(), fn() => Writer::create(Ids::FENCE)
				->writeString(StateNames::WOOD_TYPE, StringValues::WOOD_TYPE_DARK_OAK));
		$this->map(Blocks::DARK_OAK_FENCE_GATE(), fn(FenceGate $block) => Helper::encodeFenceGate($block, new Writer(Ids::DARK_OAK_FENCE_GATE)));
		$this->map(Blocks::DARK_OAK_LEAVES(), fn(Leaves $block) => Helper::encodeLeaves2($block, StringValues::NEW_LEAF_TYPE_DARK_OAK));
		$this->map(Blocks::DARK_OAK_LOG(), fn(Wood $block) => Helper::encodeLog2($block, StringValues::NEW_LOG_TYPE_DARK_OAK, Ids::STRIPPED_DARK_OAK_LOG));
		$this->map(Blocks::DARK_OAK_PLANKS(), fn() => Writer::create(Ids::PLANKS)
				->writeString(StateNames::WOOD_TYPE, StringValues::WOOD_TYPE_DARK_OAK));
		$this->map(Blocks::DARK_OAK_PRESSURE_PLATE(), fn(WoodenPressurePlate $block) => Helper::encodeSimplePressurePlate($block, new Writer(Ids::DARK_OAK_PRESSURE_PLATE)));
		$this->map(Blocks::DARK_OAK_SAPLING(), fn(Sapling $block) => Helper::encodeSapling($block, StringValues::SAPLING_TYPE_DARK_OAK));
		$this->map(Blocks::DARK_OAK_SIGN(), fn(FloorSign $block) => Helper::encodeFloorSign($block, new Writer(Ids::DARKOAK_STANDING_SIGN)));
		$this->map(Blocks::DARK_OAK_SLAB(), fn(Slab $block) => Helper::encodeWoodenSlab($block, StringValues::WOOD_TYPE_DARK_OAK));
		$this->mapStairs(Blocks::DARK_OAK_STAIRS(), Ids::DARK_OAK_STAIRS);
		$this->map(Blocks::DARK_OAK_TRAPDOOR(), fn(WoodenTrapdoor $block) => Helper::encodeTrapdoor($block, new Writer(Ids::DARK_OAK_TRAPDOOR)));
		$this->map(Blocks::DARK_OAK_WALL_SIGN(), fn(WallSign $block) => Helper::encodeWallSign($block, new Writer(Ids::DARKOAK_WALL_SIGN)));
		$this->map(Blocks::DARK_OAK_WOOD(), fn(Wood $block) => Helper::encodeAllSidedLog($block));
		$this->map(Blocks::DARK_PRISMARINE(), fn() => Writer::create(Ids::PRISMARINE)
				->writeString(StateNames::PRISMARINE_BLOCK_TYPE, StringValues::PRISMARINE_BLOCK_TYPE_DARK));
		$this->map(Blocks::DARK_PRISMARINE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab2($block, StringValues::STONE_SLAB_TYPE_2_PRISMARINE_DARK));
		$this->mapStairs(Blocks::DARK_PRISMARINE_STAIRS(), Ids::DARK_PRISMARINE_STAIRS);
		$this->map(Blocks::DAYLIGHT_SENSOR(), function(DaylightSensor $block) : Writer{
			return Writer::create($block->isInverted() ? Ids::DAYLIGHT_DETECTOR_INVERTED : Ids::DAYLIGHT_DETECTOR)
				->writeInt(StateNames::REDSTONE_SIGNAL, $block->getOutputSignalStrength());
		});
		$this->mapSimple(Blocks::DEAD_BUSH(), Ids::DEADBUSH);
		$this->map(Blocks::DEEPSLATE(), function(SimplePillar $block) : Writer{
			return Writer::create(Ids::DEEPSLATE)
				->writePillarAxis($block->getAxis());
		});
		$this->mapSimple(Blocks::DEEPSLATE_BRICKS(), Ids::DEEPSLATE_BRICKS);
		$this->mapSlab(Blocks::DEEPSLATE_BRICK_SLAB(), Ids::DEEPSLATE_BRICK_SLAB, Ids::DEEPSLATE_BRICK_DOUBLE_SLAB);
		$this->mapStairs(Blocks::DEEPSLATE_BRICK_STAIRS(), Ids::DEEPSLATE_BRICK_STAIRS);
		$this->map(Blocks::DEEPSLATE_BRICK_WALL(), fn(Wall $block) => Helper::encodeWall($block, new Writer(Ids::DEEPSLATE_BRICK_WALL)));
		$this->mapSimple(Blocks::DEEPSLATE_COAL_ORE(), Ids::DEEPSLATE_COAL_ORE);
		$this->mapSimple(Blocks::DEEPSLATE_COPPER_ORE(), Ids::DEEPSLATE_COPPER_ORE);
		$this->mapSimple(Blocks::DEEPSLATE_DIAMOND_ORE(), Ids::DEEPSLATE_DIAMOND_ORE);
		$this->mapSimple(Blocks::DEEPSLATE_EMERALD_ORE(), Ids::DEEPSLATE_EMERALD_ORE);
		$this->mapSimple(Blocks::DEEPSLATE_GOLD_ORE(), Ids::DEEPSLATE_GOLD_ORE);
		$this->mapSimple(Blocks::DEEPSLATE_IRON_ORE(), Ids::DEEPSLATE_IRON_ORE);
		$this->mapSimple(Blocks::DEEPSLATE_LAPIS_LAZULI_ORE(), Ids::DEEPSLATE_LAPIS_ORE);
		$this->map(Blocks::DEEPSLATE_REDSTONE_ORE(), fn(RedstoneOre $block) => new Writer($block->isLit() ? Ids::LIT_DEEPSLATE_REDSTONE_ORE : Ids::DEEPSLATE_REDSTONE_ORE));
		$this->mapSimple(Blocks::DEEPSLATE_TILES(), Ids::DEEPSLATE_TILES);
		$this->mapSlab(Blocks::DEEPSLATE_TILE_SLAB(), Ids::DEEPSLATE_TILE_SLAB, Ids::DEEPSLATE_TILE_DOUBLE_SLAB);
		$this->mapStairs(Blocks::DEEPSLATE_TILE_STAIRS(), Ids::DEEPSLATE_TILE_STAIRS);
		$this->map(Blocks::DEEPSLATE_TILE_WALL(), fn(Wall $block) => Helper::encodeWall($block, new Writer(Ids::DEEPSLATE_TILE_WALL)));
		$this->map(Blocks::DETECTOR_RAIL(), function(DetectorRail $block) : Writer{
			return Writer::create(Ids::DETECTOR_RAIL)
				->writeBool(StateNames::RAIL_DATA_BIT, $block->isActivated())
				->writeInt(StateNames::RAIL_DIRECTION, $block->getShape());
		});
		$this->mapSimple(Blocks::DIAMOND(), Ids::DIAMOND_BLOCK);
		$this->mapSimple(Blocks::DIAMOND_ORE(), Ids::DIAMOND_ORE);
		$this->map(Blocks::DIORITE(), fn() => Helper::encodeStone(StringValues::STONE_TYPE_DIORITE));
		$this->map(Blocks::DIORITE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab3($block, StringValues::STONE_SLAB_TYPE_3_DIORITE));
		$this->mapStairs(Blocks::DIORITE_STAIRS(), Ids::DIORITE_STAIRS);
		$this->map(Blocks::DIORITE_WALL(), fn(Wall $block) => Helper::encodeLegacyWall($block, StringValues::WALL_BLOCK_TYPE_DIORITE));
		$this->map(Blocks::DIRT(), function(Dirt $block) : Writer{
			return Writer::create(Ids::DIRT)
				->writeString(StateNames::DIRT_TYPE, $block->isCoarse() ? StringValues::DIRT_TYPE_COARSE : StringValues::DIRT_TYPE_NORMAL);
		});
		$this->map(Blocks::DOUBLE_TALLGRASS(), fn(DoubleTallGrass $block) => Helper::encodeDoublePlant($block, StringValues::DOUBLE_PLANT_TYPE_GRASS, Writer::create(Ids::DOUBLE_PLANT)));
		$this->mapSimple(Blocks::DRAGON_EGG(), Ids::DRAGON_EGG);
		$this->mapSimple(Blocks::DRIED_KELP(), Ids::DRIED_KELP_BLOCK);
		$this->map(Blocks::DYED_SHULKER_BOX(), function(DyedShulkerBox $block) : Writer{
			return Writer::create(Ids::SHULKER_BOX)
				->writeColor($block->getColor());
		});
		$this->mapSimple(Blocks::ELEMENT_ACTINIUM(), Ids::ELEMENT_89);
		$this->mapSimple(Blocks::ELEMENT_ALUMINUM(), Ids::ELEMENT_13);
		$this->mapSimple(Blocks::ELEMENT_AMERICIUM(), Ids::ELEMENT_95);
		$this->mapSimple(Blocks::ELEMENT_ANTIMONY(), Ids::ELEMENT_51);
		$this->mapSimple(Blocks::ELEMENT_ARGON(), Ids::ELEMENT_18);
		$this->mapSimple(Blocks::ELEMENT_ARSENIC(), Ids::ELEMENT_33);
		$this->mapSimple(Blocks::ELEMENT_ASTATINE(), Ids::ELEMENT_85);
		$this->mapSimple(Blocks::ELEMENT_BARIUM(), Ids::ELEMENT_56);
		$this->mapSimple(Blocks::ELEMENT_BERKELIUM(), Ids::ELEMENT_97);
		$this->mapSimple(Blocks::ELEMENT_BERYLLIUM(), Ids::ELEMENT_4);
		$this->mapSimple(Blocks::ELEMENT_BISMUTH(), Ids::ELEMENT_83);
		$this->mapSimple(Blocks::ELEMENT_BOHRIUM(), Ids::ELEMENT_107);
		$this->mapSimple(Blocks::ELEMENT_BORON(), Ids::ELEMENT_5);
		$this->mapSimple(Blocks::ELEMENT_BROMINE(), Ids::ELEMENT_35);
		$this->mapSimple(Blocks::ELEMENT_CADMIUM(), Ids::ELEMENT_48);
		$this->mapSimple(Blocks::ELEMENT_CALCIUM(), Ids::ELEMENT_20);
		$this->mapSimple(Blocks::ELEMENT_CALIFORNIUM(), Ids::ELEMENT_98);
		$this->mapSimple(Blocks::ELEMENT_CARBON(), Ids::ELEMENT_6);
		$this->mapSimple(Blocks::ELEMENT_CERIUM(), Ids::ELEMENT_58);
		$this->mapSimple(Blocks::ELEMENT_CESIUM(), Ids::ELEMENT_55);
		$this->mapSimple(Blocks::ELEMENT_CHLORINE(), Ids::ELEMENT_17);
		$this->mapSimple(Blocks::ELEMENT_CHROMIUM(), Ids::ELEMENT_24);
		$this->mapSimple(Blocks::ELEMENT_COBALT(), Ids::ELEMENT_27);
		$this->map(Blocks::ELEMENT_CONSTRUCTOR(), fn(ChemistryTable $block) => Helper::encodeChemistryTable($block, StringValues::CHEMISTRY_TABLE_TYPE_ELEMENT_CONSTRUCTOR, new Writer(Ids::CHEMISTRY_TABLE)));
		$this->mapSimple(Blocks::ELEMENT_COPERNICIUM(), Ids::ELEMENT_112);
		$this->mapSimple(Blocks::ELEMENT_COPPER(), Ids::ELEMENT_29);
		$this->mapSimple(Blocks::ELEMENT_CURIUM(), Ids::ELEMENT_96);
		$this->mapSimple(Blocks::ELEMENT_DARMSTADTIUM(), Ids::ELEMENT_110);
		$this->mapSimple(Blocks::ELEMENT_DUBNIUM(), Ids::ELEMENT_105);
		$this->mapSimple(Blocks::ELEMENT_DYSPROSIUM(), Ids::ELEMENT_66);
		$this->mapSimple(Blocks::ELEMENT_EINSTEINIUM(), Ids::ELEMENT_99);
		$this->mapSimple(Blocks::ELEMENT_ERBIUM(), Ids::ELEMENT_68);
		$this->mapSimple(Blocks::ELEMENT_EUROPIUM(), Ids::ELEMENT_63);
		$this->mapSimple(Blocks::ELEMENT_FERMIUM(), Ids::ELEMENT_100);
		$this->mapSimple(Blocks::ELEMENT_FLEROVIUM(), Ids::ELEMENT_114);
		$this->mapSimple(Blocks::ELEMENT_FLUORINE(), Ids::ELEMENT_9);
		$this->mapSimple(Blocks::ELEMENT_FRANCIUM(), Ids::ELEMENT_87);
		$this->mapSimple(Blocks::ELEMENT_GADOLINIUM(), Ids::ELEMENT_64);
		$this->mapSimple(Blocks::ELEMENT_GALLIUM(), Ids::ELEMENT_31);
		$this->mapSimple(Blocks::ELEMENT_GERMANIUM(), Ids::ELEMENT_32);
		$this->mapSimple(Blocks::ELEMENT_GOLD(), Ids::ELEMENT_79);
		$this->mapSimple(Blocks::ELEMENT_HAFNIUM(), Ids::ELEMENT_72);
		$this->mapSimple(Blocks::ELEMENT_HASSIUM(), Ids::ELEMENT_108);
		$this->mapSimple(Blocks::ELEMENT_HELIUM(), Ids::ELEMENT_2);
		$this->mapSimple(Blocks::ELEMENT_HOLMIUM(), Ids::ELEMENT_67);
		$this->mapSimple(Blocks::ELEMENT_HYDROGEN(), Ids::ELEMENT_1);
		$this->mapSimple(Blocks::ELEMENT_INDIUM(), Ids::ELEMENT_49);
		$this->mapSimple(Blocks::ELEMENT_IODINE(), Ids::ELEMENT_53);
		$this->mapSimple(Blocks::ELEMENT_IRIDIUM(), Ids::ELEMENT_77);
		$this->mapSimple(Blocks::ELEMENT_IRON(), Ids::ELEMENT_26);
		$this->mapSimple(Blocks::ELEMENT_KRYPTON(), Ids::ELEMENT_36);
		$this->mapSimple(Blocks::ELEMENT_LANTHANUM(), Ids::ELEMENT_57);
		$this->mapSimple(Blocks::ELEMENT_LAWRENCIUM(), Ids::ELEMENT_103);
		$this->mapSimple(Blocks::ELEMENT_LEAD(), Ids::ELEMENT_82);
		$this->mapSimple(Blocks::ELEMENT_LITHIUM(), Ids::ELEMENT_3);
		$this->mapSimple(Blocks::ELEMENT_LIVERMORIUM(), Ids::ELEMENT_116);
		$this->mapSimple(Blocks::ELEMENT_LUTETIUM(), Ids::ELEMENT_71);
		$this->mapSimple(Blocks::ELEMENT_MAGNESIUM(), Ids::ELEMENT_12);
		$this->mapSimple(Blocks::ELEMENT_MANGANESE(), Ids::ELEMENT_25);
		$this->mapSimple(Blocks::ELEMENT_MEITNERIUM(), Ids::ELEMENT_109);
		$this->mapSimple(Blocks::ELEMENT_MENDELEVIUM(), Ids::ELEMENT_101);
		$this->mapSimple(Blocks::ELEMENT_MERCURY(), Ids::ELEMENT_80);
		$this->mapSimple(Blocks::ELEMENT_MOLYBDENUM(), Ids::ELEMENT_42);
		$this->mapSimple(Blocks::ELEMENT_MOSCOVIUM(), Ids::ELEMENT_115);
		$this->mapSimple(Blocks::ELEMENT_NEODYMIUM(), Ids::ELEMENT_60);
		$this->mapSimple(Blocks::ELEMENT_NEON(), Ids::ELEMENT_10);
		$this->mapSimple(Blocks::ELEMENT_NEPTUNIUM(), Ids::ELEMENT_93);
		$this->mapSimple(Blocks::ELEMENT_NICKEL(), Ids::ELEMENT_28);
		$this->mapSimple(Blocks::ELEMENT_NIHONIUM(), Ids::ELEMENT_113);
		$this->mapSimple(Blocks::ELEMENT_NIOBIUM(), Ids::ELEMENT_41);
		$this->mapSimple(Blocks::ELEMENT_NITROGEN(), Ids::ELEMENT_7);
		$this->mapSimple(Blocks::ELEMENT_NOBELIUM(), Ids::ELEMENT_102);
		$this->mapSimple(Blocks::ELEMENT_OGANESSON(), Ids::ELEMENT_118);
		$this->mapSimple(Blocks::ELEMENT_OSMIUM(), Ids::ELEMENT_76);
		$this->mapSimple(Blocks::ELEMENT_OXYGEN(), Ids::ELEMENT_8);
		$this->mapSimple(Blocks::ELEMENT_PALLADIUM(), Ids::ELEMENT_46);
		$this->mapSimple(Blocks::ELEMENT_PHOSPHORUS(), Ids::ELEMENT_15);
		$this->mapSimple(Blocks::ELEMENT_PLATINUM(), Ids::ELEMENT_78);
		$this->mapSimple(Blocks::ELEMENT_PLUTONIUM(), Ids::ELEMENT_94);
		$this->mapSimple(Blocks::ELEMENT_POLONIUM(), Ids::ELEMENT_84);
		$this->mapSimple(Blocks::ELEMENT_POTASSIUM(), Ids::ELEMENT_19);
		$this->mapSimple(Blocks::ELEMENT_PRASEODYMIUM(), Ids::ELEMENT_59);
		$this->mapSimple(Blocks::ELEMENT_PROMETHIUM(), Ids::ELEMENT_61);
		$this->mapSimple(Blocks::ELEMENT_PROTACTINIUM(), Ids::ELEMENT_91);
		$this->mapSimple(Blocks::ELEMENT_RADIUM(), Ids::ELEMENT_88);
		$this->mapSimple(Blocks::ELEMENT_RADON(), Ids::ELEMENT_86);
		$this->mapSimple(Blocks::ELEMENT_RHENIUM(), Ids::ELEMENT_75);
		$this->mapSimple(Blocks::ELEMENT_RHODIUM(), Ids::ELEMENT_45);
		$this->mapSimple(Blocks::ELEMENT_ROENTGENIUM(), Ids::ELEMENT_111);
		$this->mapSimple(Blocks::ELEMENT_RUBIDIUM(), Ids::ELEMENT_37);
		$this->mapSimple(Blocks::ELEMENT_RUTHENIUM(), Ids::ELEMENT_44);
		$this->mapSimple(Blocks::ELEMENT_RUTHERFORDIUM(), Ids::ELEMENT_104);
		$this->mapSimple(Blocks::ELEMENT_SAMARIUM(), Ids::ELEMENT_62);
		$this->mapSimple(Blocks::ELEMENT_SCANDIUM(), Ids::ELEMENT_21);
		$this->mapSimple(Blocks::ELEMENT_SEABORGIUM(), Ids::ELEMENT_106);
		$this->mapSimple(Blocks::ELEMENT_SELENIUM(), Ids::ELEMENT_34);
		$this->mapSimple(Blocks::ELEMENT_SILICON(), Ids::ELEMENT_14);
		$this->mapSimple(Blocks::ELEMENT_SILVER(), Ids::ELEMENT_47);
		$this->mapSimple(Blocks::ELEMENT_SODIUM(), Ids::ELEMENT_11);
		$this->mapSimple(Blocks::ELEMENT_STRONTIUM(), Ids::ELEMENT_38);
		$this->mapSimple(Blocks::ELEMENT_SULFUR(), Ids::ELEMENT_16);
		$this->mapSimple(Blocks::ELEMENT_TANTALUM(), Ids::ELEMENT_73);
		$this->mapSimple(Blocks::ELEMENT_TECHNETIUM(), Ids::ELEMENT_43);
		$this->mapSimple(Blocks::ELEMENT_TELLURIUM(), Ids::ELEMENT_52);
		$this->mapSimple(Blocks::ELEMENT_TENNESSINE(), Ids::ELEMENT_117);
		$this->mapSimple(Blocks::ELEMENT_TERBIUM(), Ids::ELEMENT_65);
		$this->mapSimple(Blocks::ELEMENT_THALLIUM(), Ids::ELEMENT_81);
		$this->mapSimple(Blocks::ELEMENT_THORIUM(), Ids::ELEMENT_90);
		$this->mapSimple(Blocks::ELEMENT_THULIUM(), Ids::ELEMENT_69);
		$this->mapSimple(Blocks::ELEMENT_TIN(), Ids::ELEMENT_50);
		$this->mapSimple(Blocks::ELEMENT_TITANIUM(), Ids::ELEMENT_22);
		$this->mapSimple(Blocks::ELEMENT_TUNGSTEN(), Ids::ELEMENT_74);
		$this->mapSimple(Blocks::ELEMENT_URANIUM(), Ids::ELEMENT_92);
		$this->mapSimple(Blocks::ELEMENT_VANADIUM(), Ids::ELEMENT_23);
		$this->mapSimple(Blocks::ELEMENT_XENON(), Ids::ELEMENT_54);
		$this->mapSimple(Blocks::ELEMENT_YTTERBIUM(), Ids::ELEMENT_70);
		$this->mapSimple(Blocks::ELEMENT_YTTRIUM(), Ids::ELEMENT_39);
		$this->mapSimple(Blocks::ELEMENT_ZERO(), Ids::ELEMENT_0);
		$this->mapSimple(Blocks::ELEMENT_ZINC(), Ids::ELEMENT_30);
		$this->mapSimple(Blocks::ELEMENT_ZIRCONIUM(), Ids::ELEMENT_40);
		$this->mapSimple(Blocks::EMERALD(), Ids::EMERALD_BLOCK);
		$this->mapSimple(Blocks::EMERALD_ORE(), Ids::EMERALD_ORE);
		$this->mapSimple(Blocks::ENCHANTING_TABLE(), Ids::ENCHANTING_TABLE);
		$this->map(Blocks::ENDER_CHEST(), function(EnderChest $block) : Writer{
			return Writer::create(Ids::ENDER_CHEST)
				->writeHorizontalFacing($block->getFacing());
		});
		$this->map(Blocks::END_PORTAL_FRAME(), function(EndPortalFrame $block) : Writer{
			return Writer::create(Ids::END_PORTAL_FRAME)
				->writeBool(StateNames::END_PORTAL_EYE_BIT, $block->hasEye())
				->writeLegacyHorizontalFacing($block->getFacing());
		});
		$this->map(Blocks::END_ROD(), function(EndRod $block) : Writer{
			return Writer::create(Ids::END_ROD)
				->writeEndRodFacingDirection($block->getFacing());
		});
		$this->mapSimple(Blocks::END_STONE(), Ids::END_STONE);
		$this->mapSimple(Blocks::END_STONE_BRICKS(), Ids::END_BRICKS);
		$this->map(Blocks::END_STONE_BRICK_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab3($block, StringValues::STONE_SLAB_TYPE_3_END_STONE_BRICK));
		$this->mapStairs(Blocks::END_STONE_BRICK_STAIRS(), Ids::END_BRICK_STAIRS);
		$this->map(Blocks::END_STONE_BRICK_WALL(), fn(Wall $block) => Helper::encodeLegacyWall($block, StringValues::WALL_BLOCK_TYPE_END_BRICK));
		$this->map(Blocks::FAKE_WOODEN_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab1($block, StringValues::STONE_SLAB_TYPE_WOOD));
		$this->map(Blocks::FARMLAND(), function(Farmland $block) : Writer{
			return Writer::create(Ids::FARMLAND)
				->writeInt(StateNames::MOISTURIZED_AMOUNT, $block->getWetness());
		});
		$this->map(Blocks::FERN(), fn() => Writer::create(Ids::TALLGRASS)
				->writeString(StateNames::TALL_GRASS_TYPE, StringValues::TALL_GRASS_TYPE_FERN));
		$this->map(Blocks::FIRE(), function(Fire $block) : Writer{
			return Writer::create(Ids::FIRE)
				->writeInt(StateNames::AGE, $block->getAge());
		});
		$this->mapSimple(Blocks::FLETCHING_TABLE(), Ids::FLETCHING_TABLE);
		$this->map(Blocks::FLOWER_POT(), function() : Writer{
			return Writer::create(Ids::FLOWER_POT)
				->writeBool(StateNames::UPDATE_BIT, true); //to keep MCPE happy
		});
		$this->map(Blocks::FROSTED_ICE(), function(FrostedIce $block) : Writer{
			return Writer::create(Ids::FROSTED_ICE)
				->writeInt(StateNames::AGE, $block->getAge());
		});
		$this->map(Blocks::FURNACE(), fn(Furnace $block) => Helper::encodeFurnace($block, Ids::FURNACE, Ids::LIT_FURNACE));
		$this->mapSimple(Blocks::GLASS(), Ids::GLASS);
		$this->mapSimple(Blocks::GLASS_PANE(), Ids::GLASS_PANE);
		$this->map(Blocks::GLAZED_TERRACOTTA(), function(GlazedTerracotta $block) : Writer{
			return Writer::create(match ($color = $block->getColor()) {
				DyeColor::BLACK() => Ids::BLACK_GLAZED_TERRACOTTA,
				DyeColor::BLUE() => Ids::BLUE_GLAZED_TERRACOTTA,
				DyeColor::BROWN() => Ids::BROWN_GLAZED_TERRACOTTA,
				DyeColor::CYAN() => Ids::CYAN_GLAZED_TERRACOTTA,
				DyeColor::GRAY() => Ids::GRAY_GLAZED_TERRACOTTA,
				DyeColor::GREEN() => Ids::GREEN_GLAZED_TERRACOTTA,
				DyeColor::LIGHT_BLUE() => Ids::LIGHT_BLUE_GLAZED_TERRACOTTA,
				DyeColor::LIGHT_GRAY() => Ids::SILVER_GLAZED_TERRACOTTA,
				DyeColor::LIME() => Ids::LIME_GLAZED_TERRACOTTA,
				DyeColor::MAGENTA() => Ids::MAGENTA_GLAZED_TERRACOTTA,
				DyeColor::ORANGE() => Ids::ORANGE_GLAZED_TERRACOTTA,
				DyeColor::PINK() => Ids::PINK_GLAZED_TERRACOTTA,
				DyeColor::PURPLE() => Ids::PURPLE_GLAZED_TERRACOTTA,
				DyeColor::RED() => Ids::RED_GLAZED_TERRACOTTA,
				DyeColor::WHITE() => Ids::WHITE_GLAZED_TERRACOTTA,
				DyeColor::YELLOW() => Ids::YELLOW_GLAZED_TERRACOTTA,
				default => throw new AssumptionFailedError("Unhandled dye colour " . $color->name())
			})
				->writeHorizontalFacing($block->getFacing());
		});
		$this->mapSimple(Blocks::GLOWING_OBSIDIAN(), Ids::GLOWINGOBSIDIAN);
		$this->mapSimple(Blocks::GLOWSTONE(), Ids::GLOWSTONE);
		$this->mapSimple(Blocks::GOLD(), Ids::GOLD_BLOCK);
		$this->mapSimple(Blocks::GOLD_ORE(), Ids::GOLD_ORE);
		$this->map(Blocks::GRANITE(), fn() => Helper::encodeStone(StringValues::STONE_TYPE_GRANITE));
		$this->map(Blocks::GRANITE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab3($block, StringValues::STONE_SLAB_TYPE_3_GRANITE));
		$this->mapStairs(Blocks::GRANITE_STAIRS(), Ids::GRANITE_STAIRS);
		$this->map(Blocks::GRANITE_WALL(), fn(Wall $block) => Helper::encodeLegacyWall($block, StringValues::WALL_BLOCK_TYPE_GRANITE));
		$this->mapSimple(Blocks::GRASS(), Ids::GRASS);
		$this->mapSimple(Blocks::GRASS_PATH(), Ids::GRASS_PATH);
		$this->mapSimple(Blocks::GRAVEL(), Ids::GRAVEL);
		$this->map(Blocks::GREEN_TORCH(), fn(Torch $block) => Helper::encodeColoredTorch($block, true, Writer::create(Ids::COLORED_TORCH_RG)));
		$this->mapSimple(Blocks::HARDENED_CLAY(), Ids::HARDENED_CLAY);
		$this->mapSimple(Blocks::HARDENED_GLASS(), Ids::HARD_GLASS);
		$this->mapSimple(Blocks::HARDENED_GLASS_PANE(), Ids::HARD_GLASS_PANE);
		$this->map(Blocks::HAY_BALE(), function(HayBale $block) : Writer{
			return Writer::create(Ids::HAY_BLOCK)
				->writeInt(StateNames::DEPRECATED, 0)
				->writePillarAxis($block->getAxis());
		});
		$this->mapSimple(Blocks::HONEYCOMB(), Ids::HONEYCOMB_BLOCK);
		$this->map(Blocks::HOPPER(), function(Hopper $block) : Writer{
			return Writer::create(Ids::HOPPER)
				->writeBool(StateNames::TOGGLE_BIT, $block->isPowered())
				->writeFacingWithoutUp($block->getFacing());
		});
		$this->mapSimple(Blocks::ICE(), Ids::ICE);
		$this->map(Blocks::INFESTED_CHISELED_STONE_BRICK(), fn() => Writer::create(Ids::MONSTER_EGG)
				->writeString(StateNames::MONSTER_EGG_STONE_TYPE, StringValues::MONSTER_EGG_STONE_TYPE_CHISELED_STONE_BRICK));
		$this->map(Blocks::INFESTED_COBBLESTONE(), fn() => Writer::create(Ids::MONSTER_EGG)
				->writeString(StateNames::MONSTER_EGG_STONE_TYPE, StringValues::MONSTER_EGG_STONE_TYPE_COBBLESTONE));
		$this->map(Blocks::INFESTED_CRACKED_STONE_BRICK(), fn() => Writer::create(Ids::MONSTER_EGG)
				->writeString(StateNames::MONSTER_EGG_STONE_TYPE, StringValues::MONSTER_EGG_STONE_TYPE_CRACKED_STONE_BRICK));
		$this->map(Blocks::INFESTED_MOSSY_STONE_BRICK(), fn() => Writer::create(Ids::MONSTER_EGG)
				->writeString(StateNames::MONSTER_EGG_STONE_TYPE, StringValues::MONSTER_EGG_STONE_TYPE_MOSSY_STONE_BRICK));
		$this->map(Blocks::INFESTED_STONE(), fn() => Writer::create(Ids::MONSTER_EGG)
				->writeString(StateNames::MONSTER_EGG_STONE_TYPE, StringValues::MONSTER_EGG_STONE_TYPE_STONE));
		$this->map(Blocks::INFESTED_STONE_BRICK(), fn() => Writer::create(Ids::MONSTER_EGG)
				->writeString(StateNames::MONSTER_EGG_STONE_TYPE, StringValues::MONSTER_EGG_STONE_TYPE_STONE_BRICK));
		$this->mapSimple(Blocks::INFO_UPDATE(), Ids::INFO_UPDATE);
		$this->mapSimple(Blocks::INFO_UPDATE2(), Ids::INFO_UPDATE2);
		$this->mapSimple(Blocks::INVISIBLE_BEDROCK(), Ids::INVISIBLE_BEDROCK);
		$this->mapSimple(Blocks::IRON(), Ids::IRON_BLOCK);
		$this->mapSimple(Blocks::IRON_BARS(), Ids::IRON_BARS);
		$this->map(Blocks::IRON_DOOR(), fn(Door $block) => Helper::encodeDoor($block, new Writer(Ids::IRON_DOOR)));
		$this->mapSimple(Blocks::IRON_ORE(), Ids::IRON_ORE);
		$this->map(Blocks::IRON_TRAPDOOR(), fn(Trapdoor $block) => Helper::encodeTrapdoor($block, new Writer(Ids::IRON_TRAPDOOR)));
		$this->map(Blocks::ITEM_FRAME(), function(ItemFrame $block) : Writer{
			return Writer::create(Ids::FRAME)
				->writeBool(StateNames::ITEM_FRAME_MAP_BIT, $block->hasMap())
				->writeBool(StateNames::ITEM_FRAME_PHOTO_BIT, false)
				->writeFacingDirection($block->getFacing());
		});
		$this->mapSimple(Blocks::JUKEBOX(), Ids::JUKEBOX);
		$this->map(Blocks::JUNGLE_BUTTON(), fn(WoodenButton $block) => Helper::encodeButton($block, new Writer(Ids::JUNGLE_BUTTON)));
		$this->map(Blocks::JUNGLE_DOOR(), fn(WoodenDoor $block) => Helper::encodeDoor($block, new Writer(Ids::JUNGLE_DOOR)));
		$this->map(Blocks::JUNGLE_FENCE(), fn() => Writer::create(Ids::FENCE)
				->writeString(StateNames::WOOD_TYPE, StringValues::WOOD_TYPE_JUNGLE));
		$this->map(Blocks::JUNGLE_FENCE_GATE(), fn(FenceGate $block) => Helper::encodeFenceGate($block, new Writer(Ids::JUNGLE_FENCE_GATE)));
		$this->map(Blocks::JUNGLE_LEAVES(), fn(Leaves $block) => Helper::encodeLeaves1($block, StringValues::OLD_LEAF_TYPE_JUNGLE));
		$this->map(Blocks::JUNGLE_LOG(), fn(Wood $block) => Helper::encodeLog1($block, StringValues::OLD_LOG_TYPE_JUNGLE, Ids::STRIPPED_JUNGLE_LOG));
		$this->map(Blocks::JUNGLE_PLANKS(), fn() => Writer::create(Ids::PLANKS)
				->writeString(StateNames::WOOD_TYPE, StringValues::WOOD_TYPE_JUNGLE));
		$this->map(Blocks::JUNGLE_PRESSURE_PLATE(), fn(WoodenPressurePlate $block) => Helper::encodeSimplePressurePlate($block, new Writer(Ids::JUNGLE_PRESSURE_PLATE)));
		$this->map(Blocks::JUNGLE_SAPLING(), fn(Sapling $block) => Helper::encodeSapling($block, StringValues::SAPLING_TYPE_JUNGLE));
		$this->map(Blocks::JUNGLE_SIGN(), fn(FloorSign $block) => Helper::encodeFloorSign($block, new Writer(Ids::JUNGLE_STANDING_SIGN)));
		$this->map(Blocks::JUNGLE_SLAB(), fn(Slab $block) => Helper::encodeWoodenSlab($block, StringValues::WOOD_TYPE_JUNGLE));
		$this->mapStairs(Blocks::JUNGLE_STAIRS(), Ids::JUNGLE_STAIRS);
		$this->map(Blocks::JUNGLE_TRAPDOOR(), fn(WoodenTrapdoor $block) => Helper::encodeTrapdoor($block, new Writer(Ids::JUNGLE_TRAPDOOR)));
		$this->map(Blocks::JUNGLE_WALL_SIGN(), fn(WallSign $block) => Helper::encodeWallSign($block, new Writer(Ids::JUNGLE_WALL_SIGN)));
		$this->map(Blocks::JUNGLE_WOOD(), fn(Wood $block) => Helper::encodeAllSidedLog($block));
		$this->map(Blocks::LAB_TABLE(), fn(ChemistryTable $block) => Helper::encodeChemistryTable($block, StringValues::CHEMISTRY_TABLE_TYPE_LAB_TABLE, new Writer(Ids::CHEMISTRY_TABLE)));
		$this->map(Blocks::LADDER(), function(Ladder $block) : Writer{
			return Writer::create(Ids::LADDER)
				->writeHorizontalFacing($block->getFacing());
		});
		$this->map(Blocks::LANTERN(), function(Lantern $block) : Writer{
			return Writer::create(Ids::LANTERN)
				->writeBool(StateNames::HANGING, $block->isHanging());
		});
		$this->mapSimple(Blocks::LAPIS_LAZULI(), Ids::LAPIS_BLOCK);
		$this->mapSimple(Blocks::LAPIS_LAZULI_ORE(), Ids::LAPIS_ORE);
		$this->map(Blocks::LARGE_FERN(), fn(DoubleTallGrass $block) => Helper::encodeDoublePlant($block, StringValues::DOUBLE_PLANT_TYPE_FERN, Writer::create(Ids::DOUBLE_PLANT)));
		$this->map(Blocks::LAVA(), fn(Lava $block) => Helper::encodeLiquid($block, Ids::LAVA, Ids::FLOWING_LAVA));
		$this->map(Blocks::LECTERN(), function(Lectern $block) : Writer{
			return Writer::create(Ids::LECTERN)
				->writeBool(StateNames::POWERED_BIT, $block->isProducingSignal())
				->writeLegacyHorizontalFacing($block->getFacing());
		});
		$this->mapSimple(Blocks::LEGACY_STONECUTTER(), Ids::STONECUTTER);
		$this->map(Blocks::LEVER(), function(Lever $block) : Writer{
			return Writer::create(Ids::LEVER)
				->writeBool(StateNames::OPEN_BIT, $block->isActivated())
				->writeString(StateNames::LEVER_DIRECTION, match($block->getFacing()->id()){
					LeverFacing::DOWN_AXIS_Z()->id() => StringValues::LEVER_DIRECTION_DOWN_NORTH_SOUTH,
					LeverFacing::DOWN_AXIS_X()->id() => StringValues::LEVER_DIRECTION_DOWN_EAST_WEST,
					LeverFacing::UP_AXIS_Z()->id() => StringValues::LEVER_DIRECTION_UP_NORTH_SOUTH,
					LeverFacing::UP_AXIS_X()->id() => StringValues::LEVER_DIRECTION_UP_EAST_WEST,
					LeverFacing::NORTH()->id() => StringValues::LEVER_DIRECTION_NORTH,
					LeverFacing::SOUTH()->id() => StringValues::LEVER_DIRECTION_SOUTH,
					LeverFacing::WEST()->id() => StringValues::LEVER_DIRECTION_WEST,
					LeverFacing::EAST()->id() => StringValues::LEVER_DIRECTION_EAST,
					default => throw new BlockStateSerializeException("Invalid Lever facing " . $block->getFacing()->name()),
				});
		});
		$this->map(Blocks::LIGHT(), function(Light $block) : Writer{
			return Writer::create(Ids::LIGHT_BLOCK)
				->writeInt(StateNames::BLOCK_LIGHT_LEVEL, $block->getLightLevel());
		});
		$this->map(Blocks::LILAC(), fn(DoublePlant $block) => Helper::encodeDoublePlant($block, StringValues::DOUBLE_PLANT_TYPE_SYRINGA, Writer::create(Ids::DOUBLE_PLANT)));
		$this->map(Blocks::LILY_OF_THE_VALLEY(), fn() => Helper::encodeRedFlower(StringValues::FLOWER_TYPE_LILY_OF_THE_VALLEY));
		$this->mapSimple(Blocks::LILY_PAD(), Ids::WATERLILY);
		$this->map(Blocks::LIT_PUMPKIN(), function(LitPumpkin $block) : Writer{
			return Writer::create(Ids::LIT_PUMPKIN)
				->writeLegacyHorizontalFacing($block->getFacing());
		});
		$this->map(Blocks::LOOM(), function(Loom $block) : Writer{
			return Writer::create(Ids::LOOM)
				->writeLegacyHorizontalFacing($block->getFacing());
		});
		$this->mapSimple(Blocks::MAGMA(), Ids::MAGMA);
		$this->map(Blocks::MANGROVE_BUTTON(), fn(Button $block) => Helper::encodeButton($block, new Writer(Ids::MANGROVE_BUTTON)));
		$this->map(Blocks::MANGROVE_DOOR(), fn(Door $block) => Helper::encodeDoor($block, new Writer(Ids::MANGROVE_DOOR)));
		$this->mapSimple(Blocks::MANGROVE_FENCE(), Ids::MANGROVE_FENCE);
		$this->map(Blocks::MANGROVE_FENCE_GATE(), fn(FenceGate $block) => Helper::encodeFenceGate($block, new Writer(Ids::MANGROVE_FENCE_GATE)));
		$this->map(Blocks::MANGROVE_LOG(), fn(Wood $block) => Helper::encodeNewLog($block, Ids::MANGROVE_LOG, Ids::STRIPPED_MANGROVE_LOG));
		$this->mapSimple(Blocks::MANGROVE_PLANKS(), Ids::MANGROVE_PLANKS);
		$this->map(Blocks::MANGROVE_PRESSURE_PLATE(), fn(SimplePressurePlate $block) => Helper::encodeSimplePressurePlate($block, new Writer(Ids::MANGROVE_PRESSURE_PLATE)));
		$this->map(Blocks::MANGROVE_SIGN(), fn(FloorSign $block) => Helper::encodeFloorSign($block, new Writer(Ids::MANGROVE_STANDING_SIGN)));
		$this->mapSlab(Blocks::MANGROVE_SLAB(), Ids::MANGROVE_SLAB, Ids::MANGROVE_DOUBLE_SLAB);
		$this->mapStairs(Blocks::MANGROVE_STAIRS(), Ids::MANGROVE_STAIRS);
		$this->map(Blocks::MANGROVE_TRAPDOOR(), fn(Trapdoor $block) => Helper::encodeTrapdoor($block, new Writer(Ids::MANGROVE_TRAPDOOR)));
		$this->map(Blocks::MANGROVE_WALL_SIGN(), fn(WallSign $block) => Helper::encodeWallSign($block, new Writer(Ids::MANGROVE_WALL_SIGN)));
		$this->map(Blocks::MANGROVE_WOOD(), function(Wood $block) : Writer{
			//we can't use the standard method for this because mangrove_wood has a useless property attached to it
			if(!$block->isStripped()){
				return Writer::create(Ids::MANGROVE_WOOD)
					->writePillarAxis($block->getAxis())
					->writeBool(StateNames::STRIPPED_BIT, false); //this is useless, but it has to be written
			}else{
				return Writer::create(Ids::STRIPPED_MANGROVE_WOOD)
					->writePillarAxis($block->getAxis());
			}
		});
		$this->map(Blocks::MATERIAL_REDUCER(), fn(ChemistryTable $block) => Helper::encodeChemistryTable($block, StringValues::CHEMISTRY_TABLE_TYPE_MATERIAL_REDUCER, new Writer(Ids::CHEMISTRY_TABLE)));
		$this->mapSimple(Blocks::MELON(), Ids::MELON_BLOCK);
		$this->map(Blocks::MELON_STEM(), fn(MelonStem $block) => Helper::encodeStem($block, new Writer(Ids::MELON_STEM)));
		$this->map(Blocks::MOB_HEAD(), function(Skull $block) : Writer{
			return Writer::create(Ids::SKULL)
				->writeFacingWithoutDown($block->getFacing());
		});
		$this->mapSimple(Blocks::MONSTER_SPAWNER(), Ids::MOB_SPAWNER);
		$this->mapSimple(Blocks::MOSSY_COBBLESTONE(), Ids::MOSSY_COBBLESTONE);
		$this->map(Blocks::MOSSY_COBBLESTONE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab2($block, StringValues::STONE_SLAB_TYPE_2_MOSSY_COBBLESTONE));
		$this->mapStairs(Blocks::MOSSY_COBBLESTONE_STAIRS(), Ids::MOSSY_COBBLESTONE_STAIRS);
		$this->map(Blocks::MOSSY_COBBLESTONE_WALL(), fn(Wall $block) => Helper::encodeLegacyWall($block, StringValues::WALL_BLOCK_TYPE_MOSSY_COBBLESTONE));
		$this->map(Blocks::MOSSY_STONE_BRICKS(), fn() => Helper::encodeStoneBricks(StringValues::STONE_BRICK_TYPE_MOSSY));
		$this->map(Blocks::MOSSY_STONE_BRICK_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab4($block, StringValues::STONE_SLAB_TYPE_4_MOSSY_STONE_BRICK));
		$this->mapStairs(Blocks::MOSSY_STONE_BRICK_STAIRS(), Ids::MOSSY_STONE_BRICK_STAIRS);
		$this->map(Blocks::MOSSY_STONE_BRICK_WALL(), fn(Wall $block) => Helper::encodeLegacyWall($block, StringValues::WALL_BLOCK_TYPE_MOSSY_STONE_BRICK));
		$this->mapSimple(Blocks::MUD_BRICKS(), Ids::MUD_BRICKS);
		$this->mapSlab(Blocks::MUD_BRICK_SLAB(), Ids::MUD_BRICK_SLAB, Ids::MUD_BRICK_DOUBLE_SLAB);
		$this->mapStairs(Blocks::MUD_BRICK_STAIRS(), Ids::MUD_BRICK_STAIRS);
		$this->map(Blocks::MUD_BRICK_WALL(), fn(Wall $block) => Helper::encodeWall($block, new Writer(Ids::MUD_BRICK_WALL)));
		$this->map(Blocks::MUSHROOM_STEM(), fn() => Writer::create(Ids::BROWN_MUSHROOM_BLOCK)
				->writeInt(StateNames::HUGE_MUSHROOM_BITS, BlockLegacyMetadata::MUSHROOM_BLOCK_STEM));
		$this->mapSimple(Blocks::MYCELIUM(), Ids::MYCELIUM);
		$this->mapSimple(Blocks::NETHERRACK(), Ids::NETHERRACK);
		$this->mapSimple(Blocks::NETHER_BRICKS(), Ids::NETHER_BRICK);
		$this->mapSimple(Blocks::NETHER_BRICK_FENCE(), Ids::NETHER_BRICK_FENCE);
		$this->map(Blocks::NETHER_BRICK_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab1($block, StringValues::STONE_SLAB_TYPE_NETHER_BRICK));
		$this->mapStairs(Blocks::NETHER_BRICK_STAIRS(), Ids::NETHER_BRICK_STAIRS);
		$this->map(Blocks::NETHER_BRICK_WALL(), fn(Wall $block) => Helper::encodeLegacyWall($block, StringValues::WALL_BLOCK_TYPE_NETHER_BRICK));
		$this->mapSimple(Blocks::NETHER_GOLD_ORE(), Ids::NETHER_GOLD_ORE);
		$this->map(Blocks::NETHER_PORTAL(), function(NetherPortal $block) : Writer{
			return Writer::create(Ids::PORTAL)
				->writeString(StateNames::PORTAL_AXIS, match($block->getAxis()){
					Axis::X => StringValues::PORTAL_AXIS_X,
					Axis::Z => StringValues::PORTAL_AXIS_Z,
					default => throw new BlockStateSerializeException("Invalid Nether Portal axis " . $block->getAxis()),
				});
		});
		$this->mapSimple(Blocks::NETHER_QUARTZ_ORE(), Ids::QUARTZ_ORE);
		$this->mapSimple(Blocks::NETHER_REACTOR_CORE(), Ids::NETHERREACTOR);
		$this->map(Blocks::NETHER_WART(), function(NetherWartPlant $block) : Writer{
			return Writer::create(Ids::NETHER_WART)
				->writeInt(StateNames::AGE, $block->getAge());
		});
		$this->mapSimple(Blocks::NETHER_WART_BLOCK(), Ids::NETHER_WART_BLOCK);
		$this->mapSimple(Blocks::NOTE_BLOCK(), Ids::NOTEBLOCK);
		$this->map(Blocks::OAK_BUTTON(), fn(WoodenButton $block) => Helper::encodeButton($block, new Writer(Ids::WOODEN_BUTTON)));
		$this->map(Blocks::OAK_DOOR(), fn(WoodenDoor $block) => Helper::encodeDoor($block, new Writer(Ids::WOODEN_DOOR)));
		$this->map(Blocks::OAK_FENCE(), fn() => Writer::create(Ids::FENCE)
				->writeString(StateNames::WOOD_TYPE, StringValues::WOOD_TYPE_OAK));
		$this->map(Blocks::OAK_FENCE_GATE(), fn(FenceGate $block) => Helper::encodeFenceGate($block, new Writer(Ids::FENCE_GATE)));
		$this->map(Blocks::OAK_LEAVES(), fn(Leaves $block) => Helper::encodeLeaves1($block, StringValues::OLD_LEAF_TYPE_OAK));
		$this->map(Blocks::OAK_LOG(), fn(Wood $block) => Helper::encodeLog1($block, StringValues::OLD_LOG_TYPE_OAK, Ids::STRIPPED_OAK_LOG));
		$this->map(Blocks::OAK_PLANKS(), fn() => Writer::create(Ids::PLANKS)
				->writeString(StateNames::WOOD_TYPE, StringValues::WOOD_TYPE_OAK));
		$this->map(Blocks::OAK_PRESSURE_PLATE(), fn(WoodenPressurePlate $block) => Helper::encodeSimplePressurePlate($block, new Writer(Ids::WOODEN_PRESSURE_PLATE)));
		$this->map(Blocks::OAK_SAPLING(), fn(Sapling $block) => Helper::encodeSapling($block, StringValues::SAPLING_TYPE_OAK));
		$this->map(Blocks::OAK_SIGN(), fn(FloorSign $block) => Helper::encodeFloorSign($block, new Writer(Ids::STANDING_SIGN)));
		$this->map(Blocks::OAK_SLAB(), fn(Slab $block) => Helper::encodeWoodenSlab($block, StringValues::WOOD_TYPE_OAK));
		$this->mapStairs(Blocks::OAK_STAIRS(), Ids::OAK_STAIRS);
		$this->map(Blocks::OAK_TRAPDOOR(), fn(WoodenTrapdoor $block) => Helper::encodeTrapdoor($block, new Writer(Ids::TRAPDOOR)));
		$this->map(Blocks::OAK_WALL_SIGN(), fn(WallSign $block) => Helper::encodeWallSign($block, new Writer(Ids::WALL_SIGN)));
		$this->map(Blocks::OAK_WOOD(), fn(Wood $block) => Helper::encodeAllSidedLog($block));
		$this->mapSimple(Blocks::OBSIDIAN(), Ids::OBSIDIAN);
		$this->map(Blocks::ORANGE_TULIP(), fn() => Helper::encodeRedFlower(StringValues::FLOWER_TYPE_TULIP_ORANGE));
		$this->map(Blocks::OXEYE_DAISY(), fn() => Helper::encodeRedFlower(StringValues::FLOWER_TYPE_OXEYE));
		$this->mapSimple(Blocks::PACKED_ICE(), Ids::PACKED_ICE);
		$this->map(Blocks::PEONY(), fn(DoublePlant $block) => Helper::encodeDoublePlant($block, StringValues::DOUBLE_PLANT_TYPE_PAEONIA, Writer::create(Ids::DOUBLE_PLANT)));
		$this->map(Blocks::PINK_TULIP(), fn() => Helper::encodeRedFlower(StringValues::FLOWER_TYPE_TULIP_PINK));
		$this->mapSimple(Blocks::PODZOL(), Ids::PODZOL);
		$this->map(Blocks::POLISHED_ANDESITE(), fn() => Helper::encodeStone(StringValues::STONE_TYPE_ANDESITE_SMOOTH));
		$this->map(Blocks::POLISHED_ANDESITE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab3($block, StringValues::STONE_SLAB_TYPE_3_POLISHED_ANDESITE));
		$this->mapStairs(Blocks::POLISHED_ANDESITE_STAIRS(), Ids::POLISHED_ANDESITE_STAIRS);
		$this->map(Blocks::POLISHED_BASALT(), function(SimplePillar $block) : Writer{
			return Writer::create(Ids::POLISHED_BASALT)
				->writePillarAxis($block->getAxis());
		});
		$this->mapSimple(Blocks::POLISHED_BLACKSTONE(), Ids::POLISHED_BLACKSTONE);
		$this->mapSimple(Blocks::POLISHED_BLACKSTONE_BRICKS(), Ids::POLISHED_BLACKSTONE_BRICKS);
		$this->mapSlab(Blocks::POLISHED_BLACKSTONE_BRICK_SLAB(), Ids::POLISHED_BLACKSTONE_BRICK_SLAB, Ids::POLISHED_BLACKSTONE_BRICK_DOUBLE_SLAB);
		$this->mapStairs(Blocks::POLISHED_BLACKSTONE_BRICK_STAIRS(), Ids::POLISHED_BLACKSTONE_BRICK_STAIRS);
		$this->map(Blocks::POLISHED_BLACKSTONE_BRICK_WALL(), fn(Wall $block) => Helper::encodeWall($block, new Writer(Ids::POLISHED_BLACKSTONE_BRICK_WALL)));
		$this->map(Blocks::POLISHED_BLACKSTONE_BUTTON(), fn(Button $block) => Helper::encodeButton($block, new Writer(Ids::POLISHED_BLACKSTONE_BUTTON)));
		$this->map(Blocks::POLISHED_BLACKSTONE_PRESSURE_PLATE(), fn(SimplePressurePlate $block) => Helper::encodeSimplePressurePlate($block, new Writer(Ids::POLISHED_BLACKSTONE_PRESSURE_PLATE)));
		$this->mapSlab(Blocks::POLISHED_BLACKSTONE_SLAB(), Ids::POLISHED_BLACKSTONE_SLAB, Ids::POLISHED_BLACKSTONE_DOUBLE_SLAB);
		$this->mapStairs(Blocks::POLISHED_BLACKSTONE_STAIRS(), Ids::POLISHED_BLACKSTONE_STAIRS);
		$this->map(Blocks::POLISHED_BLACKSTONE_WALL(), fn(Wall $block) => Helper::encodeWall($block, new Writer(Ids::POLISHED_BLACKSTONE_WALL)));
		$this->mapSimple(Blocks::POLISHED_DEEPSLATE(), Ids::POLISHED_DEEPSLATE);
		$this->mapSlab(Blocks::POLISHED_DEEPSLATE_SLAB(), Ids::POLISHED_DEEPSLATE_SLAB, Ids::POLISHED_DEEPSLATE_DOUBLE_SLAB);
		$this->mapStairs(Blocks::POLISHED_DEEPSLATE_STAIRS(), Ids::POLISHED_DEEPSLATE_STAIRS);
		$this->map(Blocks::POLISHED_DEEPSLATE_WALL(), fn(Wall $block) => Helper::encodeWall($block, new Writer(Ids::POLISHED_DEEPSLATE_WALL)));
		$this->map(Blocks::POLISHED_DIORITE(), fn() => Helper::encodeStone(StringValues::STONE_TYPE_DIORITE_SMOOTH));
		$this->map(Blocks::POLISHED_DIORITE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab3($block, StringValues::STONE_SLAB_TYPE_3_POLISHED_DIORITE));
		$this->mapStairs(Blocks::POLISHED_DIORITE_STAIRS(), Ids::POLISHED_DIORITE_STAIRS);
		$this->map(Blocks::POLISHED_GRANITE(), fn() => Helper::encodeStone(StringValues::STONE_TYPE_GRANITE_SMOOTH));
		$this->map(Blocks::POLISHED_GRANITE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab3($block, StringValues::STONE_SLAB_TYPE_3_POLISHED_GRANITE));
		$this->mapStairs(Blocks::POLISHED_GRANITE_STAIRS(), Ids::POLISHED_GRANITE_STAIRS);
		$this->map(Blocks::POPPY(), fn() => Helper::encodeRedFlower(StringValues::FLOWER_TYPE_POPPY));
		$this->map(Blocks::POTATOES(), fn(Potato $block) => Helper::encodeCrops($block, new Writer(Ids::POTATOES)));
		$this->map(Blocks::POWERED_RAIL(), function(PoweredRail $block) : Writer{
			return Writer::create(Ids::GOLDEN_RAIL)
				->writeBool(StateNames::RAIL_DATA_BIT, $block->isPowered())
				->writeInt(StateNames::RAIL_DIRECTION, $block->getShape());
		});
		$this->map(Blocks::PRISMARINE(), fn() => Writer::create(Ids::PRISMARINE)
				->writeString(StateNames::PRISMARINE_BLOCK_TYPE, StringValues::PRISMARINE_BLOCK_TYPE_DEFAULT));
		$this->map(Blocks::PRISMARINE_BRICKS(), fn() => Writer::create(Ids::PRISMARINE)
				->writeString(StateNames::PRISMARINE_BLOCK_TYPE, StringValues::PRISMARINE_BLOCK_TYPE_BRICKS));
		$this->map(Blocks::PRISMARINE_BRICKS_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab2($block, StringValues::STONE_SLAB_TYPE_2_PRISMARINE_BRICK));
		$this->mapStairs(Blocks::PRISMARINE_BRICKS_STAIRS(), Ids::PRISMARINE_BRICKS_STAIRS);
		$this->map(Blocks::PRISMARINE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab2($block, StringValues::STONE_SLAB_TYPE_2_PRISMARINE_ROUGH));
		$this->mapStairs(Blocks::PRISMARINE_STAIRS(), Ids::PRISMARINE_STAIRS);
		$this->map(Blocks::PRISMARINE_WALL(), fn(Wall $block) => Helper::encodeLegacyWall($block, StringValues::WALL_BLOCK_TYPE_PRISMARINE));
		$this->map(Blocks::PUMPKIN(), function() : Writer{
			return Writer::create(Ids::PUMPKIN)
				->writeLegacyHorizontalFacing(Facing::SOUTH); //no longer used
		});
		$this->map(Blocks::PUMPKIN_STEM(), fn(PumpkinStem $block) => Helper::encodeStem($block, new Writer(Ids::PUMPKIN_STEM)));
		$this->map(Blocks::PURPLE_TORCH(), fn(Torch $block) => Helper::encodeColoredTorch($block, true, Writer::create(Ids::COLORED_TORCH_BP)));
		$this->map(Blocks::PURPUR(), function() : Writer{
			return Writer::create(Ids::PURPUR_BLOCK)
				->writeString(StateNames::CHISEL_TYPE, StringValues::CHISEL_TYPE_DEFAULT)
				->writePillarAxis(Axis::Y); //useless, but MCPE wants it
		});
		$this->map(Blocks::PURPUR_PILLAR(), function(SimplePillar $block) : Writer{
			return Writer::create(Ids::PURPUR_BLOCK)
				->writeString(StateNames::CHISEL_TYPE, StringValues::CHISEL_TYPE_LINES)
				->writePillarAxis($block->getAxis());
		});
		$this->map(Blocks::PURPUR_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab2($block, StringValues::STONE_SLAB_TYPE_2_PURPUR));
		$this->mapStairs(Blocks::PURPUR_STAIRS(), Ids::PURPUR_STAIRS);
		$this->map(Blocks::QUARTZ(), fn() => Helper::encodeQuartz(StringValues::CHISEL_TYPE_DEFAULT, Axis::Y));
		$this->mapSimple(Blocks::QUARTZ_BRICKS(), Ids::QUARTZ_BRICKS);
		$this->map(Blocks::QUARTZ_PILLAR(), fn(SimplePillar $block) => Helper::encodeQuartz(StringValues::CHISEL_TYPE_LINES, $block->getAxis()));
		$this->map(Blocks::QUARTZ_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab1($block, StringValues::STONE_SLAB_TYPE_QUARTZ));
		$this->mapStairs(Blocks::QUARTZ_STAIRS(), Ids::QUARTZ_STAIRS);
		$this->map(Blocks::RAIL(), function(Rail $block) : Writer{
			return Writer::create(Ids::RAIL)
				->writeInt(StateNames::RAIL_DIRECTION, $block->getShape());
		});
		$this->mapSimple(Blocks::RAW_COPPER(), Ids::RAW_COPPER_BLOCK);
		$this->mapSimple(Blocks::RAW_GOLD(), Ids::RAW_GOLD_BLOCK);
		$this->mapSimple(Blocks::RAW_IRON(), Ids::RAW_IRON_BLOCK);
		$this->mapSimple(Blocks::REDSTONE(), Ids::REDSTONE_BLOCK);
		$this->map(Blocks::REDSTONE_COMPARATOR(), function(RedstoneComparator $block) : Writer{
			return Writer::create($block->isPowered() ? Ids::POWERED_COMPARATOR : Ids::UNPOWERED_COMPARATOR)
				->writeBool(StateNames::OUTPUT_LIT_BIT, $block->isPowered())
				->writeBool(StateNames::OUTPUT_SUBTRACT_BIT, $block->isSubtractMode())
				->writeLegacyHorizontalFacing($block->getFacing());
		});
		$this->map(Blocks::REDSTONE_LAMP(), fn(RedstoneLamp $block) => new Writer($block->isPowered() ? Ids::LIT_REDSTONE_LAMP : Ids::REDSTONE_LAMP));
		$this->map(Blocks::REDSTONE_ORE(), fn(RedstoneOre $block) => new Writer($block->isLit() ? Ids::LIT_REDSTONE_ORE : Ids::REDSTONE_ORE));
		$this->map(Blocks::REDSTONE_REPEATER(), function(RedstoneRepeater $block) : Writer{
			return Writer::create($block->isPowered() ? Ids::POWERED_REPEATER : Ids::UNPOWERED_REPEATER)
				->writeLegacyHorizontalFacing($block->getFacing())
				->writeInt(StateNames::REPEATER_DELAY, $block->getDelay() - 1);
		});
		$this->map(Blocks::REDSTONE_TORCH(), function(RedstoneTorch $block) : Writer{
			return Writer::create($block->isLit() ? Ids::REDSTONE_TORCH : Ids::UNLIT_REDSTONE_TORCH)
				->writeTorchFacing($block->getFacing());
		});
		$this->map(Blocks::REDSTONE_WIRE(), function(RedstoneWire $block) : Writer{
			return Writer::create(Ids::REDSTONE_WIRE)
				->writeInt(StateNames::REDSTONE_SIGNAL, $block->getOutputSignalStrength());
		});
		$this->mapSimple(Blocks::RED_MUSHROOM(), Ids::RED_MUSHROOM);
		$this->map(Blocks::RED_MUSHROOM_BLOCK(), fn(RedMushroomBlock $block) => Helper::encodeMushroomBlock($block, new Writer(Ids::RED_MUSHROOM_BLOCK)));
		$this->mapSimple(Blocks::RED_NETHER_BRICKS(), Ids::RED_NETHER_BRICK);
		$this->map(Blocks::RED_NETHER_BRICK_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab2($block, StringValues::STONE_SLAB_TYPE_2_RED_NETHER_BRICK));
		$this->mapStairs(Blocks::RED_NETHER_BRICK_STAIRS(), Ids::RED_NETHER_BRICK_STAIRS);
		$this->map(Blocks::RED_NETHER_BRICK_WALL(), fn(Wall $block) => Helper::encodeLegacyWall($block, StringValues::WALL_BLOCK_TYPE_RED_NETHER_BRICK));
		$this->map(Blocks::RED_SAND(), fn() => Writer::create(Ids::SAND)
				->writeString(StateNames::SAND_TYPE, StringValues::SAND_TYPE_RED));
		$this->map(Blocks::RED_SANDSTONE(), fn() => Helper::encodeSandstone(Ids::RED_SANDSTONE, StringValues::SAND_STONE_TYPE_DEFAULT));
		$this->map(Blocks::RED_SANDSTONE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab2($block, StringValues::STONE_SLAB_TYPE_2_RED_SANDSTONE));
		$this->mapStairs(Blocks::RED_SANDSTONE_STAIRS(), Ids::RED_SANDSTONE_STAIRS);
		$this->map(Blocks::RED_SANDSTONE_WALL(), fn(Wall $block) => Helper::encodeLegacyWall($block, StringValues::WALL_BLOCK_TYPE_RED_SANDSTONE));
		$this->map(Blocks::RED_TORCH(), fn(Torch $block) => Helper::encodeColoredTorch($block, false, Writer::create(Ids::COLORED_TORCH_RG)));
		$this->map(Blocks::RED_TULIP(), fn() => Helper::encodeRedFlower(StringValues::FLOWER_TYPE_TULIP_RED));
		$this->mapSimple(Blocks::RESERVED6(), Ids::RESERVED6);
		$this->map(Blocks::ROSE_BUSH(), fn(DoublePlant $block) => Helper::encodeDoublePlant($block, StringValues::DOUBLE_PLANT_TYPE_ROSE, Writer::create(Ids::DOUBLE_PLANT)));
		$this->map(Blocks::SAND(), fn() => Writer::create(Ids::SAND)
				->writeString(StateNames::SAND_TYPE, StringValues::SAND_TYPE_NORMAL));
		$this->map(Blocks::SANDSTONE(), fn() => Helper::encodeSandstone(Ids::SANDSTONE, StringValues::SAND_STONE_TYPE_DEFAULT));
		$this->map(Blocks::SANDSTONE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab1($block, StringValues::STONE_SLAB_TYPE_SANDSTONE));
		$this->mapStairs(Blocks::SANDSTONE_STAIRS(), Ids::SANDSTONE_STAIRS);
		$this->map(Blocks::SANDSTONE_WALL(), fn(Wall $block) => Helper::encodeLegacyWall($block, StringValues::WALL_BLOCK_TYPE_SANDSTONE));
		$this->mapSimple(Blocks::SEA_LANTERN(), Ids::SEA_LANTERN);
		$this->map(Blocks::SEA_PICKLE(), function(SeaPickle $block) : Writer{
			return Writer::create(Ids::SEA_PICKLE)
				->writeBool(StateNames::DEAD_BIT, !$block->isUnderwater())
				->writeInt(StateNames::CLUSTER_COUNT, $block->getCount() - 1);
		});
		$this->mapSimple(Blocks::SHROOMLIGHT(), Ids::SHROOMLIGHT);
		$this->mapSimple(Blocks::SHULKER_BOX(), Ids::UNDYED_SHULKER_BOX);
		$this->mapSimple(Blocks::SLIME(), Ids::SLIME);
		$this->map(Blocks::SMOKER(), fn(Furnace $block) => Helper::encodeFurnace($block, Ids::SMOKER, Ids::LIT_SMOKER));
		$this->mapSimple(Blocks::SMOOTH_BASALT(), Ids::SMOOTH_BASALT);
		$this->map(Blocks::SMOOTH_QUARTZ(), fn() => Helper::encodeQuartz(StringValues::CHISEL_TYPE_SMOOTH, Axis::Y));
		$this->map(Blocks::SMOOTH_QUARTZ_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab4($block, StringValues::STONE_SLAB_TYPE_4_SMOOTH_QUARTZ));
		$this->mapStairs(Blocks::SMOOTH_QUARTZ_STAIRS(), Ids::SMOOTH_QUARTZ_STAIRS);
		$this->map(Blocks::SMOOTH_RED_SANDSTONE(), fn() => Helper::encodeSandstone(Ids::RED_SANDSTONE, StringValues::SAND_STONE_TYPE_SMOOTH));
		$this->map(Blocks::SMOOTH_RED_SANDSTONE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab3($block, StringValues::STONE_SLAB_TYPE_3_SMOOTH_RED_SANDSTONE));
		$this->mapStairs(Blocks::SMOOTH_RED_SANDSTONE_STAIRS(), Ids::SMOOTH_RED_SANDSTONE_STAIRS);
		$this->map(Blocks::SMOOTH_SANDSTONE(), fn() => Helper::encodeSandstone(Ids::SANDSTONE, StringValues::SAND_STONE_TYPE_SMOOTH));
		$this->map(Blocks::SMOOTH_SANDSTONE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab2($block, StringValues::STONE_SLAB_TYPE_2_SMOOTH_SANDSTONE));
		$this->mapStairs(Blocks::SMOOTH_SANDSTONE_STAIRS(), Ids::SMOOTH_SANDSTONE_STAIRS);
		$this->mapSimple(Blocks::SMOOTH_STONE(), Ids::SMOOTH_STONE);
		$this->map(Blocks::SMOOTH_STONE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab1($block, StringValues::STONE_SLAB_TYPE_SMOOTH_STONE));
		$this->mapSimple(Blocks::SNOW(), Ids::SNOW);
		$this->map(Blocks::SNOW_LAYER(), function(SnowLayer $block) : Writer{
			return Writer::create(Ids::SNOW_LAYER)
				->writeBool(StateNames::COVERED_BIT, false)
				->writeInt(StateNames::HEIGHT, $block->getLayers() - 1);
		});
		$this->map(Blocks::SOUL_FIRE(), function() : Writer{
			return Writer::create(Ids::SOUL_FIRE)
				->writeInt(StateNames::AGE, 0); //useless for soul fire, we don't track it
		});
		$this->map(Blocks::SOUL_LANTERN(), function(Lantern $block) : Writer{
			return Writer::create(Ids::SOUL_LANTERN)
				->writeBool(StateNames::HANGING, $block->isHanging());
		});
		$this->mapSimple(Blocks::SOUL_SAND(), Ids::SOUL_SAND);
		$this->mapSimple(Blocks::SOUL_SOIL(), Ids::SOUL_SOIL);
		$this->map(Blocks::SOUL_TORCH(), function(Torch $block) : Writer{
			return Writer::create(Ids::SOUL_TORCH)
				->writeTorchFacing($block->getFacing());
		});
		$this->map(Blocks::SPONGE(), function(Sponge $block) : Writer{
			return Writer::create(Ids::SPONGE)
				->writeString(StateNames::SPONGE_TYPE, $block->isWet() ? StringValues::SPONGE_TYPE_WET : StringValues::SPONGE_TYPE_DRY);
		});
		$this->map(Blocks::SPRUCE_BUTTON(), fn(WoodenButton $block) => Helper::encodeButton($block, new Writer(Ids::SPRUCE_BUTTON)));
		$this->map(Blocks::SPRUCE_DOOR(), fn(WoodenDoor $block) => Helper::encodeDoor($block, new Writer(Ids::SPRUCE_DOOR)));
		$this->map(Blocks::SPRUCE_FENCE(), fn() => Writer::create(Ids::FENCE)
				->writeString(StateNames::WOOD_TYPE, StringValues::WOOD_TYPE_SPRUCE));
		$this->map(Blocks::SPRUCE_FENCE_GATE(), fn(FenceGate $block) => Helper::encodeFenceGate($block, new Writer(Ids::SPRUCE_FENCE_GATE)));
		$this->map(Blocks::SPRUCE_LEAVES(), fn(Leaves $block) => Helper::encodeLeaves1($block, StringValues::OLD_LEAF_TYPE_SPRUCE));
		$this->map(Blocks::SPRUCE_LOG(), fn(Wood $block) => Helper::encodeLog1($block, StringValues::OLD_LOG_TYPE_SPRUCE, Ids::STRIPPED_SPRUCE_LOG));
		$this->map(Blocks::SPRUCE_PLANKS(), fn() => Writer::create(Ids::PLANKS)
				->writeString(StateNames::WOOD_TYPE, StringValues::WOOD_TYPE_SPRUCE));
		$this->map(Blocks::SPRUCE_PRESSURE_PLATE(), fn(WoodenPressurePlate $block) => Helper::encodeSimplePressurePlate($block, new Writer(Ids::SPRUCE_PRESSURE_PLATE)));
		$this->map(Blocks::SPRUCE_SAPLING(), fn(Sapling $block) => Helper::encodeSapling($block, StringValues::SAPLING_TYPE_SPRUCE));
		$this->map(Blocks::SPRUCE_SIGN(), fn(FloorSign $block) => Helper::encodeFloorSign($block, new Writer(Ids::SPRUCE_STANDING_SIGN)));
		$this->map(Blocks::SPRUCE_SLAB(), fn(Slab $block) => Helper::encodeWoodenSlab($block, StringValues::WOOD_TYPE_SPRUCE));
		$this->mapStairs(Blocks::SPRUCE_STAIRS(), Ids::SPRUCE_STAIRS);
		$this->map(Blocks::SPRUCE_TRAPDOOR(), fn(WoodenTrapdoor $block) => Helper::encodeTrapdoor($block, new Writer(Ids::SPRUCE_TRAPDOOR)));
		$this->map(Blocks::SPRUCE_WALL_SIGN(), fn(WallSign $block) => Helper::encodeWallSign($block, new Writer(Ids::SPRUCE_WALL_SIGN)));
		$this->map(Blocks::SPRUCE_WOOD(), fn(Wood $block) => Helper::encodeAllSidedLog($block));
		$this->map(Blocks::STAINED_CLAY(), function(StainedHardenedClay $block) : Writer{
			return Writer::create(Ids::STAINED_HARDENED_CLAY)
				->writeColor($block->getColor());
		});
		$this->map(Blocks::STAINED_GLASS(), function(StainedGlass $block) : Writer{
			return Writer::create(Ids::STAINED_GLASS)
				->writeColor($block->getColor());
		});
		$this->map(Blocks::STAINED_GLASS_PANE(), function(StainedGlassPane $block) : Writer{
			return Writer::create(Ids::STAINED_GLASS_PANE)
				->writeColor($block->getColor());
		});
		$this->map(Blocks::STAINED_HARDENED_GLASS(), function(StainedHardenedGlass $block) : Writer{
			return Writer::create(Ids::HARD_STAINED_GLASS)
				->writeColor($block->getColor());
		});
		$this->map(Blocks::STAINED_HARDENED_GLASS_PANE(), function(StainedHardenedGlassPane $block) : Writer{
			return Writer::create(Ids::HARD_STAINED_GLASS_PANE)
				->writeColor($block->getColor());
		});
		$this->map(Blocks::STONE(), fn() => Helper::encodeStone(StringValues::STONE_TYPE_STONE));
		$this->map(Blocks::STONECUTTER(), fn(Stonecutter $block) => Writer::create(Ids::STONECUTTER_BLOCK)
			->writeHorizontalFacing($block->getFacing()));
		$this->map(Blocks::STONE_BRICKS(), fn() => Helper::encodeStoneBricks(StringValues::STONE_BRICK_TYPE_DEFAULT));
		$this->map(Blocks::STONE_BRICK_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab1($block, StringValues::STONE_SLAB_TYPE_STONE_BRICK));
		$this->mapStairs(Blocks::STONE_BRICK_STAIRS(), Ids::STONE_BRICK_STAIRS);
		$this->map(Blocks::STONE_BRICK_WALL(), fn(Wall $block) => Helper::encodeLegacyWall($block, StringValues::WALL_BLOCK_TYPE_STONE_BRICK));
		$this->map(Blocks::STONE_BUTTON(), fn(StoneButton $block) => Helper::encodeButton($block, new Writer(Ids::STONE_BUTTON)));
		$this->map(Blocks::STONE_PRESSURE_PLATE(), fn(StonePressurePlate $block) => Helper::encodeSimplePressurePlate($block, new Writer(Ids::STONE_PRESSURE_PLATE)));
		$this->map(Blocks::STONE_SLAB(), fn(Slab $block) => Helper::encodeStoneSlab4($block, StringValues::STONE_SLAB_TYPE_4_STONE));
		$this->mapStairs(Blocks::STONE_STAIRS(), Ids::NORMAL_STONE_STAIRS);
		$this->map(Blocks::SUGARCANE(), function(Sugarcane $block) : Writer{
			return Writer::create(Ids::REEDS)
				->writeInt(StateNames::AGE, $block->getAge());
		});
		$this->map(Blocks::SUNFLOWER(), fn(DoublePlant $block) => Helper::encodeDoublePlant($block, StringValues::DOUBLE_PLANT_TYPE_SUNFLOWER, Writer::create(Ids::DOUBLE_PLANT)));
		$this->map(Blocks::SWEET_BERRY_BUSH(), function(SweetBerryBush $block) : Writer{
			return Writer::create(Ids::SWEET_BERRY_BUSH)
				->writeInt(StateNames::GROWTH, $block->getAge());
		});
		$this->map(Blocks::TALL_GRASS(), fn() => Writer::create(Ids::TALLGRASS)
				->writeString(StateNames::TALL_GRASS_TYPE, StringValues::TALL_GRASS_TYPE_TALL));
		$this->map(Blocks::TNT(), function(TNT $block) : Writer{
			return Writer::create(Ids::TNT)
				->writeBool(StateNames::ALLOW_UNDERWATER_BIT, $block->worksUnderwater())
				->writeBool(StateNames::EXPLODE_BIT, $block->isUnstable());
		});
		$this->map(Blocks::TORCH(), function(Torch $block) : Writer{
			return Writer::create(Ids::TORCH)
				->writeTorchFacing($block->getFacing());
		});
		$this->map(Blocks::TRAPPED_CHEST(), function(TrappedChest $block) : Writer{
			return Writer::create(Ids::TRAPPED_CHEST)
				->writeHorizontalFacing($block->getFacing());
		});
		$this->map(Blocks::TRIPWIRE(), function(Tripwire $block) : Writer{
			return Writer::create(Ids::TRIP_WIRE)
				->writeBool(StateNames::ATTACHED_BIT, $block->isConnected())
				->writeBool(StateNames::DISARMED_BIT, $block->isDisarmed())
				->writeBool(StateNames::POWERED_BIT, $block->isTriggered())
				->writeBool(StateNames::SUSPENDED_BIT, $block->isSuspended());
		});
		$this->map(Blocks::TRIPWIRE_HOOK(), function(TripwireHook $block) : Writer{
			return Writer::create(Ids::TRIPWIRE_HOOK)
				->writeBool(StateNames::ATTACHED_BIT, $block->isConnected())
				->writeBool(StateNames::POWERED_BIT, $block->isPowered())
				->writeLegacyHorizontalFacing($block->getFacing());
		});
		$this->mapSimple(Blocks::TUFF(), Ids::TUFF);
		$this->map(Blocks::UNDERWATER_TORCH(), function(UnderwaterTorch $block) : Writer{
			return Writer::create(Ids::UNDERWATER_TORCH)
				->writeTorchFacing($block->getFacing());
		});
		$this->map(Blocks::VINES(), function(Vine $block) : Writer{
			return Writer::create(Ids::VINE)
				->writeInt(StateNames::VINE_DIRECTION_BITS, ($block->hasFace(Facing::NORTH) ? BlockLegacyMetadata::VINE_FLAG_NORTH : 0) | ($block->hasFace(Facing::SOUTH) ? BlockLegacyMetadata::VINE_FLAG_SOUTH : 0) | ($block->hasFace(Facing::WEST) ? BlockLegacyMetadata::VINE_FLAG_WEST : 0) | ($block->hasFace(Facing::EAST) ? BlockLegacyMetadata::VINE_FLAG_EAST : 0));
		});
		$this->map(Blocks::WALL_BANNER(), function(WallBanner $block) : Writer{
			return Writer::create(Ids::WALL_BANNER)
				->writeHorizontalFacing($block->getFacing());
		});
		$this->map(Blocks::WALL_CORAL_FAN(), function(WallCoralFan $block) : Writer{
			$coralType = $block->getCoralType();
			return Writer::create(match($coralType->id()){
				CoralType::TUBE()->id(), CoralType::BRAIN()->id() => Ids::CORAL_FAN_HANG,
				CoralType::BUBBLE()->id(), CoralType::FIRE()->id() => Ids::CORAL_FAN_HANG2,
				CoralType::HORN()->id() => Ids::CORAL_FAN_HANG3,
				default => throw new BlockStateSerializeException("Invalid Coral type " . $coralType->name()),
			})
				->writeBool(StateNames::CORAL_HANG_TYPE_BIT, $coralType->equals(CoralType::BRAIN()) || $coralType->equals(CoralType::FIRE()))
				->writeBool(StateNames::DEAD_BIT, $block->isDead())
				->writeCoralFacing($block->getFacing());
		});
		$this->map(Blocks::WARPED_BUTTON(), fn(Button $block) => Helper::encodeButton($block, new Writer(Ids::WARPED_BUTTON)));
		$this->map(Blocks::WARPED_DOOR(), fn(Door $block) => Helper::encodeDoor($block, new Writer(Ids::WARPED_DOOR)));
		$this->mapSimple(Blocks::WARPED_FENCE(), Ids::WARPED_FENCE);
		$this->map(Blocks::WARPED_FENCE_GATE(), fn(FenceGate $block) => Helper::encodeFenceGate($block, new Writer(Ids::WARPED_FENCE_GATE)));
		$this->map(Blocks::WARPED_HYPHAE(), fn(Wood $block) => Helper::encodeNewLog($block, Ids::WARPED_HYPHAE, Ids::STRIPPED_WARPED_HYPHAE));
		$this->mapSimple(Blocks::WARPED_PLANKS(), Ids::WARPED_PLANKS);
		$this->map(Blocks::WARPED_PRESSURE_PLATE(), fn(SimplePressurePlate $block) => Helper::encodeSimplePressurePlate($block, new Writer(Ids::WARPED_PRESSURE_PLATE)));
		$this->map(Blocks::WARPED_SIGN(), fn(FloorSign $block) => Helper::encodeFloorSign($block, new Writer(Ids::WARPED_STANDING_SIGN)));
		$this->mapSlab(Blocks::WARPED_SLAB(), Ids::WARPED_SLAB, Ids::WARPED_DOUBLE_SLAB);
		$this->mapStairs(Blocks::WARPED_STAIRS(), Ids::WARPED_STAIRS);
		$this->map(Blocks::WARPED_STEM(), fn(Wood $block) => Helper::encodeNewLog($block, Ids::WARPED_STEM, Ids::STRIPPED_WARPED_STEM));
		$this->map(Blocks::WARPED_TRAPDOOR(), fn(Trapdoor $block) => Helper::encodeTrapdoor($block, new Writer(Ids::WARPED_TRAPDOOR)));
		$this->map(Blocks::WARPED_WALL_SIGN(), fn(WallSign $block) => Helper::encodeWallSign($block, new Writer(Ids::WARPED_WALL_SIGN)));
		$this->map(Blocks::WATER(), fn(Water $block) => Helper::encodeLiquid($block, Ids::WATER, Ids::FLOWING_WATER));
		$this->map(Blocks::WEIGHTED_PRESSURE_PLATE_HEAVY(), function(WeightedPressurePlateHeavy $block) : Writer{
			return Writer::create(Ids::HEAVY_WEIGHTED_PRESSURE_PLATE)
				->writeInt(StateNames::REDSTONE_SIGNAL, $block->getOutputSignalStrength());
		});
		$this->map(Blocks::WEIGHTED_PRESSURE_PLATE_LIGHT(), function(WeightedPressurePlateLight $block) : Writer{
			return Writer::create(Ids::LIGHT_WEIGHTED_PRESSURE_PLATE)
				->writeInt(StateNames::REDSTONE_SIGNAL, $block->getOutputSignalStrength());
		});
		$this->map(Blocks::WHEAT(), fn(Wheat $block) => Helper::encodeCrops($block, new Writer(Ids::WHEAT)));
		$this->map(Blocks::WHITE_TULIP(), fn() => Helper::encodeRedFlower(StringValues::FLOWER_TYPE_TULIP_WHITE));
		$this->map(Blocks::WOOL(), function(Wool $block) : Writer{
			return Writer::create(Ids::WOOL)
				->writeColor($block->getColor());
		});
	}
}
