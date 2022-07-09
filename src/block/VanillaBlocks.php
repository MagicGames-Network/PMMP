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

use pocketmine\block\BlockBreakInfo as BreakInfo;
use pocketmine\block\BlockIdentifier as BID;
use pocketmine\block\BlockToolType as ToolType;
use pocketmine\block\BlockTypeIds as Ids;
use pocketmine\block\tile\Banner as TileBanner;
use pocketmine\block\tile\Barrel as TileBarrel;
use pocketmine\block\tile\Beacon as TileBeacon;
use pocketmine\block\tile\Bed as TileBed;
use pocketmine\block\tile\Bell as TileBell;
use pocketmine\block\tile\BlastFurnace as TileBlastFurnace;
use pocketmine\block\tile\BrewingStand as TileBrewingStand;
use pocketmine\block\tile\Chest as TileChest;
use pocketmine\block\tile\Comparator as TileComparator;
use pocketmine\block\tile\DaylightSensor as TileDaylightSensor;
use pocketmine\block\tile\EnchantTable as TileEnchantingTable;
use pocketmine\block\tile\EnderChest as TileEnderChest;
use pocketmine\block\tile\FlowerPot as TileFlowerPot;
use pocketmine\block\tile\Hopper as TileHopper;
use pocketmine\block\tile\ItemFrame as TileItemFrame;
use pocketmine\block\tile\Jukebox as TileJukebox;
use pocketmine\block\tile\Lectern as TileLectern;
use pocketmine\block\tile\MonsterSpawner as TileMonsterSpawner;
use pocketmine\block\tile\NormalFurnace as TileNormalFurnace;
use pocketmine\block\tile\Note as TileNote;
use pocketmine\block\tile\ShulkerBox as TileShulkerBox;
use pocketmine\block\tile\Skull as TileSkull;
use pocketmine\block\tile\Smoker as TileSmoker;
use pocketmine\block\utils\TreeType;
use pocketmine\block\utils\WoodType;
use pocketmine\item\Item;
use pocketmine\item\ToolTier;
use pocketmine\utils\CloningRegistryTrait;
use function mb_strtolower;

