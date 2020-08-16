<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Core\Ability;
use App\Entity\Core\Actions;
use App\Entity\Core\AttributeCategory;
use App\Entity\Core\CharacterClass;
use App\Entity\Core\Rarity;
use App\Entity\Core\Size;
use App\Entity\Core\Skill;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200816173807 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql(sprintf('UPDATE core_actions SET name = \'%s\' WHERE handle = \'%s\'', 'One Action', Actions::ACTIONS_ONE));
        $this->addSql(sprintf('UPDATE core_actions SET name = \'%s\' WHERE handle = \'%s\'', 'Two Actions', Actions::ACTIONS_TWO));
        $this->addSql(sprintf('UPDATE core_actions SET name = \'%s\' WHERE handle = \'%s\'', 'Three Actions', Actions::ACTIONS_THREE));
        $this->addSql(sprintf('UPDATE core_actions SET name = \'%s\' WHERE handle = \'%s\'', 'Free Action', Actions::ACTIONS_FREE));
        $this->addSql(sprintf('UPDATE core_actions SET name = \'%s\' WHERE handle = \'%s\'', 'Reaction', Actions::ACTIONS_REACTION));

        $this->addSql(sprintf('UPDATE core_attribute_category SET name = \'%s\' WHERE handle = \'%s\'', 'General Traits', AttributeCategory::ATTRIBUTE_CATEGORY_GENERAL));
        $this->addSql(sprintf('UPDATE core_attribute_category SET name = \'%s\' WHERE handle = \'%s\'', 'Ancestral Traits', AttributeCategory::ATTRIBUTE_CATEGORY_ANCESTRAL));
        $this->addSql(sprintf('UPDATE core_attribute_category SET name = \'%s\' WHERE handle = \'%s\'', 'Class Traits', AttributeCategory::ATTRIBUTE_CATEGORY_CLASS));
        $this->addSql(sprintf('UPDATE core_attribute_category SET name = \'%s\' WHERE handle = \'%s\'', 'Cultural Traits', AttributeCategory::ATTRIBUTE_CATEGORY_CULTURAL));
        $this->addSql(sprintf('UPDATE core_attribute_category SET name = \'%s\' WHERE handle = \'%s\'', 'Heritage Traits', AttributeCategory::ATTRIBUTE_CATEGORY_HERITAGE));

        $this->addSql(sprintf('UPDATE core_character_class SET name = \'%s\' WHERE handle = \'%s\'', 'Alchemist', CharacterClass::CHARACTER_CLASS_ALCHEMIST));
        $this->addSql(sprintf('UPDATE core_character_class SET name = \'%s\' WHERE handle = \'%s\'', 'Barbarian', CharacterClass::CHARACTER_CLASS_BARBARIAN));
        $this->addSql(sprintf('UPDATE core_character_class SET name = \'%s\' WHERE handle = \'%s\'', 'Bard', CharacterClass::CHARACTER_CLASS_BARD));
        $this->addSql(sprintf('UPDATE core_character_class SET name = \'%s\' WHERE handle = \'%s\'', 'Champion', CharacterClass::CHARACTER_CLASS_CHAMPION));

        $this->addSql(sprintf('UPDATE core_character_class SET name = \'%s\' WHERE handle = \'%s\'', 'Cleirc', CharacterClass::CHARACTER_CLASS_CLERIC));
        $this->addSql(sprintf('UPDATE core_character_class SET name = \'%s\' WHERE handle = \'%s\'', 'Druid', CharacterClass::CHARACTER_CLASS_DRUID));
        $this->addSql(sprintf('UPDATE core_character_class SET name = \'%s\' WHERE handle = \'%s\'', 'Fighter', CharacterClass::CHARACTER_CLASS_FIGHTER));
        $this->addSql(sprintf('UPDATE core_character_class SET name = \'%s\' WHERE handle = \'%s\'', 'Monk', CharacterClass::CHARACTER_CLASS_MONK));

        $this->addSql(sprintf('UPDATE core_character_class SET name = \'%s\' WHERE handle = \'%s\'', 'Ranger', CharacterClass::CHARACTER_CLASS_RANGER));
        $this->addSql(sprintf('UPDATE core_character_class SET name = \'%s\' WHERE handle = \'%s\'', 'Rogue', CharacterClass::CHARACTER_CLASS_ROGUE));
        $this->addSql(sprintf('UPDATE core_character_class SET name = \'%s\' WHERE handle = \'%s\'', 'Sorcerer', CharacterClass::CHARACTER_CLASS_SORCERER));
        $this->addSql(sprintf('UPDATE core_character_class SET name = \'%s\' WHERE handle = \'%s\'', 'Wizard', CharacterClass::CHARACTER_CLASS_WIZARD));

        $this->addSql(sprintf('UPDATE core_character_class SET name = \'%s\' WHERE handle = \'%s\'', 'Investigator', CharacterClass::CHARACTER_CLASS_INVESTIGATOR));
        $this->addSql(sprintf('UPDATE core_character_class SET name = \'%s\' WHERE handle = \'%s\'', 'Oracle', CharacterClass::CHARACTER_CLASS_ORACLE));
        $this->addSql(sprintf('UPDATE core_character_class SET name = \'%s\' WHERE handle = \'%s\'', 'Swashbuckler', CharacterClass::CHARACTER_CLASS_SWASHBUCKLER));
        $this->addSql(sprintf('UPDATE core_character_class SET name = \'%s\' WHERE handle = \'%s\'', 'Witch', CharacterClass::CHARACTER_CLASS_WITCH));

        $this->addSql(sprintf('UPDATE core_rarity SET name = \'%s\' WHERE handle = \'%s\'', 'Common', Rarity::RARITY_COMMON));
        $this->addSql(sprintf('UPDATE core_rarity SET name = \'%s\' WHERE handle = \'%s\'', 'Uncommon', Rarity::RARITY_UNCOMMON));
        $this->addSql(sprintf('UPDATE core_rarity SET name = \'%s\' WHERE handle = \'%s\'', 'Rare', Rarity::RARITY_RARE));
        $this->addSql(sprintf('UPDATE core_rarity SET name = \'%s\' WHERE handle = \'%s\'', 'Unique', Rarity::RARITY_UNIQUE));

        $this->addSql(sprintf('UPDATE core_size SET name = \'%s\' WHERE handle = \'%s\'', 'Tiny', Size::SIZE_TINY));
        $this->addSql(sprintf('UPDATE core_size SET name = \'%s\' WHERE handle = \'%s\'', 'Small', Size::SIZE_SMALL));
        $this->addSql(sprintf('UPDATE core_size SET name = \'%s\' WHERE handle = \'%s\'', 'Medium', Size::SIZE_MEDIUM));
        $this->addSql(sprintf('UPDATE core_size SET name = \'%s\' WHERE handle = \'%s\'', 'Large', Size::SIZE_LARGE));
        $this->addSql(sprintf('UPDATE core_size SET name = \'%s\' WHERE handle = \'%s\'', 'Huge', Size::SIZE_HUGE));
        $this->addSql(sprintf('UPDATE core_size SET name = \'%s\' WHERE handle = \'%s\'', 'Gargantuan', Size::SIZE_GARGANTUAN));

        $this->addSql(sprintf('UPDATE core_skill SET name = \'%s\' WHERE handle = \'%s\'', 'Acrobatics', Skill::SKILL_ACROBATICS));
        $this->addSql(sprintf('UPDATE core_skill SET name = \'%s\' WHERE handle = \'%s\'', 'Arcana', Skill::SKILL_ARCANA));
        $this->addSql(sprintf('UPDATE core_skill SET name = \'%s\' WHERE handle = \'%s\'', 'Athletics', Skill::SKILL_ATHLETICS));
        $this->addSql(sprintf('UPDATE core_skill SET name = \'%s\' WHERE handle = \'%s\'', 'Crafting', Skill::SKILL_CRAFTING));

        $this->addSql(sprintf('UPDATE core_skill SET name = \'%s\' WHERE handle = \'%s\'', 'Deception', Skill::SKILL_DECEPTION));
        $this->addSql(sprintf('UPDATE core_skill SET name = \'%s\' WHERE handle = \'%s\'', 'Diplomacy', Skill::SKILL_DIPLOMACY));
        $this->addSql(sprintf('UPDATE core_skill SET name = \'%s\' WHERE handle = \'%s\'', 'Intimidation', Skill::SKILL_INTIMIDATION));
        $this->addSql(sprintf('UPDATE core_skill SET name = \'%s\' WHERE handle = \'%s\'', 'Medicine', Skill::SKILL_MEDICINE));

        $this->addSql(sprintf('UPDATE core_skill SET name = \'%s\' WHERE handle = \'%s\'', 'Nature', Skill::SKILL_NATURE));
        $this->addSql(sprintf('UPDATE core_skill SET name = \'%s\' WHERE handle = \'%s\'', 'Occultism', Skill::SKILL_OCCULTISM));
        $this->addSql(sprintf('UPDATE core_skill SET name = \'%s\' WHERE handle = \'%s\'', 'Performance', Skill::SKILL_PERFORMANCE));
        $this->addSql(sprintf('UPDATE core_skill SET name = \'%s\' WHERE handle = \'%s\'', 'Religion', Skill::SKILL_RELIGION));

        $this->addSql(sprintf('UPDATE core_skill SET name = \'%s\' WHERE handle = \'%s\'', 'Society', Skill::SKILL_SOCIETY));
        $this->addSql(sprintf('UPDATE core_skill SET name = \'%s\' WHERE handle = \'%s\'', 'Stealth', Skill::SKILL_STEALTH));
        $this->addSql(sprintf('UPDATE core_skill SET name = \'%s\' WHERE handle = \'%s\'', 'Survival', Skill::SKILL_SURVIVAL));
        $this->addSql(sprintf('UPDATE core_skill SET name = \'%s\' WHERE handle = \'%s\'', 'Thievery', Skill::SKILL_THIEVERY));

        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
