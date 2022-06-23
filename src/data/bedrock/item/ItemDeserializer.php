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

namespace pocketmine\data\bedrock\item;

use pocketmine\block\BlockFactory;
use pocketmine\block\utils\DyeColor;
use pocketmine\block\utils\SkullType;
use pocketmine\block\utils\TreeType;
use pocketmine\block\VanillaBlocks as Blocks;
use pocketmine\data\bedrock\block\BlockStateDeserializeException;
use pocketmine\data\bedrock\block\BlockStateDeserializer;
use pocketmine\data\bedrock\CompoundTypeIds;
use pocketmine\data\bedrock\DyeColorIdMap;
use pocketmine\data\bedrock\EntityLegacyIds;
use pocketmine\data\bedrock\item\ItemTypeIds as Ids;
use pocketmine\data\bedrock\item\SavedItemData as Data;
use pocketmine\data\bedrock\PotionTypeIdMap;
use pocketmine\item\Item;
use pocketmine\item\PotionType;
use pocketmine\item\VanillaItems as Items;
use pocketmine\utils\AssumptionFailedError;

final class ItemDeserializer{
	/**
	 * @var \Closure[]
	 * @phpstan-var array<string, \Closure(Data) : Item>
	 */
	private array $deserializers = [];

	public function __construct(
		private BlockStateDeserializer $blockStateDeserializer
	){
		$this->registerDeserializers();
	}

	/**
	 * @phpstan-param \Closure(Data) : Item $deserializer
	 */
	public function map(string $id, \Closure $deserializer) : void{
		$this->deserializers[$id] = $deserializer;
	}

	/**
	 * @throws ItemTypeDeserializeException
	 */
	public function deserialize(Data $data) : Item{
		if(($blockData = $data->getBlock()) !== null){
			//TODO: this is rough duct tape; we need a better way to deal with this
			try{
				$block = $this->blockStateDeserializer->deserialize($blockData);
			}catch(BlockStateDeserializeException $e){
				throw new ItemTypeDeserializeException("Failed to deserialize item data: " . $e->getMessage(), 0, $e);
			}

			//TODO: worth caching this or not?
			return BlockFactory::getInstance()->fromFullBlock($block)->asItem();
		}
		$id = $data->getName();
		if(!isset($this->deserializers[$id])){
			throw new ItemTypeDeserializeException("No deserializer found for ID $id");
		}

		return ($this->deserializers[$id])($data);
	}