/**
 * This doc-block is generated automatically, do not modify it manually.
 * This must be regenerated whenever registry members are added, removed or changed.
 * @see build/generate-registry-annotations.php
 * @generate-registry-docblock
 *
 * @method static WoodenButton ACACIA_BUTTON()
 * @method static WoodenDoor ACACIA_DOOR()
 * @method static WoodenFence ACACIA_FENCE()
 * @method static FenceGate ACACIA_FENCE_GATE()
 * @method static Leaves ACACIA_LEAVES()
 * @method static Wood ACACIA_LOG()
 * @method static Planks ACACIA_PLANKS()
 * @method static WoodenPressurePlate ACACIA_PRESSURE_PLATE()
 * @method static Sapling ACACIA_SAPLING()
 * @method static FloorSign ACACIA_SIGN()
 * @method static WoodenSlab ACACIA_SLAB()
 * @method static WoodenStairs ACACIA_STAIRS()
 * @method static WoodenTrapdoor ACACIA_TRAPDOOR()
 * @method static WallSign ACACIA_WALL_SIGN()
 * @method static Wood ACACIA_WOOD()
 * @method static ActivatorRail ACTIVATOR_RAIL()
 * @method static Air AIR()
 * @method static Flower ALLIUM()
 * @method static MushroomStem ALL_SIDED_MUSHROOM_STEM()
 * @method static Opaque AMETHYST()
 * @method static Opaque ANCIENT_DEBRIS()
 * @method static Opaque ANDESITE()
 * @method static Slab ANDESITE_SLAB()
 * @method static Stair ANDESITE_STAIRS()
 * @method static Wall ANDESITE_WALL()
 * @method static Anvil ANVIL()
 * @method static Flower AZURE_BLUET()
 * @method static Bamboo BAMBOO()
 * @method static BambooSapling BAMBOO_SAPLING()
 * @method static FloorBanner BANNER()
 * @method static Barrel BARREL()
 * @method static Transparent BARRIER()
 * @method static SimplePillar BASALT()
 * @method static Beacon BEACON()
 * @method static Bed BED()
 * @method static Bedrock BEDROCK()
 * @method static Beetroot BEETROOTS()
 * @method static Bell BELL()
 * @method static WoodenButton BIRCH_BUTTON()
 * @method static WoodenDoor BIRCH_DOOR()
 * @method static WoodenFence BIRCH_FENCE()
 * @method static FenceGate BIRCH_FENCE_GATE()
 * @method static Leaves BIRCH_LEAVES()
 * @method static Wood BIRCH_LOG()
 * @method static Planks BIRCH_PLANKS()
 * @method static WoodenPressurePlate BIRCH_PRESSURE_PLATE()
 * @method static Sapling BIRCH_SAPLING()
 * @method static FloorSign BIRCH_SIGN()
 * @method static WoodenSlab BIRCH_SLAB()
 * @method static WoodenStairs BIRCH_STAIRS()
 * @method static WoodenTrapdoor BIRCH_TRAPDOOR()
 * @method static WallSign BIRCH_WALL_SIGN()
 * @method static Wood BIRCH_WOOD()
 * @method static Opaque BLACKSTONE()
 * @method static Slab BLACKSTONE_SLAB()
 * @method static Stair BLACKSTONE_STAIRS()
 * @method static Wall BLACKSTONE_WALL()
 * @method static Furnace BLAST_FURNACE()
 * @method static BlueIce BLUE_ICE()
 * @method static Flower BLUE_ORCHID()
 * @method static Torch BLUE_TORCH()
 * @method static BoneBlock BONE_BLOCK()
 * @method static Bookshelf BOOKSHELF()
 * @method static BrewingStand BREWING_STAND()
 * @method static Opaque BRICKS()
 * @method static Slab BRICK_SLAB()
 * @method static Stair BRICK_STAIRS()
 * @method static Wall BRICK_WALL()
 * @method static BrownMushroom BROWN_MUSHROOM()
 * @method static BrownMushroomBlock BROWN_MUSHROOM_BLOCK()
 * @method static Cactus CACTUS()
 * @method static Cake CAKE()
 * @method static Opaque CALCITE()
 * @method static Carpet CARPET()
 * @method static Carrot CARROTS()
 * @method static CarvedPumpkin CARVED_PUMPKIN()
 * @method static ChemicalHeat CHEMICAL_HEAT()
 * @method static Chest CHEST()
 * @method static Opaque CHISELED_DEEPSLATE()
 * @method static Opaque CHISELED_NETHER_BRICKS()
 * @method static Opaque CHISELED_POLISHED_BLACKSTONE()
 * @method static SimplePillar CHISELED_QUARTZ()
 * @method static Opaque CHISELED_RED_SANDSTONE()
 * @method static Opaque CHISELED_SANDSTONE()
 * @method static Opaque CHISELED_STONE_BRICKS()
 * @method static Clay CLAY()
 * @method static Coal COAL()
 * @method static CoalOre COAL_ORE()
 * @method static Opaque COBBLED_DEEPSLATE()
 * @method static Slab COBBLED_DEEPSLATE_SLAB()
 * @method static Stair COBBLED_DEEPSLATE_STAIRS()
 * @method static Wall COBBLED_DEEPSLATE_WALL()
 * @method static Opaque COBBLESTONE()
 * @method static Slab COBBLESTONE_SLAB()
 * @method static Stair COBBLESTONE_STAIRS()
 * @method static Wall COBBLESTONE_WALL()
 * @method static Cobweb COBWEB()
 * @method static CocoaBlock COCOA_POD()
 * @method static ChemistryTable COMPOUND_CREATOR()
 * @method static Concrete CONCRETE()
 * @method static ConcretePowder CONCRETE_POWDER()
 * @method static Copper COPPER()
 * @method static CopperOre COPPER_ORE()
 * @method static Coral CORAL()
 * @method static CoralBlock CORAL_BLOCK()
 * @method static FloorCoralFan CORAL_FAN()
 * @method static Flower CORNFLOWER()
 * @method static Opaque CRACKED_DEEPSLATE_BRICKS()
 * @method static Opaque CRACKED_DEEPSLATE_TILES()
 * @method static Opaque CRACKED_NETHER_BRICKS()
 * @method static Opaque CRACKED_POLISHED_BLACKSTONE_BRICKS()
 * @method static Opaque CRACKED_STONE_BRICKS()
 * @method static CraftingTable CRAFTING_TABLE()
 * @method static WoodenButton CRIMSON_BUTTON()
 * @method static WoodenDoor CRIMSON_DOOR()
 * @method static WoodenFence CRIMSON_FENCE()
 * @method static FenceGate CRIMSON_FENCE_GATE()
 * @method static Wood CRIMSON_HYPHAE()
 * @method static Planks CRIMSON_PLANKS()
 * @method static WoodenPressurePlate CRIMSON_PRESSURE_PLATE()
 * @method static FloorSign CRIMSON_SIGN()
 * @method static WoodenSlab CRIMSON_SLAB()
 * @method static WoodenStairs CRIMSON_STAIRS()
 * @method static Wood CRIMSON_STEM()
 * @method static WoodenTrapdoor CRIMSON_TRAPDOOR()
 * @method static WallSign CRIMSON_WALL_SIGN()
 * @method static Opaque CRYING_OBSIDIAN()
 * @method static Copper CUT_COPPER()
 * @method static CopperSlab CUT_COPPER_SLAB()
 * @method static CopperStairs CUT_COPPER_STAIRS()
 * @method static Opaque CUT_RED_SANDSTONE()
 * @method static Slab CUT_RED_SANDSTONE_SLAB()
 * @method static Opaque CUT_SANDSTONE()
 * @method static Slab CUT_SANDSTONE_SLAB()
 * @method static Flower DANDELION()
 * @method static WoodenButton DARK_OAK_BUTTON()
 * @method static WoodenDoor DARK_OAK_DOOR()
 * @method static WoodenFence DARK_OAK_FENCE()
 * @method static FenceGate DARK_OAK_FENCE_GATE()
 * @method static Leaves DARK_OAK_LEAVES()
 * @method static Wood DARK_OAK_LOG()
 * @method static Planks DARK_OAK_PLANKS()
 * @method static WoodenPressurePlate DARK_OAK_PRESSURE_PLATE()
 * @method static Sapling DARK_OAK_SAPLING()
 * @method static FloorSign DARK_OAK_SIGN()
 * @method static WoodenSlab DARK_OAK_SLAB()
 * @method static WoodenStairs DARK_OAK_STAIRS()
 * @method static WoodenTrapdoor DARK_OAK_TRAPDOOR()
 * @method static WallSign DARK_OAK_WALL_SIGN()
 * @method static Wood DARK_OAK_WOOD()
 * @method static Opaque DARK_PRISMARINE()
 * @method static Slab DARK_PRISMARINE_SLAB()
 * @method static Stair DARK_PRISMARINE_STAIRS()
 * @method static DaylightSensor DAYLIGHT_SENSOR()
 * @method static DeadBush DEAD_BUSH()
 * @method static SimplePillar DEEPSLATE()
 * @method static Opaque DEEPSLATE_BRICKS()
 * @method static Slab DEEPSLATE_BRICK_SLAB()
 * @method static Stair DEEPSLATE_BRICK_STAIRS()
 * @method static Wall DEEPSLATE_BRICK_WALL()
 * @method static CoalOre DEEPSLATE_COAL_ORE()
 * @method static CopperOre DEEPSLATE_COPPER_ORE()
 * @method static DiamondOre DEEPSLATE_DIAMOND_ORE()
 * @method static EmeraldOre DEEPSLATE_EMERALD_ORE()
 * @method static GoldOre DEEPSLATE_GOLD_ORE()
 * @method static IronOre DEEPSLATE_IRON_ORE()
 * @method static LapisOre DEEPSLATE_LAPIS_LAZULI_ORE()
 * @method static RedstoneOre DEEPSLATE_REDSTONE_ORE()
 * @method static Opaque DEEPSLATE_TILES()
 * @method static Slab DEEPSLATE_TILE_SLAB()
 * @method static Stair DEEPSLATE_TILE_STAIRS()
 * @method static Wall DEEPSLATE_TILE_WALL()
 * @method static DetectorRail DETECTOR_RAIL()
 * @method static Opaque DIAMOND()
 * @method static DiamondOre DIAMOND_ORE()
 * @method static Opaque DIORITE()
 * @method static Slab DIORITE_SLAB()
 * @method static Stair DIORITE_STAIRS()
 * @method static Wall DIORITE_WALL()
 * @method static Dirt DIRT()
 * @method static DoubleTallGrass DOUBLE_TALLGRASS()
 * @method static DragonEgg DRAGON_EGG()
 * @method static DriedKelp DRIED_KELP()
 * @method static DyedShulkerBox DYED_SHULKER_BOX()
 * @method static Element ELEMENT_ACTINIUM()
 * @method static Element ELEMENT_ALUMINUM()
 * @method static Element ELEMENT_AMERICIUM()
 * @method static Element ELEMENT_ANTIMONY()
 * @method static Element ELEMENT_ARGON()
 * @method static Element ELEMENT_ARSENIC()
 * @method static Element ELEMENT_ASTATINE()
 * @method static Element ELEMENT_BARIUM()
 * @method static Element ELEMENT_BERKELIUM()
 * @method static Element ELEMENT_BERYLLIUM()
 * @method static Element ELEMENT_BISMUTH()
 * @method static Element ELEMENT_BOHRIUM()
 * @method static Element ELEMENT_BORON()
 * @method static Element ELEMENT_BROMINE()
 * @method static Element ELEMENT_CADMIUM()
 * @method static Element ELEMENT_CALCIUM()
 * @method static Element ELEMENT_CALIFORNIUM()
 * @method static Element ELEMENT_CARBON()
 * @method static Element ELEMENT_CERIUM()
 * @method static Element ELEMENT_CESIUM()
 * @method static Element ELEMENT_CHLORINE()
 * @method static Element ELEMENT_CHROMIUM()
 * @method static Element ELEMENT_COBALT()
 * @method static ChemistryTable ELEMENT_CONSTRUCTOR()
 * @method static Element ELEMENT_COPERNICIUM()
 * @method static Element ELEMENT_COPPER()
 * @method static Element ELEMENT_CURIUM()
 * @method static Element ELEMENT_DARMSTADTIUM()
 * @method static Element ELEMENT_DUBNIUM()
 * @method static Element ELEMENT_DYSPROSIUM()
 * @method static Element ELEMENT_EINSTEINIUM()
 * @method static Element ELEMENT_ERBIUM()
 * @method static Element ELEMENT_EUROPIUM()
 * @method static Element ELEMENT_FERMIUM()
 * @method static Element ELEMENT_FLEROVIUM()
 * @method static Element ELEMENT_FLUORINE()
 * @method static Element ELEMENT_FRANCIUM()
 * @method static Element ELEMENT_GADOLINIUM()
 * @method static Element ELEMENT_GALLIUM()
 * @method static Element ELEMENT_GERMANIUM()
 * @method static Element ELEMENT_GOLD()
 * @method static Element ELEMENT_HAFNIUM()
 * @method static Element ELEMENT_HASSIUM()
 * @method static Element ELEMENT_HELIUM()
 * @method static Element ELEMENT_HOLMIUM()
 * @method static Element ELEMENT_HYDROGEN()
 * @method static Element ELEMENT_INDIUM()
 * @method static Element ELEMENT_IODINE()
 * @method static Element ELEMENT_IRIDIUM()
 * @method static Element ELEMENT_IRON()
 * @method static Element ELEMENT_KRYPTON()
 * @method static Element ELEMENT_LANTHANUM()
 * @method static Element ELEMENT_LAWRENCIUM()
 * @method static Element ELEMENT_LEAD()
 * @method static Element ELEMENT_LITHIUM()
 * @method static Element ELEMENT_LIVERMORIUM()
 * @method static Element ELEMENT_LUTETIUM()
 * @method static Element ELEMENT_MAGNESIUM()
 * @method static Element ELEMENT_MANGANESE()
 * @method static Element ELEMENT_MEITNERIUM()
 * @method static Element ELEMENT_MENDELEVIUM()
 * @method static Element ELEMENT_MERCURY()
 * @method static Element ELEMENT_MOLYBDENUM()
 * @method static Element ELEMENT_MOSCOVIUM()
 * @method static Element ELEMENT_NEODYMIUM()
 * @method static Element ELEMENT_NEON()
 * @method static Element ELEMENT_NEPTUNIUM()
 * @method static Element ELEMENT_NICKEL()
 * @method static Element ELEMENT_NIHONIUM()
 * @method static Element ELEMENT_NIOBIUM()
 * @method static Element ELEMENT_NITROGEN()
 * @method static Element ELEMENT_NOBELIUM()
 * @method static Element ELEMENT_OGANESSON()
 * @method static Element ELEMENT_OSMIUM()
 * @method static Element ELEMENT_OXYGEN()
 * @method static Element ELEMENT_PALLADIUM()
 * @method static Element ELEMENT_PHOSPHORUS()
 * @method static Element ELEMENT_PLATINUM()
 * @method static Element ELEMENT_PLUTONIUM()
 * @method static Element ELEMENT_POLONIUM()
 * @method static Element ELEMENT_POTASSIUM()
 * @method static Element ELEMENT_PRASEODYMIUM()
 * @method static Element ELEMENT_PROMETHIUM()
 * @method static Element ELEMENT_PROTACTINIUM()
 * @method static Element ELEMENT_RADIUM()
 * @method static Element ELEMENT_RADON()
 * @method static Element ELEMENT_RHENIUM()
 * @method static Element ELEMENT_RHODIUM()
 * @method static Element ELEMENT_ROENTGENIUM()
 * @method static Element ELEMENT_RUBIDIUM()
 * @method static Element ELEMENT_RUTHENIUM()
 * @method static Element ELEMENT_RUTHERFORDIUM()
 * @method static Element ELEMENT_SAMARIUM()
 * @method static Element ELEMENT_SCANDIUM()
 * @method static Element ELEMENT_SEABORGIUM()
 * @method static Element ELEMENT_SELENIUM()
 * @method static Element ELEMENT_SILICON()
 * @method static Element ELEMENT_SILVER()
 * @method static Element ELEMENT_SODIUM()
 * @method static Element ELEMENT_STRONTIUM()
 * @method static Element ELEMENT_SULFUR()
 * @method static Element ELEMENT_TANTALUM()
 * @method static Element ELEMENT_TECHNETIUM()
 * @method static Element ELEMENT_TELLURIUM()
 * @method static Element ELEMENT_TENNESSINE()
 * @method static Element ELEMENT_TERBIUM()
 * @method static Element ELEMENT_THALLIUM()
 * @method static Element ELEMENT_THORIUM()
 * @method static Element ELEMENT_THULIUM()
 * @method static Element ELEMENT_TIN()
 * @method static Element ELEMENT_TITANIUM()
 * @method static Element ELEMENT_TUNGSTEN()
 * @method static Element ELEMENT_URANIUM()
 * @method static Element ELEMENT_VANADIUM()
 * @method static Element ELEMENT_XENON()
 * @method static Element ELEMENT_YTTERBIUM()
 * @method static Element ELEMENT_YTTRIUM()
 * @method static Opaque ELEMENT_ZERO()
 * @method static Element ELEMENT_ZINC()
 * @method static Element ELEMENT_ZIRCONIUM()
 * @method static Opaque EMERALD()
 * @method static EmeraldOre EMERALD_ORE()
 * @method static EnchantingTable ENCHANTING_TABLE()
 * @method static EnderChest ENDER_CHEST()
 * @method static EndPortalFrame END_PORTAL_FRAME()
 * @method static EndRod END_ROD()
 * @method static Opaque END_STONE()
 * @method static Opaque END_STONE_BRICKS()
 * @method static Slab END_STONE_BRICK_SLAB()
 * @method static Stair END_STONE_BRICK_STAIRS()
 * @method static Wall END_STONE_BRICK_WALL()
 * @method static Slab FAKE_WOODEN_SLAB()
 * @method static Farmland FARMLAND()
 * @method static TallGrass FERN()
 * @method static Fire FIRE()
 * @method static FletchingTable FLETCHING_TABLE()
 * @method static FlowerPot FLOWER_POT()
 * @method static FrostedIce FROSTED_ICE()
 * @method static Furnace FURNACE()
 * @method static GildedBlackstone GILDED_BLACKSTONE()
 * @method static Glass GLASS()
 * @method static GlassPane GLASS_PANE()
 * @method static GlazedTerracotta GLAZED_TERRACOTTA()
 * @method static GlowingObsidian GLOWING_OBSIDIAN()
 * @method static Glowstone GLOWSTONE()
 * @method static Opaque GOLD()
 * @method static GoldOre GOLD_ORE()
 * @method static Opaque GRANITE()
 * @method static Slab GRANITE_SLAB()
 * @method static Stair GRANITE_STAIRS()
 * @method static Wall GRANITE_WALL()
 * @method static Grass GRASS()
 * @method static GrassPath GRASS_PATH()
 * @method static Gravel GRAVEL()
 * @method static Torch GREEN_TORCH()
 * @method static HardenedClay HARDENED_CLAY()
 * @method static HardenedGlass HARDENED_GLASS()
 * @method static HardenedGlassPane HARDENED_GLASS_PANE()
 * @method static HayBale HAY_BALE()
 * @method static Opaque HONEYCOMB()
 * @method static Hopper HOPPER()
 * @method static Ice ICE()
 * @method static InfestedStone INFESTED_CHISELED_STONE_BRICK()
 * @method static InfestedStone INFESTED_COBBLESTONE()
 * @method static InfestedStone INFESTED_CRACKED_STONE_BRICK()
 * @method static InfestedStone INFESTED_MOSSY_STONE_BRICK()
 * @method static InfestedStone INFESTED_STONE()
 * @method static InfestedStone INFESTED_STONE_BRICK()
 * @method static Opaque INFO_UPDATE()
 * @method static Opaque INFO_UPDATE2()
 * @method static Transparent INVISIBLE_BEDROCK()
 * @method static Opaque IRON()
 * @method static Thin IRON_BARS()
 * @method static Door IRON_DOOR()
 * @method static IronOre IRON_ORE()
 * @method static Trapdoor IRON_TRAPDOOR()
 * @method static ItemFrame ITEM_FRAME()
 * @method static Jukebox JUKEBOX()
 * @method static WoodenButton JUNGLE_BUTTON()
 * @method static WoodenDoor JUNGLE_DOOR()
 * @method static WoodenFence JUNGLE_FENCE()
 * @method static FenceGate JUNGLE_FENCE_GATE()
 * @method static Leaves JUNGLE_LEAVES()
 * @method static Wood JUNGLE_LOG()
 * @method static Planks JUNGLE_PLANKS()
 * @method static WoodenPressurePlate JUNGLE_PRESSURE_PLATE()
 * @method static Sapling JUNGLE_SAPLING()
 * @method static FloorSign JUNGLE_SIGN()
 * @method static WoodenSlab JUNGLE_SLAB()
 * @method static WoodenStairs JUNGLE_STAIRS()
 * @method static WoodenTrapdoor JUNGLE_TRAPDOOR()
 * @method static WallSign JUNGLE_WALL_SIGN()
 * @method static Wood JUNGLE_WOOD()
 * @method static ChemistryTable LAB_TABLE()
 * @method static Ladder LADDER()
 * @method static Lantern LANTERN()
 * @method static Opaque LAPIS_LAZULI()
 * @method static LapisOre LAPIS_LAZULI_ORE()
 * @method static DoubleTallGrass LARGE_FERN()
 * @method static Lava LAVA()
 * @method static Lectern LECTERN()
 * @method static Opaque LEGACY_STONECUTTER()
 * @method static Lever LEVER()
 * @method static Light LIGHT()
 * @method static LightningRod LIGHTNING_ROD()
 * @method static DoublePlant LILAC()
 * @method static Flower LILY_OF_THE_VALLEY()
 * @method static WaterLily LILY_PAD()
 * @method static LitPumpkin LIT_PUMPKIN()
 * @method static Loom LOOM()
 * @method static Magma MAGMA()
 * @method static WoodenButton MANGROVE_BUTTON()
 * @method static WoodenDoor MANGROVE_DOOR()
 * @method static WoodenFence MANGROVE_FENCE()
 * @method static FenceGate MANGROVE_FENCE_GATE()
 * @method static Wood MANGROVE_LOG()
 * @method static Planks MANGROVE_PLANKS()
 * @method static WoodenPressurePlate MANGROVE_PRESSURE_PLATE()
 * @method static FloorSign MANGROVE_SIGN()
 * @method static WoodenSlab MANGROVE_SLAB()
 * @method static WoodenStairs MANGROVE_STAIRS()
 * @method static WoodenTrapdoor MANGROVE_TRAPDOOR()
 * @method static WallSign MANGROVE_WALL_SIGN()
 * @method static Wood MANGROVE_WOOD()
 * @method static ChemistryTable MATERIAL_REDUCER()
 * @method static Melon MELON()
 * @method static MelonStem MELON_STEM()
 * @method static Skull MOB_HEAD()
 * @method static MonsterSpawner MONSTER_SPAWNER()
 * @method static Opaque MOSSY_COBBLESTONE()
 * @method static Slab MOSSY_COBBLESTONE_SLAB()
 * @method static Stair MOSSY_COBBLESTONE_STAIRS()
 * @method static Wall MOSSY_COBBLESTONE_WALL()
 * @method static Opaque MOSSY_STONE_BRICKS()
 * @method static Slab MOSSY_STONE_BRICK_SLAB()
 * @method static Stair MOSSY_STONE_BRICK_STAIRS()
 * @method static Wall MOSSY_STONE_BRICK_WALL()
 * @method static Opaque MUD_BRICKS()
 * @method static Slab MUD_BRICK_SLAB()
 * @method static Stair MUD_BRICK_STAIRS()
 * @method static Wall MUD_BRICK_WALL()
 * @method static MushroomStem MUSHROOM_STEM()
 * @method static Mycelium MYCELIUM()
 * @method static Netherrack NETHERRACK()
 * @method static Opaque NETHER_BRICKS()
 * @method static Fence NETHER_BRICK_FENCE()
 * @method static Slab NETHER_BRICK_SLAB()
 * @method static Stair NETHER_BRICK_STAIRS()
 * @method static Wall NETHER_BRICK_WALL()
 * @method static NetherGoldOre NETHER_GOLD_ORE()
 * @method static NetherPortal NETHER_PORTAL()
 * @method static NetherQuartzOre NETHER_QUARTZ_ORE()
 * @method static NetherReactor NETHER_REACTOR_CORE()
 * @method static NetherWartPlant NETHER_WART()
 * @method static Opaque NETHER_WART_BLOCK()
 * @method static Note NOTE_BLOCK()
 * @method static WoodenButton OAK_BUTTON()
 * @method static WoodenDoor OAK_DOOR()
 * @method static WoodenFence OAK_FENCE()
 * @method static FenceGate OAK_FENCE_GATE()
 * @method static Leaves OAK_LEAVES()
 * @method static Wood OAK_LOG()
 * @method static Planks OAK_PLANKS()
 * @method static WoodenPressurePlate OAK_PRESSURE_PLATE()
 * @method static Sapling OAK_SAPLING()
 * @method static FloorSign OAK_SIGN()
 * @method static WoodenSlab OAK_SLAB()
 * @method static WoodenStairs OAK_STAIRS()
 * @method static WoodenTrapdoor OAK_TRAPDOOR()
 * @method static WallSign OAK_WALL_SIGN()
 * @method static Wood OAK_WOOD()
 * @method static Opaque OBSIDIAN()
 * @method static Flower ORANGE_TULIP()
 * @method static Flower OXEYE_DAISY()
 * @method static PackedIce PACKED_ICE()
 * @method static DoublePlant PEONY()
 * @method static Flower PINK_TULIP()
 * @method static Podzol PODZOL()
 * @method static Opaque POLISHED_ANDESITE()
 * @method static Slab POLISHED_ANDESITE_SLAB()
 * @method static Stair POLISHED_ANDESITE_STAIRS()
 * @method static SimplePillar POLISHED_BASALT()
 * @method static Opaque POLISHED_BLACKSTONE()
 * @method static Opaque POLISHED_BLACKSTONE_BRICKS()
 * @method static Slab POLISHED_BLACKSTONE_BRICK_SLAB()
 * @method static Stair POLISHED_BLACKSTONE_BRICK_STAIRS()
 * @method static Wall POLISHED_BLACKSTONE_BRICK_WALL()
 * @method static StoneButton POLISHED_BLACKSTONE_BUTTON()
 * @method static StonePressurePlate POLISHED_BLACKSTONE_PRESSURE_PLATE()
 * @method static Slab POLISHED_BLACKSTONE_SLAB()
 * @method static Stair POLISHED_BLACKSTONE_STAIRS()
 * @method static Wall POLISHED_BLACKSTONE_WALL()
 * @method static Opaque POLISHED_DEEPSLATE()
 * @method static Slab POLISHED_DEEPSLATE_SLAB()
 * @method static Stair POLISHED_DEEPSLATE_STAIRS()
 * @method static Wall POLISHED_DEEPSLATE_WALL()
 * @method static Opaque POLISHED_DIORITE()
 * @method static Slab POLISHED_DIORITE_SLAB()
 * @method static Stair POLISHED_DIORITE_STAIRS()
 * @method static Opaque POLISHED_GRANITE()
 * @method static Slab POLISHED_GRANITE_SLAB()
 * @method static Stair POLISHED_GRANITE_STAIRS()
 * @method static Flower POPPY()
 * @method static Potato POTATOES()
 * @method static PoweredRail POWERED_RAIL()
 * @method static Opaque PRISMARINE()
 * @method static Opaque PRISMARINE_BRICKS()
 * @method static Slab PRISMARINE_BRICKS_SLAB()
 * @method static Stair PRISMARINE_BRICKS_STAIRS()
 * @method static Slab PRISMARINE_SLAB()
 * @method static Stair PRISMARINE_STAIRS()
 * @method static Wall PRISMARINE_WALL()
 * @method static Pumpkin PUMPKIN()
 * @method static PumpkinStem PUMPKIN_STEM()
 * @method static Torch PURPLE_TORCH()
 * @method static Opaque PURPUR()
 * @method static SimplePillar PURPUR_PILLAR()
 * @method static Slab PURPUR_SLAB()
 * @method static Stair PURPUR_STAIRS()
 * @method static Opaque QUARTZ()
 * @method static Opaque QUARTZ_BRICKS()
 * @method static SimplePillar QUARTZ_PILLAR()
 * @method static Slab QUARTZ_SLAB()
 * @method static Stair QUARTZ_STAIRS()
 * @method static Rail RAIL()
 * @method static Opaque RAW_COPPER()
 * @method static Opaque RAW_GOLD()
 * @method static Opaque RAW_IRON()
 * @method static Redstone REDSTONE()
 * @method static RedstoneComparator REDSTONE_COMPARATOR()
 * @method static RedstoneLamp REDSTONE_LAMP()
 * @method static RedstoneOre REDSTONE_ORE()
 * @method static RedstoneRepeater REDSTONE_REPEATER()
 * @method static RedstoneTorch REDSTONE_TORCH()
 * @method static RedstoneWire REDSTONE_WIRE()
 * @method static RedMushroom RED_MUSHROOM()
 * @method static RedMushroomBlock RED_MUSHROOM_BLOCK()
 * @method static Opaque RED_NETHER_BRICKS()
 * @method static Slab RED_NETHER_BRICK_SLAB()
 * @method static Stair RED_NETHER_BRICK_STAIRS()
 * @method static Wall RED_NETHER_BRICK_WALL()
 * @method static Sand RED_SAND()
 * @method static Opaque RED_SANDSTONE()
 * @method static Slab RED_SANDSTONE_SLAB()
 * @method static Stair RED_SANDSTONE_STAIRS()
 * @method static Wall RED_SANDSTONE_WALL()
 * @method static Torch RED_TORCH()
 * @method static Flower RED_TULIP()
 * @method static Reserved6 RESERVED6()
 * @method static DoublePlant ROSE_BUSH()
 * @method static Sand SAND()
 * @method static Opaque SANDSTONE()
 * @method static Slab SANDSTONE_SLAB()
 * @method static Stair SANDSTONE_STAIRS()
 * @method static Wall SANDSTONE_WALL()
 * @method static SeaLantern SEA_LANTERN()
 * @method static SeaPickle SEA_PICKLE()
 * @method static Opaque SHROOMLIGHT()
 * @method static ShulkerBox SHULKER_BOX()
 * @method static Slime SLIME()
 * @method static Furnace SMOKER()
 * @method static Opaque SMOOTH_BASALT()
 * @method static Opaque SMOOTH_QUARTZ()
 * @method static Slab SMOOTH_QUARTZ_SLAB()
 * @method static Stair SMOOTH_QUARTZ_STAIRS()
 * @method static Opaque SMOOTH_RED_SANDSTONE()
 * @method static Slab SMOOTH_RED_SANDSTONE_SLAB()
 * @method static Stair SMOOTH_RED_SANDSTONE_STAIRS()
 * @method static Opaque SMOOTH_SANDSTONE()
 * @method static Slab SMOOTH_SANDSTONE_SLAB()
 * @method static Stair SMOOTH_SANDSTONE_STAIRS()
 * @method static Opaque SMOOTH_STONE()
 * @method static Slab SMOOTH_STONE_SLAB()
 * @method static Snow SNOW()
 * @method static SnowLayer SNOW_LAYER()
 * @method static SoulFire SOUL_FIRE()
 * @method static Lantern SOUL_LANTERN()
 * @method static SoulSand SOUL_SAND()
 * @method static Opaque SOUL_SOIL()
 * @method static Torch SOUL_TORCH()
 * @method static Sponge SPONGE()
 * @method static WoodenButton SPRUCE_BUTTON()
 * @method static WoodenDoor SPRUCE_DOOR()
 * @method static WoodenFence SPRUCE_FENCE()
 * @method static FenceGate SPRUCE_FENCE_GATE()
 * @method static Leaves SPRUCE_LEAVES()
 * @method static Wood SPRUCE_LOG()
 * @method static Planks SPRUCE_PLANKS()
 * @method static WoodenPressurePlate SPRUCE_PRESSURE_PLATE()
 * @method static Sapling SPRUCE_SAPLING()
 * @method static FloorSign SPRUCE_SIGN()
 * @method static WoodenSlab SPRUCE_SLAB()
 * @method static WoodenStairs SPRUCE_STAIRS()
 * @method static WoodenTrapdoor SPRUCE_TRAPDOOR()
 * @method static WallSign SPRUCE_WALL_SIGN()
 * @method static Wood SPRUCE_WOOD()
 * @method static StainedHardenedClay STAINED_CLAY()
 * @method static StainedGlass STAINED_GLASS()
 * @method static StainedGlassPane STAINED_GLASS_PANE()
 * @method static StainedHardenedGlass STAINED_HARDENED_GLASS()
 * @method static StainedHardenedGlassPane STAINED_HARDENED_GLASS_PANE()
 * @method static Opaque STONE()
 * @method static Stonecutter STONECUTTER()
 * @method static Opaque STONE_BRICKS()
 * @method static Slab STONE_BRICK_SLAB()
 * @method static Stair STONE_BRICK_STAIRS()
 * @method static Wall STONE_BRICK_WALL()
 * @method static StoneButton STONE_BUTTON()
 * @method static StonePressurePlate STONE_PRESSURE_PLATE()
 * @method static Slab STONE_SLAB()
 * @method static Stair STONE_STAIRS()
 * @method static Sugarcane SUGARCANE()
 * @method static DoublePlant SUNFLOWER()
 * @method static SweetBerryBush SWEET_BERRY_BUSH()
 * @method static TallGrass TALL_GRASS()
 * @method static TintedGlass TINTED_GLASS()
 * @method static TNT TNT()
 * @method static Torch TORCH()
 * @method static TrappedChest TRAPPED_CHEST()
 * @method static Tripwire TRIPWIRE()
 * @method static TripwireHook TRIPWIRE_HOOK()
 * @method static Opaque TUFF()
 * @method static UnderwaterTorch UNDERWATER_TORCH()
 * @method static Vine VINES()
 * @method static WallBanner WALL_BANNER()
 * @method static WallCoralFan WALL_CORAL_FAN()
 * @method static WoodenButton WARPED_BUTTON()
 * @method static WoodenDoor WARPED_DOOR()
 * @method static WoodenFence WARPED_FENCE()
 * @method static FenceGate WARPED_FENCE_GATE()
 * @method static Wood WARPED_HYPHAE()
 * @method static Planks WARPED_PLANKS()
 * @method static WoodenPressurePlate WARPED_PRESSURE_PLATE()
 * @method static FloorSign WARPED_SIGN()
 * @method static WoodenSlab WARPED_SLAB()
 * @method static WoodenStairs WARPED_STAIRS()
 * @method static Wood WARPED_STEM()
 * @method static WoodenTrapdoor WARPED_TRAPDOOR()
 * @method static WallSign WARPED_WALL_SIGN()
 * @method static Opaque WARPED_WART_BLOCK()
 * @method static Water WATER()
 * @method static WeightedPressurePlateHeavy WEIGHTED_PRESSURE_PLATE_HEAVY()
 * @method static WeightedPressurePlateLight WEIGHTED_PRESSURE_PLATE_LIGHT()
 * @method static Wheat WHEAT()
 * @method static Flower WHITE_TULIP()
 * @method static Wool WOOL()
 */
final class VanillaBlocks{
	use CloningRegistryTrait;

	private function __construct(){
		//NOOP
	}

	protected static function register(string $name, Block $block) : void{
		self::_registryRegister($name, $block);
	}

	/**
	 * @return Block[]
	 */
	public static function getAll() : array{
		//phpstan doesn't support generic traits yet :(
		/** @var Block[] $result */
		$result = self::_registryGetAll();
		return $result;
	}

	protected static function setup() : void{
		$railBreakInfo = new BlockBreakInfo(0.7);
		self::register("activator_rail", new ActivatorRail(new BID(Ids::ACTIVATOR_RAIL), "Activator Rail", $railBreakInfo));
		self::register("air", new Air(new BID(Ids::AIR), "Air", BreakInfo::indestructible(-1.0)));
		self::register("anvil", new Anvil(new BID(Ids::ANVIL), "Anvil", new BreakInfo(5.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 6000.0)));
		self::register("bamboo", new Bamboo(new BID(Ids::BAMBOO), "Bamboo", new class(2.0 /* 1.0 in PC */, ToolType::AXE) extends BreakInfo{
			public function getBreakTime(Item $item) : float{
				if($item->getBlockToolType() === ToolType::SWORD){
					return 0.0;
				}
				return parent::getBreakTime($item);
			}
		}));
		self::register("bamboo_sapling", new BambooSapling(new BID(Ids::BAMBOO_SAPLING), "Bamboo Sapling", BreakInfo::instant()));

		$bannerBreakInfo = new BreakInfo(1.0, ToolType::AXE);
		self::register("banner", new FloorBanner(new BID(Ids::BANNER, TileBanner::class), "Banner", $bannerBreakInfo));
		self::register("wall_banner", new WallBanner(new BID(Ids::WALL_BANNER, TileBanner::class), "Wall Banner", $bannerBreakInfo));
		self::register("barrel", new Barrel(new BID(Ids::BARREL, TileBarrel::class), "Barrel", new BreakInfo(2.5, ToolType::AXE)));
		self::register("barrier", new Transparent(new BID(Ids::BARRIER), "Barrier", BreakInfo::indestructible()));
		self::register("beacon", new Beacon(new BID(Ids::BEACON, TileBeacon::class), "Beacon", new BreakInfo(3.0)));
		self::register("bed", new Bed(new BID(Ids::BED, TileBed::class), "Bed Block", new BreakInfo(0.2)));
		self::register("bedrock", new Bedrock(new BID(Ids::BEDROCK), "Bedrock", BreakInfo::indestructible()));

		self::register("beetroots", new Beetroot(new BID(Ids::BEETROOTS), "Beetroot Block", BreakInfo::instant()));
		self::register("bell", new Bell(new BID(Ids::BELL, TileBell::class), "Bell", new BreakInfo(5.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
		self::register("blue_ice", new BlueIce(new BID(Ids::BLUE_ICE), "Blue Ice", new BreakInfo(2.8, ToolType::PICKAXE)));
		self::register("bone_block", new BoneBlock(new BID(Ids::BONE_BLOCK), "Bone Block", new BreakInfo(2.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
		self::register("bookshelf", new Bookshelf(new BID(Ids::BOOKSHELF), "Bookshelf", new BreakInfo(1.5, ToolType::AXE)));
		self::register("brewing_stand", new BrewingStand(new BID(Ids::BREWING_STAND, TileBrewingStand::class), "Brewing Stand", new BreakInfo(0.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));

		$bricksBreakInfo = new BreakInfo(2.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0);
		self::register("brick_stairs", new Stair(new BID(Ids::BRICK_STAIRS), "Brick Stairs", $bricksBreakInfo));
		self::register("bricks", new Opaque(new BID(Ids::BRICKS), "Bricks", $bricksBreakInfo));

		self::register("brown_mushroom", new BrownMushroom(new BID(Ids::BROWN_MUSHROOM), "Brown Mushroom", BreakInfo::instant()));
		self::register("cactus", new Cactus(new BID(Ids::CACTUS), "Cactus", new BreakInfo(0.4)));
		self::register("cake", new Cake(new BID(Ids::CAKE), "Cake", new BreakInfo(0.5)));
		self::register("carrots", new Carrot(new BID(Ids::CARROTS), "Carrot Block", BreakInfo::instant()));

		$chestBreakInfo = new BreakInfo(2.5, ToolType::AXE);
		self::register("chest", new Chest(new BID(Ids::CHEST, TileChest::class), "Chest", $chestBreakInfo));
		self::register("clay", new Clay(new BID(Ids::CLAY), "Clay Block", new BreakInfo(0.6, ToolType::SHOVEL)));
		self::register("coal", new Coal(new BID(Ids::COAL), "Coal Block", new BreakInfo(5.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0)));

		$cobblestoneBreakInfo = new BreakInfo(2.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0);
		self::register("cobblestone", $cobblestone = new Opaque(new BID(Ids::COBBLESTONE), "Cobblestone", $cobblestoneBreakInfo));
		self::register("mossy_cobblestone", new Opaque(new BID(Ids::MOSSY_COBBLESTONE), "Mossy Cobblestone", $cobblestoneBreakInfo));
		self::register("cobblestone_stairs", new Stair(new BID(Ids::COBBLESTONE_STAIRS), "Cobblestone Stairs", $cobblestoneBreakInfo));
		self::register("mossy_cobblestone_stairs", new Stair(new BID(Ids::MOSSY_COBBLESTONE_STAIRS), "Mossy Cobblestone Stairs", $cobblestoneBreakInfo));

		self::register("cobweb", new Cobweb(new BID(Ids::COBWEB), "Cobweb", new BreakInfo(4.0, ToolType::SWORD | ToolType::SHEARS, 1)));
		self::register("cocoa_pod", new CocoaBlock(new BID(Ids::COCOA_POD), "Cocoa Block", new BreakInfo(0.2, ToolType::AXE, 0, 15.0)));
		self::register("coral_block", new CoralBlock(new BID(Ids::CORAL_BLOCK), "Coral Block", new BreakInfo(7.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
		self::register("crafting_table", new CraftingTable(new BID(Ids::CRAFTING_TABLE), "Crafting Table", new BreakInfo(2.5, ToolType::AXE)));
		self::register("daylight_sensor", new DaylightSensor(new BID(Ids::DAYLIGHT_SENSOR, TileDaylightSensor::class), "Daylight Sensor", new BreakInfo(0.2, ToolType::AXE)));
		self::register("dead_bush", new DeadBush(new BID(Ids::DEAD_BUSH), "Dead Bush", BreakInfo::instant(ToolType::SHEARS, 1)));
		self::register("detector_rail", new DetectorRail(new BID(Ids::DETECTOR_RAIL), "Detector Rail", $railBreakInfo));

		self::register("diamond", new Opaque(new BID(Ids::DIAMOND), "Diamond Block", new BreakInfo(5.0, ToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel(), 30.0)));
		self::register("dirt", new Dirt(new BID(Ids::DIRT), "Dirt", new BreakInfo(0.5, ToolType::SHOVEL)));
		self::register("sunflower", new DoublePlant(new BID(Ids::SUNFLOWER), "Sunflower", BreakInfo::instant()));
		self::register("lilac", new DoublePlant(new BID(Ids::LILAC), "Lilac", BreakInfo::instant()));
		self::register("rose_bush", new DoublePlant(new BID(Ids::ROSE_BUSH), "Rose Bush", BreakInfo::instant()));
		self::register("peony", new DoublePlant(new BID(Ids::PEONY), "Peony", BreakInfo::instant()));
		self::register("double_tallgrass", new DoubleTallGrass(new BID(Ids::DOUBLE_TALLGRASS), "Double Tallgrass", BreakInfo::instant(ToolType::SHEARS, 1)));
		self::register("large_fern", new DoubleTallGrass(new BID(Ids::LARGE_FERN), "Large Fern", BreakInfo::instant(ToolType::SHEARS, 1)));
		self::register("dragon_egg", new DragonEgg(new BID(Ids::DRAGON_EGG), "Dragon Egg", new BreakInfo(3.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
		self::register("dried_kelp", new DriedKelp(new BID(Ids::DRIED_KELP), "Dried Kelp Block", new BreakInfo(0.5, ToolType::NONE, 0, 12.5)));
		self::register("emerald", new Opaque(new BID(Ids::EMERALD), "Emerald Block", new BreakInfo(5.0, ToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel(), 30.0)));
		self::register("enchanting_table", new EnchantingTable(new BID(Ids::ENCHANTING_TABLE, TileEnchantingTable::class), "Enchanting Table", new BreakInfo(5.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 6000.0)));
		self::register("end_portal_frame", new EndPortalFrame(new BID(Ids::END_PORTAL_FRAME), "End Portal Frame", BreakInfo::indestructible()));
		self::register("end_rod", new EndRod(new BID(Ids::END_ROD), "End Rod", BreakInfo::instant()));
		self::register("end_stone", new Opaque(new BID(Ids::END_STONE), "End Stone", new BreakInfo(3.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 45.0)));

		$endBrickBreakInfo = new BreakInfo(0.8, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 4.0);
		self::register("end_stone_bricks", new Opaque(new BID(Ids::END_STONE_BRICKS), "End Stone Bricks", $endBrickBreakInfo));
		self::register("end_stone_brick_stairs", new Stair(new BID(Ids::END_STONE_BRICK_STAIRS), "End Stone Brick Stairs", $endBrickBreakInfo));

		self::register("ender_chest", new EnderChest(new BID(Ids::ENDER_CHEST, TileEnderChest::class), "Ender Chest", new BreakInfo(22.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 3000.0)));
		self::register("farmland", new Farmland(new BID(Ids::FARMLAND), "Farmland", new BreakInfo(0.6, ToolType::SHOVEL)));
		self::register("fire", new Fire(new BID(Ids::FIRE), "Fire Block", BreakInfo::instant()));
		self::register("fletching_table", new FletchingTable(new BID(Ids::FLETCHING_TABLE), "Fletching Table", new BreakInfo(2.5, ToolType::AXE, 0, 2.5)));
		self::register("dandelion", new Flower(new BID(Ids::DANDELION), "Dandelion", BreakInfo::instant()));
		self::register("poppy", new Flower(new BID(Ids::POPPY), "Poppy", BreakInfo::instant()));
		self::register("allium", new Flower(new BID(Ids::ALLIUM), "Allium", BreakInfo::instant()));
		self::register("azure_bluet", new Flower(new BID(Ids::AZURE_BLUET), "Azure Bluet", BreakInfo::instant()));
		self::register("blue_orchid", new Flower(new BID(Ids::BLUE_ORCHID), "Blue Orchid", BreakInfo::instant()));
		self::register("cornflower", new Flower(new BID(Ids::CORNFLOWER), "Cornflower", BreakInfo::instant()));
		self::register("lily_of_the_valley", new Flower(new BID(Ids::LILY_OF_THE_VALLEY), "Lily of the Valley", BreakInfo::instant()));
		self::register("orange_tulip", new Flower(new BID(Ids::ORANGE_TULIP), "Orange Tulip", BreakInfo::instant()));
		self::register("oxeye_daisy", new Flower(new BID(Ids::OXEYE_DAISY), "Oxeye Daisy", BreakInfo::instant()));
		self::register("pink_tulip", new Flower(new BID(Ids::PINK_TULIP), "Pink Tulip", BreakInfo::instant()));
		self::register("red_tulip", new Flower(new BID(Ids::RED_TULIP), "Red Tulip", BreakInfo::instant()));
		self::register("white_tulip", new Flower(new BID(Ids::WHITE_TULIP), "White Tulip", BreakInfo::instant()));
		self::register("flower_pot", new FlowerPot(new BID(Ids::FLOWER_POT, TileFlowerPot::class), "Flower Pot", BreakInfo::instant()));
		self::register("frosted_ice", new FrostedIce(new BID(Ids::FROSTED_ICE), "Frosted Ice", new BreakInfo(2.5, ToolType::PICKAXE)));
		self::register("furnace", new Furnace(new BID(Ids::FURNACE, TileNormalFurnace::class), "Furnace", new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
		self::register("blast_furnace", new Furnace(new BID(Ids::BLAST_FURNACE, TileBlastFurnace::class), "Blast Furnace", new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
		self::register("smoker", new Furnace(new BID(Ids::SMOKER, TileSmoker::class), "Smoker", new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));

		$glassBreakInfo = new BreakInfo(0.3);
		self::register("glass", new Glass(new BID(Ids::GLASS), "Glass", $glassBreakInfo));
		self::register("glass_pane", new GlassPane(new BID(Ids::GLASS_PANE), "Glass Pane", $glassBreakInfo));
		self::register("glowing_obsidian", new GlowingObsidian(new BID(Ids::GLOWING_OBSIDIAN), "Glowing Obsidian", new BreakInfo(10.0, ToolType::PICKAXE, ToolTier::DIAMOND()->getHarvestLevel(), 50.0)));
		self::register("glowstone", new Glowstone(new BID(Ids::GLOWSTONE), "Glowstone", new BreakInfo(0.3, ToolType::PICKAXE)));
		self::register("gold", new Opaque(new BID(Ids::GOLD), "Gold Block", new BreakInfo(3.0, ToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel(), 30.0)));

		$grassBreakInfo = new BreakInfo(0.6, ToolType::SHOVEL);
		self::register("grass", new Grass(new BID(Ids::GRASS), "Grass", $grassBreakInfo));
		self::register("grass_path", new GrassPath(new BID(Ids::GRASS_PATH), "Grass Path", $grassBreakInfo));
		self::register("gravel", new Gravel(new BID(Ids::GRAVEL), "Gravel", new BreakInfo(0.6, ToolType::SHOVEL)));

		$hardenedClayBreakInfo = new BreakInfo(1.25, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 21.0);
		self::register("hardened_clay", new HardenedClay(new BID(Ids::HARDENED_CLAY), "Hardened Clay", $hardenedClayBreakInfo));

		$hardenedGlassBreakInfo = new BreakInfo(10.0);
		self::register("hardened_glass", new HardenedGlass(new BID(Ids::HARDENED_GLASS), "Hardened Glass", $hardenedGlassBreakInfo));
		self::register("hardened_glass_pane", new HardenedGlassPane(new BID(Ids::HARDENED_GLASS_PANE), "Hardened Glass Pane", $hardenedGlassBreakInfo));
		self::register("hay_bale", new HayBale(new BID(Ids::HAY_BALE), "Hay Bale", new BreakInfo(0.5)));
		self::register("hopper", new Hopper(new BID(Ids::HOPPER, TileHopper::class), "Hopper", new BreakInfo(3.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 15.0)));
		self::register("ice", new Ice(new BID(Ids::ICE), "Ice", new BreakInfo(0.5, ToolType::PICKAXE)));

		$updateBlockBreakInfo = new BreakInfo(1.0);
		self::register("info_update", new Opaque(new BID(Ids::INFO_UPDATE), "update!", $updateBlockBreakInfo));
		self::register("info_update2", new Opaque(new BID(Ids::INFO_UPDATE2), "ate!upd", $updateBlockBreakInfo));
		self::register("invisible_bedrock", new Transparent(new BID(Ids::INVISIBLE_BEDROCK), "Invisible Bedrock", BreakInfo::indestructible()));

		$ironBreakInfo = new BreakInfo(5.0, ToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel(), 30.0);
		self::register("iron", new Opaque(new BID(Ids::IRON), "Iron Block", $ironBreakInfo));
		self::register("iron_bars", new Thin(new BID(Ids::IRON_BARS), "Iron Bars", $ironBreakInfo));
		$ironDoorBreakInfo = new BreakInfo(5.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 25.0);
		self::register("iron_door", new Door(new BID(Ids::IRON_DOOR), "Iron Door", $ironDoorBreakInfo));
		self::register("iron_trapdoor", new Trapdoor(new BID(Ids::IRON_TRAPDOOR), "Iron Trapdoor", $ironDoorBreakInfo));
		self::register("item_frame", new ItemFrame(new BID(Ids::ITEM_FRAME, TileItemFrame::class), "Item Frame", new BreakInfo(0.25)));
		self::register("jukebox", new Jukebox(new BID(Ids::JUKEBOX, TileJukebox::class), "Jukebox", new BreakInfo(0.8, ToolType::AXE))); //TODO: in PC the hardness is 2.0, not 0.8, unsure if this is a MCPE bug or not
		self::register("ladder", new Ladder(new BID(Ids::LADDER), "Ladder", new BreakInfo(0.4, ToolType::AXE)));

		$lanternBreakInfo = new BreakInfo(5.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel());
		self::register("lantern", new Lantern(new BID(Ids::LANTERN), "Lantern", $lanternBreakInfo, 15));
		self::register("soul_lantern", new Lantern(new BID(Ids::SOUL_LANTERN), "Soul Lantern", $lanternBreakInfo, 10));

		self::register("lapis_lazuli", new Opaque(new BID(Ids::LAPIS_LAZULI), "Lapis Lazuli Block", new BreakInfo(3.0, ToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel())));
		self::register("lava", new Lava(new BID(Ids::LAVA), "Lava", BreakInfo::indestructible(500.0)));
		self::register("lectern", new Lectern(new BID(Ids::LECTERN, TileLectern::class), "Lectern", new BreakInfo(2.0, ToolType::AXE)));
		self::register("lever", new Lever(new BID(Ids::LEVER), "Lever", new BreakInfo(0.5)));
		self::register("loom", new Loom(new BID(Ids::LOOM), "Loom", new BreakInfo(2.5, ToolType::AXE)));
		self::register("magma", new Magma(new BID(Ids::MAGMA), "Magma Block", new BreakInfo(0.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
		self::register("melon", new Melon(new BID(Ids::MELON), "Melon Block", new BreakInfo(1.0, ToolType::AXE)));
		self::register("melon_stem", new MelonStem(new BID(Ids::MELON_STEM), "Melon Stem", BreakInfo::instant()));
		self::register("monster_spawner", new MonsterSpawner(new BID(Ids::MONSTER_SPAWNER, TileMonsterSpawner::class), "Monster Spawner", new BreakInfo(5.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
		self::register("mycelium", new Mycelium(new BID(Ids::MYCELIUM), "Mycelium", new BreakInfo(0.6, ToolType::SHOVEL)));

		$netherBrickBreakInfo = new BreakInfo(2.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0);
		self::register("nether_bricks", new Opaque(new BID(Ids::NETHER_BRICKS), "Nether Bricks", $netherBrickBreakInfo));
		self::register("red_nether_bricks", new Opaque(new BID(Ids::RED_NETHER_BRICKS), "Red Nether Bricks", $netherBrickBreakInfo));
		self::register("nether_brick_fence", new Fence(new BID(Ids::NETHER_BRICK_FENCE), "Nether Brick Fence", $netherBrickBreakInfo));
		self::register("nether_brick_stairs", new Stair(new BID(Ids::NETHER_BRICK_STAIRS), "Nether Brick Stairs", $netherBrickBreakInfo));
		self::register("red_nether_brick_stairs", new Stair(new BID(Ids::RED_NETHER_BRICK_STAIRS), "Red Nether Brick Stairs", $netherBrickBreakInfo));
		self::register("chiseled_nether_bricks", new Opaque(new BID(Ids::CHISELED_NETHER_BRICKS), "Chiseled Nether Bricks", $netherBrickBreakInfo));
		self::register("cracked_nether_bricks", new Opaque(new BID(Ids::CRACKED_NETHER_BRICKS), "Cracked Nether Bricks", $netherBrickBreakInfo));

		self::register("nether_portal", new NetherPortal(new BID(Ids::NETHER_PORTAL), "Nether Portal", BreakInfo::indestructible(0.0)));
		self::register("nether_reactor_core", new NetherReactor(new BID(Ids::NETHER_REACTOR_CORE), "Nether Reactor Core", new BreakInfo(3.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
		self::register("nether_wart_block", new Opaque(new BID(Ids::NETHER_WART_BLOCK), "Nether Wart Block", new BreakInfo(1.0, ToolType::HOE)));
		self::register("nether_wart", new NetherWartPlant(new BID(Ids::NETHER_WART), "Nether Wart", BreakInfo::instant()));
		self::register("netherrack", new Netherrack(new BID(Ids::NETHERRACK), "Netherrack", new BreakInfo(0.4, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
		self::register("note_block", new Note(new BID(Ids::NOTE_BLOCK, TileNote::class), "Note Block", new BreakInfo(0.8, ToolType::AXE)));
		self::register("obsidian", new Opaque(new BID(Ids::OBSIDIAN), "Obsidian", new BreakInfo(35.0 /* 50 in PC */, ToolType::PICKAXE, ToolTier::DIAMOND()->getHarvestLevel(), 6000.0)));
		self::register("packed_ice", new PackedIce(new BID(Ids::PACKED_ICE), "Packed Ice", new BreakInfo(0.5, ToolType::PICKAXE)));
		self::register("podzol", new Podzol(new BID(Ids::PODZOL), "Podzol", new BreakInfo(0.5, ToolType::SHOVEL)));
		self::register("potatoes", new Potato(new BID(Ids::POTATOES), "Potato Block", BreakInfo::instant()));
		self::register("powered_rail", new PoweredRail(new BID(Ids::POWERED_RAIL), "Powered Rail", $railBreakInfo));

		$prismarineBreakInfo = new BreakInfo(1.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0);
		self::register("prismarine", new Opaque(new BID(Ids::PRISMARINE), "Prismarine", $prismarineBreakInfo));
		self::register("dark_prismarine", new Opaque(new BID(Ids::DARK_PRISMARINE), "Dark Prismarine", $prismarineBreakInfo));
		self::register("prismarine_bricks", new Opaque(new BID(Ids::PRISMARINE_BRICKS), "Prismarine Bricks", $prismarineBreakInfo));
		self::register("prismarine_bricks_stairs", new Stair(new BID(Ids::PRISMARINE_BRICKS_STAIRS), "Prismarine Bricks Stairs", $prismarineBreakInfo));
		self::register("dark_prismarine_stairs", new Stair(new BID(Ids::DARK_PRISMARINE_STAIRS), "Dark Prismarine Stairs", $prismarineBreakInfo));
		self::register("prismarine_stairs", new Stair(new BID(Ids::PRISMARINE_STAIRS), "Prismarine Stairs", $prismarineBreakInfo));

		$pumpkinBreakInfo = new BreakInfo(1.0, ToolType::AXE);
		self::register("pumpkin", new Pumpkin(new BID(Ids::PUMPKIN), "Pumpkin", $pumpkinBreakInfo));
		self::register("carved_pumpkin", new CarvedPumpkin(new BID(Ids::CARVED_PUMPKIN), "Carved Pumpkin", $pumpkinBreakInfo));
		self::register("lit_pumpkin", new LitPumpkin(new BID(Ids::LIT_PUMPKIN), "Jack o'Lantern", $pumpkinBreakInfo));

		self::register("pumpkin_stem", new PumpkinStem(new BID(Ids::PUMPKIN_STEM), "Pumpkin Stem", BreakInfo::instant()));

		$purpurBreakInfo = new BreakInfo(1.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0);
		self::register("purpur", new Opaque(new BID(Ids::PURPUR), "Purpur Block", $purpurBreakInfo));
		self::register("purpur_pillar", new SimplePillar(new BID(Ids::PURPUR_PILLAR), "Purpur Pillar", $purpurBreakInfo));
		self::register("purpur_stairs", new Stair(new BID(Ids::PURPUR_STAIRS), "Purpur Stairs", $purpurBreakInfo));

		$quartzBreakInfo = new BreakInfo(0.8, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel());
		self::register("quartz", new Opaque(new BID(Ids::QUARTZ), "Quartz Block", $quartzBreakInfo));
		self::register("chiseled_quartz", new SimplePillar(new BID(Ids::CHISELED_QUARTZ), "Chiseled Quartz Block", $quartzBreakInfo));
		self::register("quartz_pillar", new SimplePillar(new BID(Ids::QUARTZ_PILLAR), "Quartz Pillar", $quartzBreakInfo));
		self::register("smooth_quartz", new Opaque(new BID(Ids::SMOOTH_QUARTZ), "Smooth Quartz Block", $quartzBreakInfo));
		self::register("quartz_bricks", new Opaque(new BID(Ids::QUARTZ_BRICKS), "Quartz Bricks", $quartzBreakInfo));

		self::register("quartz_stairs", new Stair(new BID(Ids::QUARTZ_STAIRS), "Quartz Stairs", $quartzBreakInfo));
		self::register("smooth_quartz_stairs", new Stair(new BID(Ids::SMOOTH_QUARTZ_STAIRS), "Smooth Quartz Stairs", $quartzBreakInfo));

		self::register("rail", new Rail(new BID(Ids::RAIL), "Rail", $railBreakInfo));
		self::register("red_mushroom", new RedMushroom(new BID(Ids::RED_MUSHROOM), "Red Mushroom", BreakInfo::instant()));
		self::register("redstone", new Redstone(new BID(Ids::REDSTONE), "Redstone Block", new BreakInfo(5.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0)));
		self::register("redstone_comparator", new RedstoneComparator(new BID(Ids::REDSTONE_COMPARATOR, TileComparator::class), "Redstone Comparator", BreakInfo::instant()));
		self::register("redstone_lamp", new RedstoneLamp(new BID(Ids::REDSTONE_LAMP), "Redstone Lamp", new BreakInfo(0.3)));
		self::register("redstone_repeater", new RedstoneRepeater(new BID(Ids::REDSTONE_REPEATER), "Redstone Repeater", BreakInfo::instant()));
		self::register("redstone_torch", new RedstoneTorch(new BID(Ids::REDSTONE_TORCH), "Redstone Torch", BreakInfo::instant()));
		self::register("redstone_wire", new RedstoneWire(new BID(Ids::REDSTONE_WIRE), "Redstone", BreakInfo::instant()));
		self::register("reserved6", new Reserved6(new BID(Ids::RESERVED6), "reserved6", BreakInfo::instant()));

		$sandBreakInfo = new BreakInfo(0.5, ToolType::SHOVEL);
		self::register("sand", new Sand(new BID(Ids::SAND), "Sand", $sandBreakInfo));
		self::register("red_sand", new Sand(new BID(Ids::RED_SAND), "Red Sand", $sandBreakInfo));

		self::register("sea_lantern", new SeaLantern(new BID(Ids::SEA_LANTERN), "Sea Lantern", new BreakInfo(0.3)));
		self::register("sea_pickle", new SeaPickle(new BID(Ids::SEA_PICKLE), "Sea Pickle", BreakInfo::instant()));
		self::register("mob_head", new Skull(new BID(Ids::MOB_HEAD, TileSkull::class), "Mob Head", new BreakInfo(1.0)));
		self::register("slime", new Slime(new BID(Ids::SLIME), "Slime Block", BreakInfo::instant()));
		self::register("snow", new Snow(new BID(Ids::SNOW), "Snow Block", new BreakInfo(0.2, ToolType::SHOVEL, ToolTier::WOOD()->getHarvestLevel())));
		self::register("snow_layer", new SnowLayer(new BID(Ids::SNOW_LAYER), "Snow Layer", new BreakInfo(0.1, ToolType::SHOVEL, ToolTier::WOOD()->getHarvestLevel())));
		self::register("soul_sand", new SoulSand(new BID(Ids::SOUL_SAND), "Soul Sand", new BreakInfo(0.5, ToolType::SHOVEL)));
		self::register("sponge", new Sponge(new BID(Ids::SPONGE), "Sponge", new BreakInfo(0.6, ToolType::HOE)));
		$shulkerBoxBreakInfo = new BreakInfo(2, ToolType::PICKAXE);
		self::register("shulker_box", new ShulkerBox(new BID(Ids::SHULKER_BOX, TileShulkerBox::class), "Shulker Box", $shulkerBoxBreakInfo));

		$stoneBreakInfo = new BreakInfo(1.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0);
		self::register(
			"stone",
			$stone = new class(new BID(Ids::STONE), "Stone", $stoneBreakInfo) extends Opaque{
				public function getDropsForCompatibleTool(Item $item) : array{
					return [VanillaBlocks::COBBLESTONE()->asItem()];
				}

				public function isAffectedBySilkTouch() : bool{
					return true;
				}
			}
		);
		self::register("andesite", new Opaque(new BID(Ids::ANDESITE), "Andesite", $stoneBreakInfo));
		self::register("diorite", new Opaque(new BID(Ids::DIORITE), "Diorite", $stoneBreakInfo));
		self::register("granite", new Opaque(new BID(Ids::GRANITE), "Granite", $stoneBreakInfo));
		self::register("polished_andesite", new Opaque(new BID(Ids::POLISHED_ANDESITE), "Polished Andesite", $stoneBreakInfo));
		self::register("polished_diorite", new Opaque(new BID(Ids::POLISHED_DIORITE), "Polished Diorite", $stoneBreakInfo));
		self::register("polished_granite", new Opaque(new BID(Ids::POLISHED_GRANITE), "Polished Granite", $stoneBreakInfo));

		self::register("stone_bricks", $stoneBrick = new Opaque(new BID(Ids::STONE_BRICKS), "Stone Bricks", $stoneBreakInfo));
		self::register("mossy_stone_bricks", $mossyStoneBrick = new Opaque(new BID(Ids::MOSSY_STONE_BRICKS), "Mossy Stone Bricks", $stoneBreakInfo));
		self::register("cracked_stone_bricks", $crackedStoneBrick = new Opaque(new BID(Ids::CRACKED_STONE_BRICKS), "Cracked Stone Bricks", $stoneBreakInfo));
		self::register("chiseled_stone_bricks", $chiseledStoneBrick = new Opaque(new BID(Ids::CHISELED_STONE_BRICKS), "Chiseled Stone Bricks", $stoneBreakInfo));

		$infestedStoneBreakInfo = new BreakInfo(0.75, ToolType::PICKAXE);
		self::register("infested_stone", new InfestedStone(new BID(Ids::INFESTED_STONE), "Infested Stone", $infestedStoneBreakInfo, $stone));
		self::register("infested_stone_brick", new InfestedStone(new BID(Ids::INFESTED_STONE_BRICK), "Infested Stone Brick", $infestedStoneBreakInfo, $stoneBrick));
		self::register("infested_cobblestone", new InfestedStone(new BID(Ids::INFESTED_COBBLESTONE), "Infested Cobblestone", $infestedStoneBreakInfo, $cobblestone));
		self::register("infested_mossy_stone_brick", new InfestedStone(new BID(Ids::INFESTED_MOSSY_STONE_BRICK), "Infested Mossy Stone Brick", $infestedStoneBreakInfo, $mossyStoneBrick));
		self::register("infested_cracked_stone_brick", new InfestedStone(new BID(Ids::INFESTED_CRACKED_STONE_BRICK), "Infested Cracked Stone Brick", $infestedStoneBreakInfo, $crackedStoneBrick));
		self::register("infested_chiseled_stone_brick", new InfestedStone(new BID(Ids::INFESTED_CHISELED_STONE_BRICK), "Infested Chiseled Stone Brick", $infestedStoneBreakInfo, $chiseledStoneBrick));

		self::register("stone_stairs", new Stair(new BID(Ids::STONE_STAIRS), "Stone Stairs", $stoneBreakInfo));
		self::register("smooth_stone", new Opaque(new BID(Ids::SMOOTH_STONE), "Smooth Stone", $stoneBreakInfo));
		self::register("andesite_stairs", new Stair(new BID(Ids::ANDESITE_STAIRS), "Andesite Stairs", $stoneBreakInfo));
		self::register("diorite_stairs", new Stair(new BID(Ids::DIORITE_STAIRS), "Diorite Stairs", $stoneBreakInfo));
		self::register("granite_stairs", new Stair(new BID(Ids::GRANITE_STAIRS), "Granite Stairs", $stoneBreakInfo));
		self::register("polished_andesite_stairs", new Stair(new BID(Ids::POLISHED_ANDESITE_STAIRS), "Polished Andesite Stairs", $stoneBreakInfo));
		self::register("polished_diorite_stairs", new Stair(new BID(Ids::POLISHED_DIORITE_STAIRS), "Polished Diorite Stairs", $stoneBreakInfo));
		self::register("polished_granite_stairs", new Stair(new BID(Ids::POLISHED_GRANITE_STAIRS), "Polished Granite Stairs", $stoneBreakInfo));
		self::register("stone_brick_stairs", new Stair(new BID(Ids::STONE_BRICK_STAIRS), "Stone Brick Stairs", $stoneBreakInfo));
		self::register("mossy_stone_brick_stairs", new Stair(new BID(Ids::MOSSY_STONE_BRICK_STAIRS), "Mossy Stone Brick Stairs", $stoneBreakInfo));
		self::register("stone_button", new StoneButton(new BID(Ids::STONE_BUTTON), "Stone Button", new BreakInfo(0.5, ToolType::PICKAXE)));
		self::register("stonecutter", new Stonecutter(new BID(Ids::STONECUTTER), "Stonecutter", new BreakInfo(3.5, ToolType::PICKAXE)));
		self::register("stone_pressure_plate", new StonePressurePlate(new BID(Ids::STONE_PRESSURE_PLATE), "Stone Pressure Plate", new BreakInfo(0.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));

		//TODO: in the future this won't be the same for all the types
		$stoneSlabBreakInfo = new BreakInfo(2.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0);

		self::register("brick_slab", new Slab(new BID(Ids::BRICK_SLAB), "Brick", $stoneSlabBreakInfo));
		self::register("cobblestone_slab", new Slab(new BID(Ids::COBBLESTONE_SLAB), "Cobblestone", $stoneSlabBreakInfo));
		self::register("fake_wooden_slab", new Slab(new BID(Ids::FAKE_WOODEN_SLAB), "Fake Wooden", $stoneSlabBreakInfo));
		self::register("nether_brick_slab", new Slab(new BID(Ids::NETHER_BRICK_SLAB), "Nether Brick", $stoneSlabBreakInfo));
		self::register("quartz_slab", new Slab(new BID(Ids::QUARTZ_SLAB), "Quartz", $stoneSlabBreakInfo));
		self::register("sandstone_slab", new Slab(new BID(Ids::SANDSTONE_SLAB), "Sandstone", $stoneSlabBreakInfo));
		self::register("smooth_stone_slab", new Slab(new BID(Ids::SMOOTH_STONE_SLAB), "Smooth Stone", $stoneSlabBreakInfo));
		self::register("stone_brick_slab", new Slab(new BID(Ids::STONE_BRICK_SLAB), "Stone Brick", $stoneSlabBreakInfo));
		self::register("dark_prismarine_slab", new Slab(new BID(Ids::DARK_PRISMARINE_SLAB), "Dark Prismarine", $stoneSlabBreakInfo));
		self::register("mossy_cobblestone_slab", new Slab(new BID(Ids::MOSSY_COBBLESTONE_SLAB), "Mossy Cobblestone", $stoneSlabBreakInfo));
		self::register("prismarine_slab", new Slab(new BID(Ids::PRISMARINE_SLAB), "Prismarine", $stoneSlabBreakInfo));
		self::register("prismarine_bricks_slab", new Slab(new BID(Ids::PRISMARINE_BRICKS_SLAB), "Prismarine Bricks", $stoneSlabBreakInfo));
		self::register("purpur_slab", new Slab(new BID(Ids::PURPUR_SLAB), "Purpur", $stoneSlabBreakInfo));
		self::register("red_nether_brick_slab", new Slab(new BID(Ids::RED_NETHER_BRICK_SLAB), "Red Nether Brick", $stoneSlabBreakInfo));
		self::register("red_sandstone_slab", new Slab(new BID(Ids::RED_SANDSTONE_SLAB), "Red Sandstone", $stoneSlabBreakInfo));
		self::register("smooth_sandstone_slab", new Slab(new BID(Ids::SMOOTH_SANDSTONE_SLAB), "Smooth Sandstone", $stoneSlabBreakInfo));
		self::register("andesite_slab", new Slab(new BID(Ids::ANDESITE_SLAB), "Andesite", $stoneSlabBreakInfo));
		self::register("diorite_slab", new Slab(new BID(Ids::DIORITE_SLAB), "Diorite", $stoneSlabBreakInfo));
		self::register("end_stone_brick_slab", new Slab(new BID(Ids::END_STONE_BRICK_SLAB), "End Stone Brick", $stoneSlabBreakInfo));
		self::register("granite_slab", new Slab(new BID(Ids::GRANITE_SLAB), "Granite", $stoneSlabBreakInfo));
		self::register("polished_andesite_slab", new Slab(new BID(Ids::POLISHED_ANDESITE_SLAB), "Polished Andesite", $stoneSlabBreakInfo));
		self::register("polished_diorite_slab", new Slab(new BID(Ids::POLISHED_DIORITE_SLAB), "Polished Diorite", $stoneSlabBreakInfo));
		self::register("polished_granite_slab", new Slab(new BID(Ids::POLISHED_GRANITE_SLAB), "Polished Granite", $stoneSlabBreakInfo));
		self::register("smooth_red_sandstone_slab", new Slab(new BID(Ids::SMOOTH_RED_SANDSTONE_SLAB), "Smooth Red Sandstone", $stoneSlabBreakInfo));
		self::register("cut_red_sandstone_slab", new Slab(new BID(Ids::CUT_RED_SANDSTONE_SLAB), "Cut Red Sandstone", $stoneSlabBreakInfo));
		self::register("cut_sandstone_slab", new Slab(new BID(Ids::CUT_SANDSTONE_SLAB), "Cut Sandstone", $stoneSlabBreakInfo));
		self::register("mossy_stone_brick_slab", new Slab(new BID(Ids::MOSSY_STONE_BRICK_SLAB), "Mossy Stone Brick", $stoneSlabBreakInfo));
		self::register("smooth_quartz_slab", new Slab(new BID(Ids::SMOOTH_QUARTZ_SLAB), "Smooth Quartz", $stoneSlabBreakInfo));
		self::register("stone_slab", new Slab(new BID(Ids::STONE_SLAB), "Stone", $stoneSlabBreakInfo));

		self::register("legacy_stonecutter", new Opaque(new BID(Ids::LEGACY_STONECUTTER), "Legacy Stonecutter", new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
		self::register("sugarcane", new Sugarcane(new BID(Ids::SUGARCANE), "Sugarcane", BreakInfo::instant()));
		self::register("sweet_berry_bush", new SweetBerryBush(new BID(Ids::SWEET_BERRY_BUSH), "Sweet Berry Bush", BreakInfo::instant()));
		self::register("tnt", new TNT(new BID(Ids::TNT), "TNT", BreakInfo::instant()));
		self::register("fern", new TallGrass(new BID(Ids::FERN), "Fern", BreakInfo::instant(ToolType::SHEARS, 1)));
		self::register("tall_grass", new TallGrass(new BID(Ids::TALL_GRASS), "Tall Grass", BreakInfo::instant(ToolType::SHEARS, 1)));

		self::register("blue_torch", new Torch(new BID(Ids::BLUE_TORCH), "Blue Torch", BreakInfo::instant()));
		self::register("purple_torch", new Torch(new BID(Ids::PURPLE_TORCH), "Purple Torch", BreakInfo::instant()));
		self::register("red_torch", new Torch(new BID(Ids::RED_TORCH), "Red Torch", BreakInfo::instant()));
		self::register("green_torch", new Torch(new BID(Ids::GREEN_TORCH), "Green Torch", BreakInfo::instant()));
		self::register("torch", new Torch(new BID(Ids::TORCH), "Torch", BreakInfo::instant()));

		self::register("trapped_chest", new TrappedChest(new BID(Ids::TRAPPED_CHEST, TileChest::class), "Trapped Chest", $chestBreakInfo));
		self::register("tripwire", new Tripwire(new BID(Ids::TRIPWIRE), "Tripwire", BreakInfo::instant()));
		self::register("tripwire_hook", new TripwireHook(new BID(Ids::TRIPWIRE_HOOK), "Tripwire Hook", BreakInfo::instant()));
		self::register("underwater_torch", new UnderwaterTorch(new BID(Ids::UNDERWATER_TORCH), "Underwater Torch", BreakInfo::instant()));
		self::register("vines", new Vine(new BID(Ids::VINES), "Vines", new BreakInfo(0.2, ToolType::AXE)));
		self::register("water", new Water(new BID(Ids::WATER), "Water", BreakInfo::indestructible(500.0)));
		self::register("lily_pad", new WaterLily(new BID(Ids::LILY_PAD), "Lily Pad", BreakInfo::instant()));

		$weightedPressurePlateBreakInfo = new BreakInfo(0.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel());
		self::register("weighted_pressure_plate_heavy", new WeightedPressurePlateHeavy(new BID(Ids::WEIGHTED_PRESSURE_PLATE_HEAVY), "Weighted Pressure Plate Heavy", $weightedPressurePlateBreakInfo));
		self::register("weighted_pressure_plate_light", new WeightedPressurePlateLight(new BID(Ids::WEIGHTED_PRESSURE_PLATE_LIGHT), "Weighted Pressure Plate Light", $weightedPressurePlateBreakInfo));
		self::register("wheat", new Wheat(new BID(Ids::WHEAT), "Wheat Block", BreakInfo::instant()));

		$leavesBreakInfo = new class(0.2, ToolType::HOE) extends BreakInfo{
			public function getBreakTime(Item $item) : float{
				if($item->getBlockToolType() === ToolType::SHEARS){
					return 0.0;
				}
				return parent::getBreakTime($item);
			}
		};

		foreach(TreeType::getAll() as $treeType){
			$name = $treeType->getDisplayName();
			self::register($treeType->name() . "_sapling", new Sapling(BlockLegacyIdHelper::getSaplingIdentifier($treeType), $name . " Sapling", BreakInfo::instant(), $treeType));
			self::register($treeType->name() . "_leaves", new Leaves(BlockLegacyIdHelper::getLeavesIdentifier($treeType), $name . " Leaves", $leavesBreakInfo, $treeType));
		}

		$sandstoneBreakInfo = new BreakInfo(0.8, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel());
		self::register("red_sandstone_stairs", new Stair(new BID(Ids::RED_SANDSTONE_STAIRS), "Red Sandstone Stairs", $sandstoneBreakInfo));
		self::register("smooth_red_sandstone_stairs", new Stair(new BID(Ids::SMOOTH_RED_SANDSTONE_STAIRS), "Smooth Red Sandstone Stairs", $sandstoneBreakInfo));
		self::register("red_sandstone", new Opaque(new BID(Ids::RED_SANDSTONE), "Red Sandstone", $sandstoneBreakInfo));
		self::register("chiseled_red_sandstone", new Opaque(new BID(Ids::CHISELED_RED_SANDSTONE), "Chiseled Red Sandstone", $sandstoneBreakInfo));
		self::register("cut_red_sandstone", new Opaque(new BID(Ids::CUT_RED_SANDSTONE), "Cut Red Sandstone", $sandstoneBreakInfo));
		self::register("smooth_red_sandstone", new Opaque(new BID(Ids::SMOOTH_RED_SANDSTONE), "Smooth Red Sandstone", $sandstoneBreakInfo));

		self::register("sandstone_stairs", new Stair(new BID(Ids::SANDSTONE_STAIRS), "Sandstone Stairs", $sandstoneBreakInfo));
		self::register("smooth_sandstone_stairs", new Stair(new BID(Ids::SMOOTH_SANDSTONE_STAIRS), "Smooth Sandstone Stairs", $sandstoneBreakInfo));
		self::register("sandstone", new Opaque(new BID(Ids::SANDSTONE), "Sandstone", $sandstoneBreakInfo));
		self::register("chiseled_sandstone", new Opaque(new BID(Ids::CHISELED_SANDSTONE), "Chiseled Sandstone", $sandstoneBreakInfo));
		self::register("cut_sandstone", new Opaque(new BID(Ids::CUT_SANDSTONE), "Cut Sandstone", $sandstoneBreakInfo));
		self::register("smooth_sandstone", new Opaque(new BID(Ids::SMOOTH_SANDSTONE), "Smooth Sandstone", $sandstoneBreakInfo));

		self::register("glazed_terracotta", new GlazedTerracotta(new BID(Ids::GLAZED_TERRACOTTA), "Glazed Terracotta", new BreakInfo(1.4, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
		self::register("dyed_shulker_box", new DyedShulkerBox(new BID(Ids::DYED_SHULKER_BOX, TileShulkerBox::class), "Dyed Shulker Box", $shulkerBoxBreakInfo));
		self::register("stained_glass", new StainedGlass(new BID(Ids::STAINED_GLASS), "Stained Glass", $glassBreakInfo));
		self::register("stained_glass_pane", new StainedGlassPane(new BID(Ids::STAINED_GLASS_PANE), "Stained Glass Pane", $glassBreakInfo));
		self::register("stained_clay", new StainedHardenedClay(new BID(Ids::STAINED_CLAY), "Stained Clay", $hardenedClayBreakInfo));
		self::register("stained_hardened_glass", new StainedHardenedGlass(new BID(Ids::STAINED_HARDENED_GLASS), "Stained Hardened Glass", $hardenedGlassBreakInfo));
		self::register("stained_hardened_glass_pane", new StainedHardenedGlassPane(new BID(Ids::STAINED_HARDENED_GLASS_PANE), "Stained Hardened Glass Pane", $hardenedGlassBreakInfo));
		self::register("carpet", new Carpet(new BID(Ids::CARPET), "Carpet", new BreakInfo(0.1)));
		self::register("concrete", new Concrete(new BID(Ids::CONCRETE), "Concrete", new BreakInfo(1.8, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
		self::register("concrete_powder", new ConcretePowder(new BID(Ids::CONCRETE_POWDER), "Concrete Powder", new BreakInfo(0.5, ToolType::SHOVEL)));
		self::register("wool", new Wool(new BID(Ids::WOOL), "Wool", new class(0.8, ToolType::SHEARS) extends BreakInfo{
			public function getBreakTime(Item $item) : float{
				$time = parent::getBreakTime($item);
				if($item->getBlockToolType() === ToolType::SHEARS){
					$time *= 3; //shears break compatible blocks 15x faster, but wool 5x
				}

				return $time;
			}
		}));

		//TODO: in the future these won't all have the same hardness; they only do now because of the old metadata crap
		$wallBreakInfo = new BreakInfo(2.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0);
		self::register("cobblestone_wall", new Wall(new BID(Ids::COBBLESTONE_WALL), "Cobblestone Wall", $wallBreakInfo));
		self::register("andesite_wall", new Wall(new BID(Ids::ANDESITE_WALL), "Andesite Wall", $wallBreakInfo));
		self::register("brick_wall", new Wall(new BID(Ids::BRICK_WALL), "Brick Wall", $wallBreakInfo));
		self::register("diorite_wall", new Wall(new BID(Ids::DIORITE_WALL), "Diorite Wall", $wallBreakInfo));
		self::register("end_stone_brick_wall", new Wall(new BID(Ids::END_STONE_BRICK_WALL), "End Stone Brick Wall", $wallBreakInfo));
		self::register("granite_wall", new Wall(new BID(Ids::GRANITE_WALL), "Granite Wall", $wallBreakInfo));
		self::register("mossy_stone_brick_wall", new Wall(new BID(Ids::MOSSY_STONE_BRICK_WALL), "Mossy Stone Brick Wall", $wallBreakInfo));
		self::register("mossy_cobblestone_wall", new Wall(new BID(Ids::MOSSY_COBBLESTONE_WALL), "Mossy Cobblestone Wall", $wallBreakInfo));
		self::register("nether_brick_wall", new Wall(new BID(Ids::NETHER_BRICK_WALL), "Nether Brick Wall", $wallBreakInfo));
		self::register("prismarine_wall", new Wall(new BID(Ids::PRISMARINE_WALL), "Prismarine Wall", $wallBreakInfo));
		self::register("red_nether_brick_wall", new Wall(new BID(Ids::RED_NETHER_BRICK_WALL), "Red Nether Brick Wall", $wallBreakInfo));
		self::register("red_sandstone_wall", new Wall(new BID(Ids::RED_SANDSTONE_WALL), "Red Sandstone Wall", $wallBreakInfo));
		self::register("sandstone_wall", new Wall(new BID(Ids::SANDSTONE_WALL), "Sandstone Wall", $wallBreakInfo));
		self::register("stone_brick_wall", new Wall(new BID(Ids::STONE_BRICK_WALL), "Stone Brick Wall", $wallBreakInfo));

		self::registerElements();

		$chemistryTableBreakInfo = new BreakInfo(2.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel());
		self::register("compound_creator", new ChemistryTable(new BID(Ids::COMPOUND_CREATOR), "Compound Creator", $chemistryTableBreakInfo));
		self::register("element_constructor", new ChemistryTable(new BID(Ids::ELEMENT_CONSTRUCTOR), "Element Constructor", $chemistryTableBreakInfo));
		self::register("lab_table", new ChemistryTable(new BID(Ids::LAB_TABLE), "Lab Table", $chemistryTableBreakInfo));
		self::register("material_reducer", new ChemistryTable(new BID(Ids::MATERIAL_REDUCER), "Material Reducer", $chemistryTableBreakInfo));

		self::register("chemical_heat", new ChemicalHeat(new BID(Ids::CHEMICAL_HEAT), "Heat Block", $chemistryTableBreakInfo));

		self::registerMushroomBlocks();

		self::register("coral", new Coral(
			new BID(Ids::CORAL),
			"Coral",
			BreakInfo::instant(),
		));
		self::register("coral_fan", new FloorCoralFan(
			new BID(Ids::CORAL_FAN),
			"Coral Fan",
			BreakInfo::instant(),
		));
		self::register("wall_coral_fan", new WallCoralFan(
			new BID(Ids::WALL_CORAL_FAN),
			"Wall Coral Fan",
			BreakInfo::instant(),
		));

		self::registerBlocksR13();
		self::registerBlocksR14();
		self::registerBlocksR16();
		self::registerBlocksR17();
		self::registerMudBlocks();

		self::registerOres();
		self::registerWoodenBlocks();
	}

	private static function registerWoodenBlocks() : void{
		$planksBreakInfo = new BreakInfo(2.0, ToolType::AXE, 0, 15.0);
		$signBreakInfo = new BreakInfo(1.0, ToolType::AXE);
		$logBreakInfo = new BreakInfo(2.0, ToolType::AXE);
		$woodenDoorBreakInfo = new BreakInfo(3.0, ToolType::AXE, 0, 15.0);
		$woodenButtonBreakInfo = new BreakInfo(0.5, ToolType::AXE);
		$woodenPressurePlateBreakInfo = new BreakInfo(0.5, ToolType::AXE);

		foreach(WoodType::getAll() as $woodType){
			$name = $woodType->getDisplayName();
			$idName = fn(string $suffix) => $woodType->name() . "_" . $suffix;

			self::register($idName(mb_strtolower($woodType->getStandardLogSuffix() ?? "log", 'US-ASCII')), new Wood(BlockLegacyIdHelper::getLogIdentifier($woodType), $name . " " . ($woodType->getStandardLogSuffix() ?? "Log"), $logBreakInfo, $woodType));
			self::register($idName(mb_strtolower($woodType->getAllSidedLogSuffix() ?? "wood", 'US-ASCII')), new Wood(BlockLegacyIdHelper::getAllSidedLogIdentifier($woodType), $name . " " . ($woodType->getAllSidedLogSuffix() ?? "Wood"), $logBreakInfo, $woodType));

			self::register($idName("planks"), new Planks(BlockLegacyIdHelper::getWoodenPlanksIdentifier($woodType), $name . " Planks", $planksBreakInfo, $woodType));
			self::register($idName("fence"), new WoodenFence(BlockLegacyIdHelper::getWoodenFenceIdentifier($woodType), $name . " Fence", $planksBreakInfo, $woodType));
			self::register($idName("slab"), new WoodenSlab(BlockLegacyIdHelper::getWoodenSlabIdentifier($woodType), $name, $planksBreakInfo, $woodType));

			self::register($idName("fence_gate"), new FenceGate(BlockLegacyIdHelper::getWoodenFenceGateIdentifier($woodType), $name . " Fence Gate", $planksBreakInfo, $woodType));
			self::register($idName("stairs"), new WoodenStairs(BlockLegacyIdHelper::getWoodenStairsIdentifier($woodType), $name . " Stairs", $planksBreakInfo, $woodType));
			self::register($idName("door"), new WoodenDoor(BlockLegacyIdHelper::getWoodenDoorIdentifier($woodType), $name . " Door", $woodenDoorBreakInfo, $woodType));

			self::register($idName("button"), new WoodenButton(BlockLegacyIdHelper::getWoodenButtonIdentifier($woodType), $name . " Button", $woodenButtonBreakInfo, $woodType));
			self::register($idName("pressure_plate"), new WoodenPressurePlate(BlockLegacyIdHelper::getWoodenPressurePlateIdentifier($woodType), $name . " Pressure Plate", $woodenPressurePlateBreakInfo, $woodType));
			self::register($idName("trapdoor"), new WoodenTrapdoor(BlockLegacyIdHelper::getWoodenTrapdoorIdentifier($woodType), $name . " Trapdoor", $woodenDoorBreakInfo, $woodType));

			[$floorSignId, $wallSignId, $signAsItem] = BlockLegacyIdHelper::getWoodenSignInfo($woodType);
			self::register($idName("sign"), new FloorSign($floorSignId, $name . " Sign", $signBreakInfo, $woodType, $signAsItem));
			self::register($idName("wall_sign"), new WallSign($wallSignId, $name . " Wall Sign", $signBreakInfo, $woodType, $signAsItem));
		}
	}

	private static function registerMushroomBlocks() : void{
		$mushroomBlockBreakInfo = new BreakInfo(0.2, ToolType::AXE);

		self::register("brown_mushroom_block", new BrownMushroomBlock(new BID(Ids::BROWN_MUSHROOM_BLOCK), "Brown Mushroom Block", $mushroomBlockBreakInfo));
		self::register("red_mushroom_block", new RedMushroomBlock(new BID(Ids::RED_MUSHROOM_BLOCK), "Red Mushroom Block", $mushroomBlockBreakInfo));

		//finally, the stems
		self::register("mushroom_stem", new MushroomStem(new BID(Ids::MUSHROOM_STEM), "Mushroom Stem", $mushroomBlockBreakInfo));
		self::register("all_sided_mushroom_stem", new MushroomStem(new BID(Ids::ALL_SIDED_MUSHROOM_STEM), "All Sided Mushroom Stem", $mushroomBlockBreakInfo));
	}

	private static function registerElements() : void{
		$instaBreak = BreakInfo::instant();
		self::register("element_zero", new Opaque(new BID(Ids::ELEMENT_ZERO), "???", $instaBreak));

		self::register("element_hydrogen", new Element(new BID(Ids::ELEMENT_HYDROGEN), "Hydrogen", $instaBreak, "h", 1, 5));
		self::register("element_helium", new Element(new BID(Ids::ELEMENT_HELIUM), "Helium", $instaBreak, "he", 2, 7));
		self::register("element_lithium", new Element(new BID(Ids::ELEMENT_LITHIUM), "Lithium", $instaBreak, "li", 3, 0));
		self::register("element_beryllium", new Element(new BID(Ids::ELEMENT_BERYLLIUM), "Beryllium", $instaBreak, "be", 4, 1));
		self::register("element_boron", new Element(new BID(Ids::ELEMENT_BORON), "Boron", $instaBreak, "b", 5, 4));
		self::register("element_carbon", new Element(new BID(Ids::ELEMENT_CARBON), "Carbon", $instaBreak, "c", 6, 5));
		self::register("element_nitrogen", new Element(new BID(Ids::ELEMENT_NITROGEN), "Nitrogen", $instaBreak, "n", 7, 5));
		self::register("element_oxygen", new Element(new BID(Ids::ELEMENT_OXYGEN), "Oxygen", $instaBreak, "o", 8, 5));
		self::register("element_fluorine", new Element(new BID(Ids::ELEMENT_FLUORINE), "Fluorine", $instaBreak, "f", 9, 6));
		self::register("element_neon", new Element(new BID(Ids::ELEMENT_NEON), "Neon", $instaBreak, "ne", 10, 7));
		self::register("element_sodium", new Element(new BID(Ids::ELEMENT_SODIUM), "Sodium", $instaBreak, "na", 11, 0));
		self::register("element_magnesium", new Element(new BID(Ids::ELEMENT_MAGNESIUM), "Magnesium", $instaBreak, "mg", 12, 1));
		self::register("element_aluminum", new Element(new BID(Ids::ELEMENT_ALUMINUM), "Aluminum", $instaBreak, "al", 13, 3));
		self::register("element_silicon", new Element(new BID(Ids::ELEMENT_SILICON), "Silicon", $instaBreak, "si", 14, 4));
		self::register("element_phosphorus", new Element(new BID(Ids::ELEMENT_PHOSPHORUS), "Phosphorus", $instaBreak, "p", 15, 5));
		self::register("element_sulfur", new Element(new BID(Ids::ELEMENT_SULFUR), "Sulfur", $instaBreak, "s", 16, 5));
		self::register("element_chlorine", new Element(new BID(Ids::ELEMENT_CHLORINE), "Chlorine", $instaBreak, "cl", 17, 6));
		self::register("element_argon", new Element(new BID(Ids::ELEMENT_ARGON), "Argon", $instaBreak, "ar", 18, 7));
		self::register("element_potassium", new Element(new BID(Ids::ELEMENT_POTASSIUM), "Potassium", $instaBreak, "k", 19, 0));
		self::register("element_calcium", new Element(new BID(Ids::ELEMENT_CALCIUM), "Calcium", $instaBreak, "ca", 20, 1));
		self::register("element_scandium", new Element(new BID(Ids::ELEMENT_SCANDIUM), "Scandium", $instaBreak, "sc", 21, 2));
		self::register("element_titanium", new Element(new BID(Ids::ELEMENT_TITANIUM), "Titanium", $instaBreak, "ti", 22, 2));
		self::register("element_vanadium", new Element(new BID(Ids::ELEMENT_VANADIUM), "Vanadium", $instaBreak, "v", 23, 2));
		self::register("element_chromium", new Element(new BID(Ids::ELEMENT_CHROMIUM), "Chromium", $instaBreak, "cr", 24, 2));
		self::register("element_manganese", new Element(new BID(Ids::ELEMENT_MANGANESE), "Manganese", $instaBreak, "mn", 25, 2));
		self::register("element_iron", new Element(new BID(Ids::ELEMENT_IRON), "Iron", $instaBreak, "fe", 26, 2));
		self::register("element_cobalt", new Element(new BID(Ids::ELEMENT_COBALT), "Cobalt", $instaBreak, "co", 27, 2));
		self::register("element_nickel", new Element(new BID(Ids::ELEMENT_NICKEL), "Nickel", $instaBreak, "ni", 28, 2));
		self::register("element_copper", new Element(new BID(Ids::ELEMENT_COPPER), "Copper", $instaBreak, "cu", 29, 2));
		self::register("element_zinc", new Element(new BID(Ids::ELEMENT_ZINC), "Zinc", $instaBreak, "zn", 30, 2));
		self::register("element_gallium", new Element(new BID(Ids::ELEMENT_GALLIUM), "Gallium", $instaBreak, "ga", 31, 3));
		self::register("element_germanium", new Element(new BID(Ids::ELEMENT_GERMANIUM), "Germanium", $instaBreak, "ge", 32, 4));
		self::register("element_arsenic", new Element(new BID(Ids::ELEMENT_ARSENIC), "Arsenic", $instaBreak, "as", 33, 4));
		self::register("element_selenium", new Element(new BID(Ids::ELEMENT_SELENIUM), "Selenium", $instaBreak, "se", 34, 5));
		self::register("element_bromine", new Element(new BID(Ids::ELEMENT_BROMINE), "Bromine", $instaBreak, "br", 35, 6));
		self::register("element_krypton", new Element(new BID(Ids::ELEMENT_KRYPTON), "Krypton", $instaBreak, "kr", 36, 7));
		self::register("element_rubidium", new Element(new BID(Ids::ELEMENT_RUBIDIUM), "Rubidium", $instaBreak, "rb", 37, 0));
		self::register("element_strontium", new Element(new BID(Ids::ELEMENT_STRONTIUM), "Strontium", $instaBreak, "sr", 38, 1));
		self::register("element_yttrium", new Element(new BID(Ids::ELEMENT_YTTRIUM), "Yttrium", $instaBreak, "y", 39, 2));
		self::register("element_zirconium", new Element(new BID(Ids::ELEMENT_ZIRCONIUM), "Zirconium", $instaBreak, "zr", 40, 2));
		self::register("element_niobium", new Element(new BID(Ids::ELEMENT_NIOBIUM), "Niobium", $instaBreak, "nb", 41, 2));
		self::register("element_molybdenum", new Element(new BID(Ids::ELEMENT_MOLYBDENUM), "Molybdenum", $instaBreak, "mo", 42, 2));
		self::register("element_technetium", new Element(new BID(Ids::ELEMENT_TECHNETIUM), "Technetium", $instaBreak, "tc", 43, 2));
		self::register("element_ruthenium", new Element(new BID(Ids::ELEMENT_RUTHENIUM), "Ruthenium", $instaBreak, "ru", 44, 2));
		self::register("element_rhodium", new Element(new BID(Ids::ELEMENT_RHODIUM), "Rhodium", $instaBreak, "rh", 45, 2));
		self::register("element_palladium", new Element(new BID(Ids::ELEMENT_PALLADIUM), "Palladium", $instaBreak, "pd", 46, 2));
		self::register("element_silver", new Element(new BID(Ids::ELEMENT_SILVER), "Silver", $instaBreak, "ag", 47, 2));
		self::register("element_cadmium", new Element(new BID(Ids::ELEMENT_CADMIUM), "Cadmium", $instaBreak, "cd", 48, 2));
		self::register("element_indium", new Element(new BID(Ids::ELEMENT_INDIUM), "Indium", $instaBreak, "in", 49, 3));
		self::register("element_tin", new Element(new BID(Ids::ELEMENT_TIN), "Tin", $instaBreak, "sn", 50, 3));
		self::register("element_antimony", new Element(new BID(Ids::ELEMENT_ANTIMONY), "Antimony", $instaBreak, "sb", 51, 4));
		self::register("element_tellurium", new Element(new BID(Ids::ELEMENT_TELLURIUM), "Tellurium", $instaBreak, "te", 52, 4));
		self::register("element_iodine", new Element(new BID(Ids::ELEMENT_IODINE), "Iodine", $instaBreak, "i", 53, 6));
		self::register("element_xenon", new Element(new BID(Ids::ELEMENT_XENON), "Xenon", $instaBreak, "xe", 54, 7));
		self::register("element_cesium", new Element(new BID(Ids::ELEMENT_CESIUM), "Cesium", $instaBreak, "cs", 55, 0));
		self::register("element_barium", new Element(new BID(Ids::ELEMENT_BARIUM), "Barium", $instaBreak, "ba", 56, 1));
		self::register("element_lanthanum", new Element(new BID(Ids::ELEMENT_LANTHANUM), "Lanthanum", $instaBreak, "la", 57, 8));
		self::register("element_cerium", new Element(new BID(Ids::ELEMENT_CERIUM), "Cerium", $instaBreak, "ce", 58, 8));
		self::register("element_praseodymium", new Element(new BID(Ids::ELEMENT_PRASEODYMIUM), "Praseodymium", $instaBreak, "pr", 59, 8));
		self::register("element_neodymium", new Element(new BID(Ids::ELEMENT_NEODYMIUM), "Neodymium", $instaBreak, "nd", 60, 8));
		self::register("element_promethium", new Element(new BID(Ids::ELEMENT_PROMETHIUM), "Promethium", $instaBreak, "pm", 61, 8));
		self::register("element_samarium", new Element(new BID(Ids::ELEMENT_SAMARIUM), "Samarium", $instaBreak, "sm", 62, 8));
		self::register("element_europium", new Element(new BID(Ids::ELEMENT_EUROPIUM), "Europium", $instaBreak, "eu", 63, 8));
		self::register("element_gadolinium", new Element(new BID(Ids::ELEMENT_GADOLINIUM), "Gadolinium", $instaBreak, "gd", 64, 8));
		self::register("element_terbium", new Element(new BID(Ids::ELEMENT_TERBIUM), "Terbium", $instaBreak, "tb", 65, 8));
		self::register("element_dysprosium", new Element(new BID(Ids::ELEMENT_DYSPROSIUM), "Dysprosium", $instaBreak, "dy", 66, 8));
		self::register("element_holmium", new Element(new BID(Ids::ELEMENT_HOLMIUM), "Holmium", $instaBreak, "ho", 67, 8));
		self::register("element_erbium", new Element(new BID(Ids::ELEMENT_ERBIUM), "Erbium", $instaBreak, "er", 68, 8));
		self::register("element_thulium", new Element(new BID(Ids::ELEMENT_THULIUM), "Thulium", $instaBreak, "tm", 69, 8));
		self::register("element_ytterbium", new Element(new BID(Ids::ELEMENT_YTTERBIUM), "Ytterbium", $instaBreak, "yb", 70, 8));
		self::register("element_lutetium", new Element(new BID(Ids::ELEMENT_LUTETIUM), "Lutetium", $instaBreak, "lu", 71, 8));
		self::register("element_hafnium", new Element(new BID(Ids::ELEMENT_HAFNIUM), "Hafnium", $instaBreak, "hf", 72, 2));
		self::register("element_tantalum", new Element(new BID(Ids::ELEMENT_TANTALUM), "Tantalum", $instaBreak, "ta", 73, 2));
		self::register("element_tungsten", new Element(new BID(Ids::ELEMENT_TUNGSTEN), "Tungsten", $instaBreak, "w", 74, 2));
		self::register("element_rhenium", new Element(new BID(Ids::ELEMENT_RHENIUM), "Rhenium", $instaBreak, "re", 75, 2));
		self::register("element_osmium", new Element(new BID(Ids::ELEMENT_OSMIUM), "Osmium", $instaBreak, "os", 76, 2));
		self::register("element_iridium", new Element(new BID(Ids::ELEMENT_IRIDIUM), "Iridium", $instaBreak, "ir", 77, 2));
		self::register("element_platinum", new Element(new BID(Ids::ELEMENT_PLATINUM), "Platinum", $instaBreak, "pt", 78, 2));
		self::register("element_gold", new Element(new BID(Ids::ELEMENT_GOLD), "Gold", $instaBreak, "au", 79, 2));
		self::register("element_mercury", new Element(new BID(Ids::ELEMENT_MERCURY), "Mercury", $instaBreak, "hg", 80, 2));
		self::register("element_thallium", new Element(new BID(Ids::ELEMENT_THALLIUM), "Thallium", $instaBreak, "tl", 81, 3));
		self::register("element_lead", new Element(new BID(Ids::ELEMENT_LEAD), "Lead", $instaBreak, "pb", 82, 3));
		self::register("element_bismuth", new Element(new BID(Ids::ELEMENT_BISMUTH), "Bismuth", $instaBreak, "bi", 83, 3));
		self::register("element_polonium", new Element(new BID(Ids::ELEMENT_POLONIUM), "Polonium", $instaBreak, "po", 84, 4));
		self::register("element_astatine", new Element(new BID(Ids::ELEMENT_ASTATINE), "Astatine", $instaBreak, "at", 85, 6));
		self::register("element_radon", new Element(new BID(Ids::ELEMENT_RADON), "Radon", $instaBreak, "rn", 86, 7));
		self::register("element_francium", new Element(new BID(Ids::ELEMENT_FRANCIUM), "Francium", $instaBreak, "fr", 87, 0));
		self::register("element_radium", new Element(new BID(Ids::ELEMENT_RADIUM), "Radium", $instaBreak, "ra", 88, 1));
		self::register("element_actinium", new Element(new BID(Ids::ELEMENT_ACTINIUM), "Actinium", $instaBreak, "ac", 89, 9));
		self::register("element_thorium", new Element(new BID(Ids::ELEMENT_THORIUM), "Thorium", $instaBreak, "th", 90, 9));
		self::register("element_protactinium", new Element(new BID(Ids::ELEMENT_PROTACTINIUM), "Protactinium", $instaBreak, "pa", 91, 9));
		self::register("element_uranium", new Element(new BID(Ids::ELEMENT_URANIUM), "Uranium", $instaBreak, "u", 92, 9));
		self::register("element_neptunium", new Element(new BID(Ids::ELEMENT_NEPTUNIUM), "Neptunium", $instaBreak, "np", 93, 9));
		self::register("element_plutonium", new Element(new BID(Ids::ELEMENT_PLUTONIUM), "Plutonium", $instaBreak, "pu", 94, 9));
		self::register("element_americium", new Element(new BID(Ids::ELEMENT_AMERICIUM), "Americium", $instaBreak, "am", 95, 9));
		self::register("element_curium", new Element(new BID(Ids::ELEMENT_CURIUM), "Curium", $instaBreak, "cm", 96, 9));
		self::register("element_berkelium", new Element(new BID(Ids::ELEMENT_BERKELIUM), "Berkelium", $instaBreak, "bk", 97, 9));
		self::register("element_californium", new Element(new BID(Ids::ELEMENT_CALIFORNIUM), "Californium", $instaBreak, "cf", 98, 9));
		self::register("element_einsteinium", new Element(new BID(Ids::ELEMENT_EINSTEINIUM), "Einsteinium", $instaBreak, "es", 99, 9));
		self::register("element_fermium", new Element(new BID(Ids::ELEMENT_FERMIUM), "Fermium", $instaBreak, "fm", 100, 9));
		self::register("element_mendelevium", new Element(new BID(Ids::ELEMENT_MENDELEVIUM), "Mendelevium", $instaBreak, "md", 101, 9));
		self::register("element_nobelium", new Element(new BID(Ids::ELEMENT_NOBELIUM), "Nobelium", $instaBreak, "no", 102, 9));
		self::register("element_lawrencium", new Element(new BID(Ids::ELEMENT_LAWRENCIUM), "Lawrencium", $instaBreak, "lr", 103, 9));
		self::register("element_rutherfordium", new Element(new BID(Ids::ELEMENT_RUTHERFORDIUM), "Rutherfordium", $instaBreak, "rf", 104, 2));
		self::register("element_dubnium", new Element(new BID(Ids::ELEMENT_DUBNIUM), "Dubnium", $instaBreak, "db", 105, 2));
		self::register("element_seaborgium", new Element(new BID(Ids::ELEMENT_SEABORGIUM), "Seaborgium", $instaBreak, "sg", 106, 2));
		self::register("element_bohrium", new Element(new BID(Ids::ELEMENT_BOHRIUM), "Bohrium", $instaBreak, "bh", 107, 2));
		self::register("element_hassium", new Element(new BID(Ids::ELEMENT_HASSIUM), "Hassium", $instaBreak, "hs", 108, 2));
		self::register("element_meitnerium", new Element(new BID(Ids::ELEMENT_MEITNERIUM), "Meitnerium", $instaBreak, "mt", 109, 2));
		self::register("element_darmstadtium", new Element(new BID(Ids::ELEMENT_DARMSTADTIUM), "Darmstadtium", $instaBreak, "ds", 110, 2));
		self::register("element_roentgenium", new Element(new BID(Ids::ELEMENT_ROENTGENIUM), "Roentgenium", $instaBreak, "rg", 111, 2));
		self::register("element_copernicium", new Element(new BID(Ids::ELEMENT_COPERNICIUM), "Copernicium", $instaBreak, "cn", 112, 2));
		self::register("element_nihonium", new Element(new BID(Ids::ELEMENT_NIHONIUM), "Nihonium", $instaBreak, "nh", 113, 3));
		self::register("element_flerovium", new Element(new BID(Ids::ELEMENT_FLEROVIUM), "Flerovium", $instaBreak, "fl", 114, 3));
		self::register("element_moscovium", new Element(new BID(Ids::ELEMENT_MOSCOVIUM), "Moscovium", $instaBreak, "mc", 115, 3));
		self::register("element_livermorium", new Element(new BID(Ids::ELEMENT_LIVERMORIUM), "Livermorium", $instaBreak, "lv", 116, 3));
		self::register("element_tennessine", new Element(new BID(Ids::ELEMENT_TENNESSINE), "Tennessine", $instaBreak, "ts", 117, 6));
		self::register("element_oganesson", new Element(new BID(Ids::ELEMENT_OGANESSON), "Oganesson", $instaBreak, "og", 118, 7));
	}

	private static function registerOres() : void{
		$stoneOreBreakInfo = fn(ToolTier $toolTier) => new BreakInfo(3.0, ToolType::PICKAXE, $toolTier->getHarvestLevel());
		self::register("coal_ore", new CoalOre(new BID(Ids::COAL_ORE), "Coal Ore", $stoneOreBreakInfo(ToolTier::WOOD())));
		self::register("copper_ore", new CopperOre(new BID(Ids::COPPER_ORE), "Copper Ore", $stoneOreBreakInfo(ToolTier::STONE())));
		self::register("diamond_ore", new DiamondOre(new BID(Ids::DIAMOND_ORE), "Diamond Ore", $stoneOreBreakInfo(ToolTier::IRON())));
		self::register("emerald_ore", new EmeraldOre(new BID(Ids::EMERALD_ORE), "Emerald Ore", $stoneOreBreakInfo(ToolTier::IRON())));
		self::register("gold_ore", new GoldOre(new BID(Ids::GOLD_ORE), "Gold Ore", $stoneOreBreakInfo(ToolTier::IRON())));
		self::register("iron_ore", new IronOre(new BID(Ids::IRON_ORE), "Iron Ore", $stoneOreBreakInfo(ToolTier::STONE())));
		self::register("lapis_lazuli_ore", new LapisOre(new BID(Ids::LAPIS_LAZULI_ORE), "Lapis Lazuli Ore", $stoneOreBreakInfo(ToolTier::STONE())));
		self::register("redstone_ore", new RedstoneOre(new BID(Ids::REDSTONE_ORE), "Redstone Ore", $stoneOreBreakInfo(ToolTier::IRON())));

		$deepslateOreBreakInfo = fn(ToolTier $toolTier) => new BreakInfo(4.5, ToolType::PICKAXE, $toolTier->getHarvestLevel());
		self::register("deepslate_coal_ore", new CoalOre(new BID(Ids::DEEPSLATE_COAL_ORE), "Deepslate Coal Ore", $deepslateOreBreakInfo(ToolTier::WOOD())));
		self::register("deepslate_copper_ore", new CopperOre(new BID(Ids::DEEPSLATE_COPPER_ORE), "Deepslate Copper Ore", $deepslateOreBreakInfo(ToolTier::STONE())));
		self::register("deepslate_diamond_ore", new DiamondOre(new BID(Ids::DEEPSLATE_DIAMOND_ORE), "Deepslate Diamond Ore", $deepslateOreBreakInfo(ToolTier::IRON())));
		self::register("deepslate_emerald_ore", new EmeraldOre(new BID(Ids::DEEPSLATE_EMERALD_ORE), "Deepslate Emerald Ore", $deepslateOreBreakInfo(ToolTier::IRON())));
		self::register("deepslate_gold_ore", new GoldOre(new BID(Ids::DEEPSLATE_GOLD_ORE), "Deepslate Gold Ore", $deepslateOreBreakInfo(ToolTier::IRON())));
		self::register("deepslate_iron_ore", new IronOre(new BID(Ids::DEEPSLATE_IRON_ORE), "Deepslate Iron Ore", $deepslateOreBreakInfo(ToolTier::STONE())));
		self::register("deepslate_lapis_lazuli_ore", new LapisOre(new BID(Ids::DEEPSLATE_LAPIS_LAZULI_ORE), "Deepslate Lapis Lazuli Ore", $deepslateOreBreakInfo(ToolTier::STONE())));
		self::register("deepslate_redstone_ore", new RedstoneOre(new BID(Ids::DEEPSLATE_REDSTONE_ORE), "Deepslate Redstone Ore", $deepslateOreBreakInfo(ToolTier::IRON())));

		$netherrackOreBreakInfo = new BreakInfo(3.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel());
		self::register("nether_quartz_ore", new NetherQuartzOre(new BID(Ids::NETHER_QUARTZ_ORE), "Nether Quartz Ore", $netherrackOreBreakInfo));
		self::register("nether_gold_ore", new NetherGoldOre(new BID(Ids::NETHER_GOLD_ORE), "Nether Gold Ore", $netherrackOreBreakInfo));
	}

	private static function registerBlocksR13() : void{
		self::register("light", new Light(new BID(Ids::LIGHT), "Light Block", BreakInfo::indestructible()));
	}

	private static function registerBlocksR14() : void{
		self::register("honeycomb", new Opaque(new BID(Ids::HONEYCOMB), "Honeycomb Block", new BreakInfo(0.6)));
	}

	private static function registerBlocksR16() : void{
		//for some reason, slabs have weird hardness like the legacy ones
		$slabBreakInfo = new BreakInfo(2.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0);

		self::register("ancient_debris", new Opaque(new BID(Ids::ANCIENT_DEBRIS), "Ancient Debris", new BreakInfo(30, ToolType::PICKAXE, ToolTier::DIAMOND()->getHarvestLevel(), 3600.0)));

		$basaltBreakInfo = new BreakInfo(1.25, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 21.0);
		self::register("basalt", new SimplePillar(new BID(Ids::BASALT), "Basalt", $basaltBreakInfo));
		self::register("polished_basalt", new SimplePillar(new BID(Ids::POLISHED_BASALT), "Polished Basalt", $basaltBreakInfo));
		self::register("smooth_basalt", new Opaque(new BID(Ids::SMOOTH_BASALT), "Smooth Basalt", $basaltBreakInfo));

		$blackstoneBreakInfo = new BreakInfo(1.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0);
		self::register("blackstone", new Opaque(new BID(Ids::BLACKSTONE), "Blackstone", $blackstoneBreakInfo));
		self::register("blackstone_slab", new Slab(new BID(Ids::BLACKSTONE_SLAB), "Blackstone", $slabBreakInfo));
		self::register("blackstone_stairs", new Stair(new BID(Ids::BLACKSTONE_STAIRS), "Blackstone Stairs", $blackstoneBreakInfo));
		self::register("blackstone_wall", new Wall(new BID(Ids::BLACKSTONE_WALL), "Blackstone Wall", $blackstoneBreakInfo));

		self::register("gilded_blackstone", new GildedBlackstone(new BID(Ids::GILDED_BLACKSTONE), "Gilded Blackstone", $blackstoneBreakInfo));

		//TODO: polished blackstone ought to have 2.0 hardness (as per java) but it's 1.5 in Bedrock (probably parity bug)
		$prefix = fn(string $thing) => "Polished Blackstone" . ($thing !== "" ? " $thing" : "");
		self::register("polished_blackstone", new Opaque(new BID(Ids::POLISHED_BLACKSTONE), $prefix(""), $blackstoneBreakInfo));
		self::register("polished_blackstone_button", new StoneButton(new BID(Ids::POLISHED_BLACKSTONE_BUTTON), $prefix("Button"), new BreakInfo(0.5, ToolType::PICKAXE)));
		self::register("polished_blackstone_pressure_plate", new StonePressurePlate(new BID(Ids::POLISHED_BLACKSTONE_PRESSURE_PLATE), $prefix("Pressure Plate"), new BreakInfo(0.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
		self::register("polished_blackstone_slab", new Slab(new BID(Ids::POLISHED_BLACKSTONE_SLAB), $prefix(""), $slabBreakInfo));
		self::register("polished_blackstone_stairs", new Stair(new BID(Ids::POLISHED_BLACKSTONE_STAIRS), $prefix("Stairs"), $blackstoneBreakInfo));
		self::register("polished_blackstone_wall", new Wall(new BID(Ids::POLISHED_BLACKSTONE_WALL), $prefix("Wall"), $blackstoneBreakInfo));
		self::register("chiseled_polished_blackstone", new Opaque(new BID(Ids::CHISELED_POLISHED_BLACKSTONE), "Chiseled Polished Blackstone", $blackstoneBreakInfo));

		$prefix = fn(string $thing) => "Polished Blackstone Brick" . ($thing !== "" ? " $thing" : "");
		self::register("polished_blackstone_bricks", new Opaque(new BID(Ids::POLISHED_BLACKSTONE_BRICKS), "Polished Blackstone Bricks", $blackstoneBreakInfo));
		self::register("polished_blackstone_brick_slab", new Slab(new BID(Ids::POLISHED_BLACKSTONE_BRICK_SLAB), "Polished Blackstone Brick", $slabBreakInfo));
		self::register("polished_blackstone_brick_stairs", new Stair(new BID(Ids::POLISHED_BLACKSTONE_BRICK_STAIRS), $prefix("Stairs"), $blackstoneBreakInfo));
		self::register("polished_blackstone_brick_wall", new Wall(new BID(Ids::POLISHED_BLACKSTONE_BRICK_WALL), $prefix("Wall"), $blackstoneBreakInfo));
		self::register("cracked_polished_blackstone_bricks", new Opaque(new BID(Ids::CRACKED_POLISHED_BLACKSTONE_BRICKS), "Cracked Polished Blackstone Bricks", $blackstoneBreakInfo));

		self::register("soul_torch", new Torch(new BID(Ids::SOUL_TORCH), "Soul Torch", BreakInfo::instant()));
		self::register("soul_fire", new SoulFire(new BID(Ids::SOUL_FIRE), "Soul Fire", BreakInfo::instant()));

		//TODO: soul soul ought to have 0.5 hardness (as per java) but it's 1.0 in Bedrock (probably parity bug)
		self::register("soul_soil", new Opaque(new BID(Ids::SOUL_SOIL), "Soul Soil", new BreakInfo(1.0, ToolType::SHOVEL)));

		self::register("shroomlight", new class(new BID(Ids::SHROOMLIGHT), "Shroomlight", new BreakInfo(1.0, ToolType::HOE)) extends Opaque{
			public function getLightLevel() : int{ return 15; }
		});

		self::register("warped_wart_block", new Opaque(new BID(Ids::WARPED_WART_BLOCK), "Warped Wart Block", new BreakInfo(1.0, ToolType::HOE)));
		self::register("crying_obsidian", new class(new BID(Ids::CRYING_OBSIDIAN), "Crying Obsidian", new BreakInfo(35.0 /* 50 in Java */, ToolType::PICKAXE, ToolTier::DIAMOND()->getHarvestLevel())) extends Opaque{
			public function getLightLevel() : int{ return 10;}
		});
	}

	private static function registerBlocksR17() : void{
		//in java this can be acquired using any tool - seems to be a parity issue in bedrock
		self::register("amethyst", new Opaque(new BID(Ids::AMETHYST), "Amethyst", new BreakInfo(1.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));

		self::register("calcite", new Opaque(new BID(Ids::CALCITE), "Calcite", new BreakInfo(0.75, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel())));
		self::register("tuff", new Opaque(new BID(Ids::TUFF), "Tuff", new BreakInfo(1.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0)));

		self::register("raw_copper", new Opaque(new BID(Ids::RAW_COPPER), "Raw Copper Block", new BreakInfo(5, ToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel(), 30.0)));
		self::register("raw_gold", new Opaque(new BID(Ids::RAW_GOLD), "Raw Gold Block", new BreakInfo(5, ToolType::PICKAXE, ToolTier::IRON()->getHarvestLevel(), 30.0)));
		self::register("raw_iron", new Opaque(new BID(Ids::RAW_IRON), "Raw Iron Block", new BreakInfo(5, ToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel(), 30.0)));

		$deepslateBreakInfo = new BreakInfo(3, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 18.0);
		self::register("deepslate", new SimplePillar(new BID(Ids::DEEPSLATE), "Deepslate", $deepslateBreakInfo));

		//TODO: parity issue here - in Java this has a hardness of 3.0, but in bedrock it's 3.5
		self::register("chiseled_deepslate", new Opaque(new BID(Ids::CHISELED_DEEPSLATE), "Chiseled Deepslate", new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 18.0)));

		$deepslateBrickBreakInfo = new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 18.0);
		self::register("deepslate_bricks", new Opaque(new BID(Ids::DEEPSLATE_BRICKS), "Deepslate Bricks", $deepslateBrickBreakInfo));
		self::register("deepslate_brick_slab", new Slab(new BID(Ids::DEEPSLATE_BRICK_SLAB), "Deepslate Brick", $deepslateBrickBreakInfo));
		self::register("deepslate_brick_stairs", new Stair(new BID(Ids::DEEPSLATE_BRICK_STAIRS), "Deepslate Brick Stairs", $deepslateBrickBreakInfo));
		self::register("deepslate_brick_wall", new Wall(new BID(Ids::DEEPSLATE_BRICK_WALL), "Deepslate Brick Wall", $deepslateBrickBreakInfo));
		self::register("cracked_deepslate_bricks", new Opaque(new BID(Ids::CRACKED_DEEPSLATE_BRICKS), "Cracked Deepslate Bricks", $deepslateBrickBreakInfo));

		$deepslateTilesBreakInfo = new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 18.0);
		self::register("deepslate_tiles", new Opaque(new BID(Ids::DEEPSLATE_TILES), "Deepslate Tiles", $deepslateTilesBreakInfo));
		self::register("deepslate_tile_slab", new Slab(new BID(Ids::DEEPSLATE_TILE_SLAB), "Deepslate Tile", $deepslateTilesBreakInfo));
		self::register("deepslate_tile_stairs", new Stair(new BID(Ids::DEEPSLATE_TILE_STAIRS), "Deepslate Tile Stairs", $deepslateTilesBreakInfo));
		self::register("deepslate_tile_wall", new Wall(new BID(Ids::DEEPSLATE_TILE_WALL), "Deepslate Tile Wall", $deepslateTilesBreakInfo));
		self::register("cracked_deepslate_tiles", new Opaque(new BID(Ids::CRACKED_DEEPSLATE_TILES), "Cracked Deepslate Tiles", $deepslateTilesBreakInfo));

		$cobbledDeepslateBreakInfo = new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 18.0);
		self::register("cobbled_deepslate", new Opaque(new BID(Ids::COBBLED_DEEPSLATE), "Cobbled Deepslate", $cobbledDeepslateBreakInfo));
		self::register("cobbled_deepslate_slab", new Slab(new BID(Ids::COBBLED_DEEPSLATE_SLAB), "Cobbled Deepslate", $cobbledDeepslateBreakInfo));
		self::register("cobbled_deepslate_stairs", new Stair(new BID(Ids::COBBLED_DEEPSLATE_STAIRS), "Cobbled Deepslate Stairs", $cobbledDeepslateBreakInfo));
		self::register("cobbled_deepslate_wall", new Wall(new BID(Ids::COBBLED_DEEPSLATE_WALL), "Cobbled Deepslate Wall", $cobbledDeepslateBreakInfo));

		$polishedDeepslateBreakInfo = new BreakInfo(3.5, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 18.0);
		self::register("polished_deepslate", new Opaque(new BID(Ids::POLISHED_DEEPSLATE), "Polished Deepslate", $polishedDeepslateBreakInfo));
		self::register("polished_deepslate_slab", new Slab(new BID(Ids::POLISHED_DEEPSLATE_SLAB), "Polished Deepslate", $polishedDeepslateBreakInfo));
		self::register("polished_deepslate_stairs", new Stair(new BID(Ids::POLISHED_DEEPSLATE_STAIRS), "Polished Deepslate Stairs", $polishedDeepslateBreakInfo));
		self::register("polished_deepslate_wall", new Wall(new BID(Ids::POLISHED_DEEPSLATE_WALL), "Polished Deepslate Wall", $polishedDeepslateBreakInfo));

		self::register("tinted_glass", new TintedGlass(new BID(Ids::TINTED_GLASS), "Tinted Glass", new BreakInfo(0.3)));

		//blast resistance should be 30 if we were matched with java :(
		$copperBreakInfo = new BreakInfo(3.0, ToolType::PICKAXE, ToolTier::STONE()->getHarvestLevel(), 18.0);
		self::register("lightning_rod", new LightningRod(new BID(Ids::LIGHTNING_ROD), "Lightning Rod", $copperBreakInfo));

		self::register("copper", new Copper(new BID(Ids::COPPER), "Copper Block", $copperBreakInfo));
		self::register("cut_copper", new Copper(new BID(Ids::CUT_COPPER), "Cut Copper Block", $copperBreakInfo));
		self::register("cut_copper_slab", new CopperSlab(new BID(Ids::CUT_COPPER_SLAB), "Cut Copper Slab", $copperBreakInfo));
		self::register("cut_copper_stairs", new CopperStairs(new BID(Ids::CUT_COPPER_STAIRS), "Cut Copper Stairs", $copperBreakInfo));
	}

	private static function registerMudBlocks() : void{
		$mudBricksBreakInfo = new BreakInfo(2.0, ToolType::PICKAXE, ToolTier::WOOD()->getHarvestLevel(), 30.0);

		self::register("mud_bricks", new Opaque(new BID(Ids::MUD_BRICKS), "Mud Bricks", $mudBricksBreakInfo));
		self::register("mud_brick_slab", new Slab(new BID(Ids::MUD_BRICK_SLAB), "Mud Brick", $mudBricksBreakInfo));
		self::register("mud_brick_stairs", new Stair(new BID(Ids::MUD_BRICK_STAIRS), "Mud Brick Stairs", $mudBricksBreakInfo));
		self::register("mud_brick_wall", new Wall(new BID(Ids::MUD_BRICK_WALL), "Mud Brick Wall", $mudBricksBreakInfo));
	}

}