	private function registerDeserializers() : void{
		$this->map(Ids::ACACIA_BOAT, fn() => Items::ACACIA_BOAT());
		$this->map(Ids::ACACIA_DOOR, fn() => Blocks::ACACIA_DOOR()->asItem());
		$this->map(Ids::ACACIA_SIGN, fn() => Blocks::ACACIA_SIGN()->asItem());
		//TODO: minecraft:agent_spawn_egg
		//TODO: minecraft:allay_spawn_egg
		//TODO: minecraft:amethyst_shard
		$this->map(Ids::APPLE, fn() => Items::APPLE());
		//TODO: minecraft:armor_stand
		$this->map(Ids::ARROW, function(Data $data) : Item{
			if($data->getMeta() === 0){
				return Items::ARROW();
			}
			throw new ItemTypeDeserializeException("Tipped arrows are not implemented yet");
		});
		//TODO: minecraft:axolotl_bucket
		//TODO: minecraft:axolotl_spawn_egg
		$this->map(Ids::BAKED_POTATO, fn() => Items::BAKED_POTATO());
		//TODO: minecraft:balloon
		$this->map(Ids::BANNER, function(Data $data) : Item{
			$meta = $data->getMeta();
			$color = DyeColorIdMap::getInstance()->fromInvertedId($meta);
			if($color === null){
				throw new ItemTypeDeserializeException("Unknown banner meta $meta");
			}
			return Items::BANNER()->setColor($color);
		});
		//TODO: minecraft:banner_pattern
		//TODO: minecraft:bat_spawn_egg
		$this->map(Ids::BED, function(Data $data) : Item{
			$meta = $data->getMeta();
			$color = DyeColorIdMap::getInstance()->fromId($meta);
			if($color === null){
				throw new ItemTypeDeserializeException("Unknown bed meta $meta");
			}
			return Blocks::BED()->setColor($color)->asItem();
		});
		//TODO: minecraft:bee_spawn_egg
		$this->map(Ids::BEEF, fn() => Items::RAW_BEEF());
		$this->map(Ids::BEETROOT, fn() => Items::BEETROOT());
		$this->map(Ids::BEETROOT_SEEDS, fn() => Items::BEETROOT_SEEDS());
		$this->map(Ids::BEETROOT_SOUP, fn() => Items::BEETROOT_SOUP());
		$this->map(Ids::BIRCH_BOAT, fn() => Items::BIRCH_BOAT());
		$this->map(Ids::BIRCH_DOOR, fn() => Blocks::BIRCH_DOOR()->asItem());
		$this->map(Ids::BIRCH_SIGN, fn() => Blocks::BIRCH_SIGN()->asItem());
		$this->map(Ids::BLACK_DYE, fn() => Items::BLACK_DYE());
		$this->map(Ids::BLAZE_POWDER, fn() => Items::BLAZE_POWDER());
		$this->map(Ids::BLAZE_ROD, fn() => Items::BLAZE_ROD());
		//TODO: minecraft:blaze_spawn_egg
		$this->map(Ids::BLEACH, fn() => Items::BLEACH());
		$this->map(Ids::BLUE_DYE, fn() => Items::BLUE_DYE());
		$this->map(Ids::BOAT, function(Data $data) : Item{
			try{
				$treeType = TreeType::fromMagicNumber($data->getMeta());
			}catch(\InvalidArgumentException $e){
				throw new ItemTypeDeserializeException($e->getMessage(), 0, $e);
			}
			return match($treeType->id()){
				TreeType::OAK()->id() => Items::OAK_BOAT(),
				TreeType::SPRUCE()->id() => Items::SPRUCE_BOAT(),
				TreeType::BIRCH()->id() => Items::BIRCH_BOAT(),
				TreeType::JUNGLE()->id() => Items::JUNGLE_BOAT(),
				TreeType::ACACIA()->id() => Items::ACACIA_BOAT(),
				TreeType::DARK_OAK()->id() => Items::DARK_OAK_BOAT(),
				default => throw new AssumptionFailedError("Unexpected tree type " . $treeType->name())
			};
		});
		$this->map(Ids::BONE, fn() => Items::BONE());
		$this->map(Ids::BONE_MEAL, fn() => Items::BONE_MEAL());
		$this->map(Ids::BOOK, fn() => Items::BOOK());
		//TODO: minecraft:bordure_indented_banner_pattern
		$this->map(Ids::BOW, fn() => Items::BOW());
		$this->map(Ids::BOWL, fn() => Items::BOWL());
		$this->map(Ids::BREAD, fn() => Items::BREAD());
		$this->map(Ids::BREWING_STAND, fn() => Blocks::BREWING_STAND()->asItem());
		$this->map(Ids::BRICK, fn() => Items::BRICK());
		$this->map(Ids::BROWN_DYE, fn() => Items::BROWN_DYE());
		$this->map(Ids::BUCKET, fn() => Items::BUCKET());
		$this->map(Ids::CAKE, fn() => Blocks::CAKE()->asItem());
		//TODO: minecraft:camera
		//TODO: minecraft:campfire
		$this->map(Ids::CARROT, fn() => Items::CARROT());
		//TODO: minecraft:carrot_on_a_stick
		//TODO: minecraft:cat_spawn_egg
		//TODO: minecraft:cauldron
		//TODO: minecraft:cave_spider_spawn_egg
		//TODO: minecraft:chain
		$this->map(Ids::CHAINMAIL_BOOTS, fn() => Items::CHAINMAIL_BOOTS());
		$this->map(Ids::CHAINMAIL_CHESTPLATE, fn() => Items::CHAINMAIL_CHESTPLATE());
		$this->map(Ids::CHAINMAIL_HELMET, fn() => Items::CHAINMAIL_HELMET());
		$this->map(Ids::CHAINMAIL_LEGGINGS, fn() => Items::CHAINMAIL_LEGGINGS());
		$this->map(Ids::CHARCOAL, fn() => Items::CHARCOAL());
		//TODO: minecraft:chest_minecart
		$this->map(Ids::CHICKEN, fn() => Items::RAW_CHICKEN());
		//TODO: minecraft:chicken_spawn_egg
		$this->map(Ids::CHORUS_FRUIT, fn() => Items::CHORUS_FRUIT());
		$this->map(Ids::CLAY_BALL, fn() => Items::CLAY());
		$this->map(Ids::CLOCK, fn() => Items::CLOCK());
		$this->map(Ids::COAL, fn() => Items::COAL());
		$this->map(Ids::COCOA_BEANS, fn() => Items::COCOA_BEANS());
		$this->map(Ids::COD, fn() => Items::RAW_FISH());
		//TODO: minecraft:cod_bucket
		//TODO: minecraft:cod_spawn_egg
		//TODO: minecraft:command_block_minecart
		$this->map(Ids::COMPARATOR, fn() => Blocks::REDSTONE_COMPARATOR()->asItem());
		$this->map(Ids::COMPASS, fn() => Items::COMPASS());
		$this->map(Ids::COMPOUND, fn(Data $data) => match($data->getMeta()){
			CompoundTypeIds::SALT => Items::CHEMICAL_SALT(),
			CompoundTypeIds::SODIUM_OXIDE => Items::CHEMICAL_SODIUM_OXIDE(),
			CompoundTypeIds::SODIUM_HYDROXIDE => Items::CHEMICAL_SODIUM_HYDROXIDE(),
			CompoundTypeIds::MAGNESIUM_NITRATE => Items::CHEMICAL_MAGNESIUM_NITRATE(),
			CompoundTypeIds::IRON_SULPHIDE => Items::CHEMICAL_IRON_SULPHIDE(),
			CompoundTypeIds::LITHIUM_HYDRIDE => Items::CHEMICAL_LITHIUM_HYDRIDE(),
			CompoundTypeIds::SODIUM_HYDRIDE => Items::CHEMICAL_SODIUM_HYDRIDE(),
			CompoundTypeIds::CALCIUM_BROMIDE => Items::CHEMICAL_CALCIUM_BROMIDE(),
			CompoundTypeIds::MAGNESIUM_OXIDE => Items::CHEMICAL_MAGNESIUM_OXIDE(),
			CompoundTypeIds::SODIUM_ACETATE => Items::CHEMICAL_SODIUM_ACETATE(),
			CompoundTypeIds::LUMINOL => Items::CHEMICAL_LUMINOL(),
			CompoundTypeIds::CHARCOAL => Items::CHEMICAL_CHARCOAL(),
			CompoundTypeIds::SUGAR => Items::CHEMICAL_SUGAR(),
			CompoundTypeIds::ALUMINIUM_OXIDE => Items::CHEMICAL_ALUMINIUM_OXIDE(),
			CompoundTypeIds::BORON_TRIOXIDE => Items::CHEMICAL_BORON_TRIOXIDE(),
			CompoundTypeIds::SOAP => Items::CHEMICAL_SOAP(),
			CompoundTypeIds::POLYETHYLENE => Items::CHEMICAL_POLYETHYLENE(),
			CompoundTypeIds::RUBBISH => Items::CHEMICAL_RUBBISH(),
			CompoundTypeIds::MAGNESIUM_SALTS => Items::CHEMICAL_MAGNESIUM_SALTS(),
			CompoundTypeIds::SULPHATE => Items::CHEMICAL_SULPHATE(),
			CompoundTypeIds::BARIUM_SULPHATE => Items::CHEMICAL_BARIUM_SULPHATE(),
			CompoundTypeIds::POTASSIUM_CHLORIDE => Items::CHEMICAL_POTASSIUM_CHLORIDE(),
			CompoundTypeIds::MERCURIC_CHLORIDE => Items::CHEMICAL_MERCURIC_CHLORIDE(),
			CompoundTypeIds::CERIUM_CHLORIDE => Items::CHEMICAL_CERIUM_CHLORIDE(),
			CompoundTypeIds::TUNGSTEN_CHLORIDE => Items::CHEMICAL_TUNGSTEN_CHLORIDE(),
			CompoundTypeIds::CALCIUM_CHLORIDE => Items::CHEMICAL_CALCIUM_CHLORIDE(),
			CompoundTypeIds::WATER => Items::CHEMICAL_WATER(),
			CompoundTypeIds::GLUE => Items::CHEMICAL_GLUE(),
			CompoundTypeIds::HYPOCHLORITE => Items::CHEMICAL_HYPOCHLORITE(),
			CompoundTypeIds::CRUDE_OIL => Items::CHEMICAL_CRUDE_OIL(),
			CompoundTypeIds::LATEX => Items::CHEMICAL_LATEX(),
			CompoundTypeIds::POTASSIUM_IODIDE => Items::CHEMICAL_POTASSIUM_IODIDE(),
			CompoundTypeIds::SODIUM_FLUORIDE => Items::CHEMICAL_SODIUM_FLUORIDE(),
			CompoundTypeIds::BENZENE => Items::CHEMICAL_BENZENE(),
			CompoundTypeIds::INK => Items::CHEMICAL_INK(),
			CompoundTypeIds::HYDROGEN_PEROXIDE => Items::CHEMICAL_HYDROGEN_PEROXIDE(),
			CompoundTypeIds::AMMONIA => Items::CHEMICAL_AMMONIA(),
			CompoundTypeIds::SODIUM_HYPOCHLORITE => Items::CHEMICAL_SODIUM_HYPOCHLORITE(),
			default => throw new ItemTypeDeserializeException("Unknown chemical meta " . $data->getMeta())
		});
		$this->map(Ids::COOKED_BEEF, fn() => Items::STEAK());
		$this->map(Ids::COOKED_CHICKEN, fn() => Items::COOKED_CHICKEN());
		$this->map(Ids::COOKED_COD, fn() => Items::COOKED_FISH());
		$this->map(Ids::COOKED_MUTTON, fn() => Items::COOKED_MUTTON());
		$this->map(Ids::COOKED_PORKCHOP, fn() => Items::COOKED_PORKCHOP());
		$this->map(Ids::COOKED_RABBIT, fn() => Items::COOKED_RABBIT());
		$this->map(Ids::COOKED_SALMON, fn() => Items::COOKED_SALMON());
		$this->map(Ids::COOKIE, fn() => Items::COOKIE());
		//TODO: minecraft:copper_ingot
		//TODO: minecraft:cow_spawn_egg
		//TODO: minecraft:creeper_banner_pattern
		//TODO: minecraft:creeper_spawn_egg
		//TODO: minecraft:crimson_door
		//TODO: minecraft:crimson_sign
		//TODO: minecraft:crossbow
		$this->map(Ids::CYAN_DYE, fn() => Items::CYAN_DYE());
		$this->map(Ids::DARK_OAK_BOAT, fn() => Items::DARK_OAK_BOAT());
		$this->map(Ids::DARK_OAK_DOOR, fn() => Blocks::DARK_OAK_DOOR()->asItem());
		$this->map(Ids::DARK_OAK_SIGN, fn() => Blocks::DARK_OAK_SIGN()->asItem());
		$this->map(Ids::DIAMOND, fn() => Items::DIAMOND());
		$this->map(Ids::DIAMOND_AXE, fn() => Items::DIAMOND_AXE());
		$this->map(Ids::DIAMOND_BOOTS, fn() => Items::DIAMOND_BOOTS());
		$this->map(Ids::DIAMOND_CHESTPLATE, fn() => Items::DIAMOND_CHESTPLATE());
		$this->map(Ids::DIAMOND_HELMET, fn() => Items::DIAMOND_HELMET());
		$this->map(Ids::DIAMOND_HOE, fn() => Items::DIAMOND_HOE());
		//TODO: minecraft:diamond_horse_armor
		$this->map(Ids::DIAMOND_LEGGINGS, fn() => Items::DIAMOND_LEGGINGS());
		$this->map(Ids::DIAMOND_PICKAXE, fn() => Items::DIAMOND_PICKAXE());
		$this->map(Ids::DIAMOND_SHOVEL, fn() => Items::DIAMOND_SHOVEL());
		$this->map(Ids::DIAMOND_SWORD, fn() => Items::DIAMOND_SWORD());
		//TODO: minecraft:dolphin_spawn_egg
		//TODO: minecraft:donkey_spawn_egg
		$this->map(Ids::DRAGON_BREATH, fn() => Items::DRAGON_BREATH());
		$this->map(Ids::DRIED_KELP, fn() => Items::DRIED_KELP());
		//TODO: minecraft:drowned_spawn_egg
		$this->map(Ids::DYE, function(Data $data) : Item{
			$meta = $data->getMeta();
			$item = match($meta) {
				0 => Items::INK_SAC(),
				3 => Items::COCOA_BEANS(),
				4 => Items::LAPIS_LAZULI(),
				15 => Items::BONE_MEAL(),
				16 => Items::BLACK_DYE(),
				17 => Items::BROWN_DYE(),
				18 => Items::BLUE_DYE(),
				19 => Items::WHITE_DYE(),
				default => null
			};
			if($item !== null){
				return $item;
			}
			$dyeColor = DyeColorIdMap::getInstance()->fromInvertedId($meta);
			if($dyeColor === null){
				throw new ItemTypeDeserializeException("Unknown dye meta $meta");
			}
			return match($dyeColor->id()){
				DyeColor::CYAN()->id() => Items::CYAN_DYE(),
				DyeColor::GRAY()->id() => Items::GRAY_DYE(),
				DyeColor::GREEN()->id() => Items::GREEN_DYE(),
				DyeColor::LIGHT_BLUE()->id() => Items::LIGHT_BLUE_DYE(),
				DyeColor::LIGHT_GRAY()->id() => Items::LIGHT_GRAY_DYE(),
				DyeColor::LIME()->id() => Items::LIME_DYE(),
				DyeColor::MAGENTA()->id() => Items::MAGENTA_DYE(),
				DyeColor::ORANGE()->id() => Items::ORANGE_DYE(),
				DyeColor::PINK()->id() => Items::PINK_DYE(),
				DyeColor::PURPLE()->id() => Items::PURPLE_DYE(),
				DyeColor::RED()->id() => Items::RED_DYE(),
				DyeColor::YELLOW()->id() => Items::YELLOW_DYE(),
				default => throw new AssumptionFailedError("Unhandled dye color " . $dyeColor->name())
			};
		});
		$this->map(Ids::EGG, fn() => Items::EGG());
		//TODO: minecraft:elder_guardian_spawn_egg
		//TODO: minecraft:elytra
		$this->map(Ids::EMERALD, fn() => Items::EMERALD());
		//TODO: minecraft:empty_map
		//TODO: minecraft:enchanted_book
		$this->map(Ids::ENCHANTED_GOLDEN_APPLE, fn() => Items::ENCHANTED_GOLDEN_APPLE());
		//TODO: minecraft:end_crystal
		//TODO: minecraft:ender_eye
		$this->map(Ids::ENDER_PEARL, fn() => Items::ENDER_PEARL());
		//TODO: minecraft:enderman_spawn_egg
		//TODO: minecraft:endermite_spawn_egg
		//TODO: minecraft:evoker_spawn_egg
		$this->map(Ids::EXPERIENCE_BOTTLE, fn() => Items::EXPERIENCE_BOTTLE());
		$this->map(Ids::FEATHER, fn() => Items::FEATHER());
		$this->map(Ids::FERMENTED_SPIDER_EYE, fn() => Items::FERMENTED_SPIDER_EYE());
		//TODO: minecraft:field_masoned_banner_pattern
		//TODO: minecraft:filled_map
		//TODO: minecraft:fire_charge
		//TODO: minecraft:firefly_spawn_egg
		//TODO: minecraft:firework_rocket
		//TODO: minecraft:firework_star
		$this->map(Ids::FISHING_ROD, fn() => Items::FISHING_ROD());
		$this->map(Ids::FLINT, fn() => Items::FLINT());
		$this->map(Ids::FLINT_AND_STEEL, fn() => Items::FLINT_AND_STEEL());
		//TODO: minecraft:flower_banner_pattern
		$this->map(Ids::FLOWER_POT, fn() => Blocks::FLOWER_POT()->asItem());
		//TODO: minecraft:fox_spawn_egg
		$this->map(Ids::FRAME, fn() => Blocks::ITEM_FRAME()->asItem());
		//TODO: minecraft:frog_spawn_egg
		//TODO: minecraft:ghast_spawn_egg
		$this->map(Ids::GHAST_TEAR, fn() => Items::GHAST_TEAR());
		$this->map(Ids::GLASS_BOTTLE, fn() => Items::GLASS_BOTTLE());
		$this->map(Ids::GLISTERING_MELON_SLICE, fn() => Items::GLISTERING_MELON());
		//TODO: minecraft:globe_banner_pattern
		//TODO: minecraft:glow_berries
		//TODO: minecraft:glow_frame
		//TODO: minecraft:glow_ink_sac
		//TODO: minecraft:glow_squid_spawn_egg
		//TODO: minecraft:glow_stick
		$this->map(Ids::GLOWSTONE_DUST, fn() => Items::GLOWSTONE_DUST());
		//TODO: minecraft:goat_horn
		//TODO: minecraft:goat_spawn_egg
		$this->map(Ids::GOLD_INGOT, fn() => Items::GOLD_INGOT());
		$this->map(Ids::GOLD_NUGGET, fn() => Items::GOLD_NUGGET());
		$this->map(Ids::GOLDEN_APPLE, fn() => Items::GOLDEN_APPLE());
		$this->map(Ids::GOLDEN_AXE, fn() => Items::GOLDEN_AXE());
		$this->map(Ids::GOLDEN_BOOTS, fn() => Items::GOLDEN_BOOTS());
		$this->map(Ids::GOLDEN_CARROT, fn() => Items::GOLDEN_CARROT());
		$this->map(Ids::GOLDEN_CHESTPLATE, fn() => Items::GOLDEN_CHESTPLATE());
		$this->map(Ids::GOLDEN_HELMET, fn() => Items::GOLDEN_HELMET());
		$this->map(Ids::GOLDEN_HOE, fn() => Items::GOLDEN_HOE());
		//TODO: minecraft:golden_horse_armor
		$this->map(Ids::GOLDEN_LEGGINGS, fn() => Items::GOLDEN_LEGGINGS());
		$this->map(Ids::GOLDEN_PICKAXE, fn() => Items::GOLDEN_PICKAXE());
		$this->map(Ids::GOLDEN_SHOVEL, fn() => Items::GOLDEN_SHOVEL());
		$this->map(Ids::GOLDEN_SWORD, fn() => Items::GOLDEN_SWORD());
		$this->map(Ids::GRAY_DYE, fn() => Items::GRAY_DYE());
		$this->map(Ids::GREEN_DYE, fn() => Items::GREEN_DYE());
		//TODO: minecraft:guardian_spawn_egg
		$this->map(Ids::GUNPOWDER, fn() => Items::GUNPOWDER());
		$this->map(Ids::HEART_OF_THE_SEA, fn() => Items::HEART_OF_THE_SEA());
		//TODO: minecraft:hoglin_spawn_egg
		//TODO: minecraft:honey_bottle
		//TODO: minecraft:honeycomb
		$this->map(Ids::HOPPER, fn() => Blocks::HOPPER()->asItem());
		//TODO: minecraft:hopper_minecart
		//TODO: minecraft:horse_spawn_egg
		//TODO: minecraft:husk_spawn_egg
		//TODO: minecraft:ice_bomb
		$this->map(Ids::INK_SAC, fn() => Items::INK_SAC());
		$this->map(Ids::IRON_AXE, fn() => Items::IRON_AXE());
		$this->map(Ids::IRON_BOOTS, fn() => Items::IRON_BOOTS());
		$this->map(Ids::IRON_CHESTPLATE, fn() => Items::IRON_CHESTPLATE());
		$this->map(Ids::IRON_DOOR, fn() => Blocks::IRON_DOOR()->asItem());
		$this->map(Ids::IRON_HELMET, fn() => Items::IRON_HELMET());
		$this->map(Ids::IRON_HOE, fn() => Items::IRON_HOE());
		//TODO: minecraft:iron_horse_armor
		$this->map(Ids::IRON_INGOT, fn() => Items::IRON_INGOT());
		$this->map(Ids::IRON_LEGGINGS, fn() => Items::IRON_LEGGINGS());
		$this->map(Ids::IRON_NUGGET, fn() => Items::IRON_NUGGET());
		$this->map(Ids::IRON_PICKAXE, fn() => Items::IRON_PICKAXE());
		$this->map(Ids::IRON_SHOVEL, fn() => Items::IRON_SHOVEL());
		$this->map(Ids::IRON_SWORD, fn() => Items::IRON_SWORD());
		$this->map(Ids::JUNGLE_BOAT, fn() => Items::JUNGLE_BOAT());
		$this->map(Ids::JUNGLE_DOOR, fn() => Blocks::JUNGLE_DOOR()->asItem());
		$this->map(Ids::JUNGLE_SIGN, fn() => Blocks::JUNGLE_SIGN()->asItem());
		//TODO: minecraft:kelp
		$this->map(Ids::LAPIS_LAZULI, fn() => Items::LAPIS_LAZULI());
		$this->map(Ids::LAVA_BUCKET, fn() => Items::LAVA_BUCKET());
		//TODO: minecraft:lead
		$this->map(Ids::LEATHER, fn() => Items::LEATHER());
		$this->map(Ids::LEATHER_BOOTS, fn() => Items::LEATHER_BOOTS());
		$this->map(Ids::LEATHER_CHESTPLATE, fn() => Items::LEATHER_TUNIC());
		$this->map(Ids::LEATHER_HELMET, fn() => Items::LEATHER_CAP());
		//TODO: minecraft:leather_horse_armor
		$this->map(Ids::LEATHER_LEGGINGS, fn() => Items::LEATHER_PANTS());
		$this->map(Ids::LIGHT_BLUE_DYE, fn() => Items::LIGHT_BLUE_DYE());
		$this->map(Ids::LIGHT_GRAY_DYE, fn() => Items::LIGHT_GRAY_DYE());
		$this->map(Ids::LIME_DYE, fn() => Items::LIME_DYE());
		//TODO: minecraft:lingering_potion
		//TODO: minecraft:llama_spawn_egg
		//TODO: minecraft:lodestone_compass
		$this->map(Ids::MAGENTA_DYE, fn() => Items::MAGENTA_DYE());
		$this->map(Ids::MAGMA_CREAM, fn() => Items::MAGMA_CREAM());
		//TODO: minecraft:magma_cube_spawn_egg
		//TODO: minecraft:medicine
		$this->map(Ids::MELON_SEEDS, fn() => Items::MELON_SEEDS());
		$this->map(Ids::MELON_SLICE, fn() => Items::MELON());
		$this->map(Ids::MILK_BUCKET, fn() => Items::MILK_BUCKET());
		$this->map(Ids::MINECART, fn() => Items::MINECART());
		//TODO: minecraft:mojang_banner_pattern
		//TODO: minecraft:mooshroom_spawn_egg
		//TODO: minecraft:mule_spawn_egg
		$this->map(Ids::MUSHROOM_STEW, fn() => Items::MUSHROOM_STEW());
		$this->map(Ids::MUSIC_DISC_11, fn() => Items::RECORD_11());
		$this->map(Ids::MUSIC_DISC_13, fn() => Items::RECORD_13());
		$this->map(Ids::MUSIC_DISC_BLOCKS, fn() => Items::RECORD_BLOCKS());
		$this->map(Ids::MUSIC_DISC_CAT, fn() => Items::RECORD_CAT());
		$this->map(Ids::MUSIC_DISC_CHIRP, fn() => Items::RECORD_CHIRP());
		$this->map(Ids::MUSIC_DISC_FAR, fn() => Items::RECORD_FAR());
		$this->map(Ids::MUSIC_DISC_MALL, fn() => Items::RECORD_MALL());
		$this->map(Ids::MUSIC_DISC_MELLOHI, fn() => Items::RECORD_MELLOHI());
		//TODO: minecraft:music_disc_otherside
		//TODO: minecraft:music_disc_pigstep
		$this->map(Ids::MUSIC_DISC_STAL, fn() => Items::RECORD_STAL());
		$this->map(Ids::MUSIC_DISC_STRAD, fn() => Items::RECORD_STRAD());
		$this->map(Ids::MUSIC_DISC_WAIT, fn() => Items::RECORD_WAIT());
		$this->map(Ids::MUSIC_DISC_WARD, fn() => Items::RECORD_WARD());
		$this->map(Ids::MUTTON, fn() => Items::RAW_MUTTON());
		//TODO: minecraft:name_tag
		$this->map(Ids::NAUTILUS_SHELL, fn() => Items::NAUTILUS_SHELL());
		//TODO: minecraft:nether_sprouts
		$this->map(Ids::NETHER_STAR, fn() => Items::NETHER_STAR());
		$this->map(Ids::NETHER_WART, fn() => Blocks::NETHER_WART()->asItem());
		$this->map(Ids::NETHERBRICK, fn() => Items::NETHER_BRICK());
		//TODO: minecraft:netherite_axe
		//TODO: minecraft:netherite_boots
		//TODO: minecraft:netherite_chestplate
		//TODO: minecraft:netherite_helmet
		//TODO: minecraft:netherite_hoe
		//TODO: minecraft:netherite_ingot
		//TODO: minecraft:netherite_leggings
		//TODO: minecraft:netherite_pickaxe
		//TODO: minecraft:netherite_scrap
		//TODO: minecraft:netherite_shovel
		//TODO: minecraft:netherite_sword
		//TODO: minecraft:npc_spawn_egg
		$this->map(Ids::OAK_BOAT, fn() => Items::OAK_BOAT());
		$this->map(Ids::OAK_SIGN, fn() => Blocks::OAK_SIGN()->asItem());
		//TODO: minecraft:ocelot_spawn_egg
		$this->map(Ids::ORANGE_DYE, fn() => Items::ORANGE_DYE());
		$this->map(Ids::PAINTING, fn() => Items::PAINTING());
		//TODO: minecraft:panda_spawn_egg
		$this->map(Ids::PAPER, fn() => Items::PAPER());
		//TODO: minecraft:parrot_spawn_egg
		//TODO: minecraft:phantom_membrane
		//TODO: minecraft:phantom_spawn_egg
		//TODO: minecraft:pig_spawn_egg
		//TODO: minecraft:piglin_banner_pattern
		//TODO: minecraft:piglin_brute_spawn_egg
		//TODO: minecraft:piglin_spawn_egg
		//TODO: minecraft:pillager_spawn_egg
		$this->map(Ids::PINK_DYE, fn() => Items::PINK_DYE());
		$this->map(Ids::POISONOUS_POTATO, fn() => Items::POISONOUS_POTATO());
		//TODO: minecraft:polar_bear_spawn_egg
		$this->map(Ids::POPPED_CHORUS_FRUIT, fn() => Items::POPPED_CHORUS_FRUIT());
		$this->map(Ids::PORKCHOP, fn() => Items::RAW_PORKCHOP());
		$this->map(Ids::POTATO, fn() => Items::POTATO());
		$this->map(Ids::POTION, function(Data $data) : Item{
			$meta = $data->getMeta();
			$potionType = PotionTypeIdMap::getInstance()->fromId($meta);
			if($potionType === null){
				throw new ItemTypeDeserializeException("Unknown potion type ID $meta");
			}
			return match($potionType->id()){
				PotionType::WATER()->id() => Items::WATER_POTION(),
				PotionType::MUNDANE()->id() => Items::MUNDANE_POTION(),
				PotionType::LONG_MUNDANE()->id() => Items::LONG_MUNDANE_POTION(),
				PotionType::THICK()->id() => Items::THICK_POTION(),
				PotionType::AWKWARD()->id() => Items::AWKWARD_POTION(),
				PotionType::NIGHT_VISION()->id() => Items::NIGHT_VISION_POTION(),
				PotionType::LONG_NIGHT_VISION()->id() => Items::LONG_NIGHT_VISION_POTION(),
				PotionType::INVISIBILITY()->id() => Items::INVISIBILITY_POTION(),
				PotionType::LONG_INVISIBILITY()->id() => Items::LONG_INVISIBILITY_POTION(),
				PotionType::LEAPING()->id() => Items::LEAPING_POTION(),
				PotionType::LONG_LEAPING()->id() => Items::LONG_LEAPING_POTION(),
				PotionType::STRONG_LEAPING()->id() => Items::STRONG_LEAPING_POTION(),
				PotionType::FIRE_RESISTANCE()->id() => Items::FIRE_RESISTANCE_POTION(),
				PotionType::LONG_FIRE_RESISTANCE()->id() => Items::LONG_FIRE_RESISTANCE_POTION(),
				PotionType::SWIFTNESS()->id() => Items::SWIFTNESS_POTION(),
				PotionType::LONG_SWIFTNESS()->id() => Items::LONG_SWIFTNESS_POTION(),
				PotionType::STRONG_SWIFTNESS()->id() => Items::STRONG_SWIFTNESS_POTION(),
				PotionType::SLOWNESS()->id() => Items::SLOWNESS_POTION(),
				PotionType::LONG_SLOWNESS()->id() => Items::LONG_SLOWNESS_POTION(),
				PotionType::WATER_BREATHING()->id() => Items::WATER_BREATHING_POTION(),
				PotionType::LONG_WATER_BREATHING()->id() => Items::LONG_WATER_BREATHING_POTION(),
				PotionType::HEALING()->id() => Items::HEALING_POTION(),
				PotionType::STRONG_HEALING()->id() => Items::STRONG_HEALING_POTION(),
				PotionType::HARMING()->id() => Items::HARMING_POTION(),
				PotionType::STRONG_HARMING()->id() => Items::STRONG_HARMING_POTION(),
				PotionType::POISON()->id() => Items::POISON_POTION(),
				PotionType::LONG_POISON()->id() => Items::LONG_POISON_POTION(),
				PotionType::STRONG_POISON()->id() => Items::STRONG_POISON_POTION(),
				PotionType::REGENERATION()->id() => Items::REGENERATION_POTION(),
				PotionType::LONG_REGENERATION()->id() => Items::LONG_REGENERATION_POTION(),
				PotionType::STRONG_REGENERATION()->id() => Items::STRONG_REGENERATION_POTION(),
				PotionType::STRENGTH()->id() => Items::STRENGTH_POTION(),
				PotionType::LONG_STRENGTH()->id() => Items::LONG_STRENGTH_POTION(),
				PotionType::STRONG_STRENGTH()->id() => Items::STRONG_STRENGTH_POTION(),
				PotionType::WEAKNESS()->id() => Items::WEAKNESS_POTION(),
				PotionType::LONG_WEAKNESS()->id() => Items::LONG_WEAKNESS_POTION(),
				PotionType::WITHER()->id() => Items::WITHER_POTION(),
				PotionType::TURTLE_MASTER()->id() => Items::TURTLE_MASTER_POTION(),
				PotionType::LONG_TURTLE_MASTER()->id() => Items::LONG_TURTLE_MASTER_POTION(),
				PotionType::STRONG_TURTLE_MASTER()->id() => Items::STRONG_TURTLE_MASTER_POTION(),
				PotionType::SLOW_FALLING()->id() => Items::SLOW_FALLING_POTION(),
				PotionType::LONG_SLOW_FALLING()->id() => Items::LONG_SLOW_FALLING_POTION(),
				default => throw new ItemTypeDeserializeException("Unhandled potion type " . $potionType->getDisplayName())
			};
		});
		//TODO: minecraft:powder_snow_bucket
		$this->map(Ids::PRISMARINE_CRYSTALS, fn() => Items::PRISMARINE_CRYSTALS());
		$this->map(Ids::PRISMARINE_SHARD, fn() => Items::PRISMARINE_SHARD());
		$this->map(Ids::PUFFERFISH, fn() => Items::PUFFERFISH());
		//TODO: minecraft:pufferfish_bucket
		//TODO: minecraft:pufferfish_spawn_egg
		$this->map(Ids::PUMPKIN_PIE, fn() => Items::PUMPKIN_PIE());
		$this->map(Ids::PUMPKIN_SEEDS, fn() => Items::PUMPKIN_SEEDS());
		$this->map(Ids::PURPLE_DYE, fn() => Items::PURPLE_DYE());
		$this->map(Ids::QUARTZ, fn() => Items::NETHER_QUARTZ());
		$this->map(Ids::RABBIT, fn() => Items::RAW_RABBIT());
		$this->map(Ids::RABBIT_FOOT, fn() => Items::RABBIT_FOOT());
		$this->map(Ids::RABBIT_HIDE, fn() => Items::RABBIT_HIDE());
		//TODO: minecraft:rabbit_spawn_egg
		$this->map(Ids::RABBIT_STEW, fn() => Items::RABBIT_STEW());
		//TODO: minecraft:rapid_fertilizer
		//TODO: minecraft:ravager_spawn_egg
		//TODO: minecraft:raw_copper
		//TODO: minecraft:raw_gold
		//TODO: minecraft:raw_iron
		$this->map(Ids::RED_DYE, fn() => Items::RED_DYE());
		$this->map(Ids::REDSTONE, fn() => Items::REDSTONE_DUST());
		$this->map(Ids::REPEATER, fn() => Blocks::REDSTONE_REPEATER()->asItem());
		$this->map(Ids::ROTTEN_FLESH, fn() => Items::ROTTEN_FLESH());
		//TODO: minecraft:saddle
		$this->map(Ids::SALMON, fn() => Items::RAW_SALMON());
		//TODO: minecraft:salmon_bucket
		//TODO: minecraft:salmon_spawn_egg
		$this->map(Ids::SCUTE, fn() => Items::SCUTE());
		$this->map(Ids::SHEARS, fn() => Items::SHEARS());
		//TODO: minecraft:sheep_spawn_egg
		//TODO: minecraft:shield
		$this->map(Ids::SHULKER_SHELL, fn() => Items::SHULKER_SHELL());
		//TODO: minecraft:shulker_spawn_egg
		//TODO: minecraft:silverfish_spawn_egg
		//TODO: minecraft:skeleton_horse_spawn_egg
		//TODO: minecraft:skeleton_spawn_egg
		$this->map(Ids::SKULL, function(Data $data) : Item{
			$meta = $data->getMeta();
			try{
				$skullType = SkullType::fromMagicNumber($meta);
			}catch(\InvalidArgumentException $e){
				throw new ItemTypeDeserializeException($e->getMessage(), 0, $e);
			}
			return match($skullType->id()) {
				SkullType::SKELETON()->id() => Items::SKELETON_SKULL(),
				SkullType::WITHER_SKELETON()->id() => Items::WITHER_SKELETON_SKULL(),
				SkullType::ZOMBIE()->id() => Items::ZOMBIE_HEAD(),
				SkullType::CREEPER()->id() => Items::CREEPER_HEAD(),
				SkullType::PLAYER()->id() => Items::PLAYER_HEAD(),
				SkullType::DRAGON()->id() => Items::DRAGON_HEAD(),
				default => throw new ItemTypeDeserializeException("Unexpected skull type " . $skullType->getDisplayName())
			};
		});
		//TODO: minecraft:skull_banner_pattern
		$this->map(Ids::SLIME_BALL, fn() => Items::SLIMEBALL());
		//TODO: minecraft:slime_spawn_egg
		$this->map(Ids::SNOWBALL, fn() => Items::SNOWBALL());
		//TODO: minecraft:soul_campfire
		//TODO: minecraft:sparkler
		$this->map(Ids::SPAWN_EGG, fn(Data $data) => match($data->getMeta()){
			EntityLegacyIds::ZOMBIE => Items::ZOMBIE_SPAWN_EGG(),
			EntityLegacyIds::SQUID => Items::SQUID_SPAWN_EGG(),
			EntityLegacyIds::VILLAGER => Items::VILLAGER_SPAWN_EGG(),
			default => throw new ItemTypeDeserializeException("Unhandled spawn egg meta " . $data->getMeta())
		});
		$this->map(Ids::SPIDER_EYE, fn() => Items::SPIDER_EYE());
		//TODO: minecraft:spider_spawn_egg
		$this->map(Ids::SPLASH_POTION, function(Data $data) : Item{
			$meta = $data->getMeta();
			$potionType = PotionTypeIdMap::getInstance()->fromId($meta);
			if($potionType === null){
				throw new ItemTypeDeserializeException("Unknown potion type ID $meta");
			}
			return match($potionType->id()){
				PotionType::WATER()->id() => Items::WATER_SPLASH_POTION(),
				PotionType::MUNDANE()->id() => Items::MUNDANE_SPLASH_POTION(),
				PotionType::LONG_MUNDANE()->id() => Items::LONG_MUNDANE_SPLASH_POTION(),
				PotionType::THICK()->id() => Items::THICK_SPLASH_POTION(),
				PotionType::AWKWARD()->id() => Items::AWKWARD_SPLASH_POTION(),
				PotionType::NIGHT_VISION()->id() => Items::NIGHT_VISION_SPLASH_POTION(),
				PotionType::LONG_NIGHT_VISION()->id() => Items::LONG_NIGHT_VISION_SPLASH_POTION(),
				PotionType::INVISIBILITY()->id() => Items::INVISIBILITY_SPLASH_POTION(),
				PotionType::LONG_INVISIBILITY()->id() => Items::LONG_INVISIBILITY_SPLASH_POTION(),
				PotionType::LEAPING()->id() => Items::LEAPING_SPLASH_POTION(),
				PotionType::LONG_LEAPING()->id() => Items::LONG_LEAPING_SPLASH_POTION(),
				PotionType::STRONG_LEAPING()->id() => Items::STRONG_LEAPING_SPLASH_POTION(),
				PotionType::FIRE_RESISTANCE()->id() => Items::FIRE_RESISTANCE_SPLASH_POTION(),
				PotionType::LONG_FIRE_RESISTANCE()->id() => Items::LONG_FIRE_RESISTANCE_SPLASH_POTION(),
				PotionType::SWIFTNESS()->id() => Items::SWIFTNESS_SPLASH_POTION(),
				PotionType::LONG_SWIFTNESS()->id() => Items::LONG_SWIFTNESS_SPLASH_POTION(),
				PotionType::STRONG_SWIFTNESS()->id() => Items::STRONG_SWIFTNESS_SPLASH_POTION(),
				PotionType::SLOWNESS()->id() => Items::SLOWNESS_SPLASH_POTION(),
				PotionType::LONG_SLOWNESS()->id() => Items::LONG_SLOWNESS_SPLASH_POTION(),
				PotionType::WATER_BREATHING()->id() => Items::WATER_BREATHING_SPLASH_POTION(),
				PotionType::LONG_WATER_BREATHING()->id() => Items::LONG_WATER_BREATHING_SPLASH_POTION(),
				PotionType::HEALING()->id() => Items::HEALING_SPLASH_POTION(),
				PotionType::STRONG_HEALING()->id() => Items::STRONG_HEALING_SPLASH_POTION(),
				PotionType::HARMING()->id() => Items::HARMING_SPLASH_POTION(),
				PotionType::STRONG_HARMING()->id() => Items::STRONG_HARMING_SPLASH_POTION(),
				PotionType::POISON()->id() => Items::POISON_SPLASH_POTION(),
				PotionType::LONG_POISON()->id() => Items::LONG_POISON_SPLASH_POTION(),
				PotionType::STRONG_POISON()->id() => Items::STRONG_POISON_SPLASH_POTION(),
				PotionType::REGENERATION()->id() => Items::REGENERATION_SPLASH_POTION(),
				PotionType::LONG_REGENERATION()->id() => Items::LONG_REGENERATION_SPLASH_POTION(),
				PotionType::STRONG_REGENERATION()->id() => Items::STRONG_REGENERATION_SPLASH_POTION(),
				PotionType::STRENGTH()->id() => Items::STRENGTH_SPLASH_POTION(),
				PotionType::LONG_STRENGTH()->id() => Items::LONG_STRENGTH_SPLASH_POTION(),
				PotionType::STRONG_STRENGTH()->id() => Items::STRONG_STRENGTH_SPLASH_POTION(),
				PotionType::WEAKNESS()->id() => Items::WEAKNESS_SPLASH_POTION(),
				PotionType::LONG_WEAKNESS()->id() => Items::LONG_WEAKNESS_SPLASH_POTION(),
				PotionType::WITHER()->id() => Items::WITHER_SPLASH_POTION(),
				PotionType::TURTLE_MASTER()->id() => Items::TURTLE_MASTER_SPLASH_POTION(),
				PotionType::LONG_TURTLE_MASTER()->id() => Items::LONG_TURTLE_MASTER_SPLASH_POTION(),
				PotionType::STRONG_TURTLE_MASTER()->id() => Items::STRONG_TURTLE_MASTER_SPLASH_POTION(),
				PotionType::SLOW_FALLING()->id() => Items::SLOW_FALLING_SPLASH_POTION(),
				PotionType::LONG_SLOW_FALLING()->id() => Items::LONG_SLOW_FALLING_SPLASH_POTION(),
				default => throw new ItemTypeDeserializeException("Unhandled potion type " . $potionType->getDisplayName())
			};
		});
		$this->map(Ids::SPRUCE_BOAT, fn() => Items::SPRUCE_BOAT());
		$this->map(Ids::SPRUCE_DOOR, fn() => Blocks::SPRUCE_DOOR()->asItem());
		$this->map(Ids::SPRUCE_SIGN, fn() => Blocks::SPRUCE_SIGN()->asItem());
		//TODO: minecraft:spyglass
		$this->map(Ids::SQUID_SPAWN_EGG, fn() => Items::SQUID_SPAWN_EGG());
		$this->map(Ids::STICK, fn() => Items::STICK());
		$this->map(Ids::STONE_AXE, fn() => Items::STONE_AXE());
		$this->map(Ids::STONE_HOE, fn() => Items::STONE_HOE());
		$this->map(Ids::STONE_PICKAXE, fn() => Items::STONE_PICKAXE());
		$this->map(Ids::STONE_SHOVEL, fn() => Items::STONE_SHOVEL());
		$this->map(Ids::STONE_SWORD, fn() => Items::STONE_SWORD());
		//TODO: minecraft:stray_spawn_egg
		//TODO: minecraft:strider_spawn_egg
		$this->map(Ids::STRING, fn() => Items::STRING());
		$this->map(Ids::SUGAR, fn() => Items::SUGAR());
		$this->map(Ids::SUGAR_CANE, fn() => Blocks::SUGARCANE()->asItem());
		//TODO: minecraft:suspicious_stew
		$this->map(Ids::SWEET_BERRIES, fn() => Items::SWEET_BERRIES());
		//TODO: minecraft:tadpole_bucket
		//TODO: minecraft:tadpole_spawn_egg
		//TODO: minecraft:tnt_minecart
		$this->map(Ids::TOTEM_OF_UNDYING, fn() => Items::TOTEM());
		//TODO: minecraft:trident
		$this->map(Ids::TROPICAL_FISH, fn() => Items::CLOWNFISH());
		//TODO: minecraft:tropical_fish_bucket
		//TODO: minecraft:tropical_fish_spawn_egg
		//TODO: minecraft:turtle_helmet
		//TODO: minecraft:turtle_spawn_egg
		//TODO: minecraft:vex_spawn_egg
		$this->map(Ids::VILLAGER_SPAWN_EGG, fn() => Items::VILLAGER_SPAWN_EGG());
		//TODO: minecraft:vindicator_spawn_egg
		//TODO: minecraft:wandering_trader_spawn_egg
		//TODO: minecraft:warped_door
		//TODO: minecraft:warped_fungus_on_a_stick
		//TODO: minecraft:warped_sign
		$this->map(Ids::WATER_BUCKET, fn() => Items::WATER_BUCKET());
		$this->map(Ids::WHEAT, fn() => Items::WHEAT());
		$this->map(Ids::WHEAT_SEEDS, fn() => Items::WHEAT_SEEDS());
		$this->map(Ids::WHITE_DYE, fn() => Items::WHITE_DYE());
		//TODO: minecraft:witch_spawn_egg
		//TODO: minecraft:wither_skeleton_spawn_egg
		//TODO: minecraft:wolf_spawn_egg
		$this->map(Ids::WOODEN_AXE, fn() => Items::WOODEN_AXE());
		$this->map(Ids::WOODEN_DOOR, fn() => Blocks::OAK_DOOR()->asItem());
		$this->map(Ids::WOODEN_HOE, fn() => Items::WOODEN_HOE());
		$this->map(Ids::WOODEN_PICKAXE, fn() => Items::WOODEN_PICKAXE());
		$this->map(Ids::WOODEN_SHOVEL, fn() => Items::WOODEN_SHOVEL());
		$this->map(Ids::WOODEN_SWORD, fn() => Items::WOODEN_SWORD());
		$this->map(Ids::WRITABLE_BOOK, fn() => Items::WRITABLE_BOOK());
		$this->map(Ids::WRITTEN_BOOK, fn() => Items::WRITTEN_BOOK());
		$this->map(Ids::YELLOW_DYE, fn() => Items::YELLOW_DYE());
		//TODO: minecraft:zoglin_spawn_egg
		//TODO: minecraft:zombie_horse_spawn_egg
		//TODO: minecraft:zombie_pigman_spawn_egg
		$this->map(Ids::ZOMBIE_SPAWN_EGG, fn() => Items::ZOMBIE_SPAWN_EGG());
		//TODO: minecraft:zombie_villager_spawn_egg
	}
}
