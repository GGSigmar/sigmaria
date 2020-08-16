<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Core\Ability;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200816172946 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql(sprintf('UPDATE core_ability SET name = \'%s\' WHERE handle = \'%s\'', 'Strength', Ability::ABILITY_STRENGTH));
        $this->addSql(sprintf('UPDATE core_ability SET name = \'%s\' WHERE handle = \'%s\'', 'Dexterity', Ability::ABILITY_DEXTERITY));
        $this->addSql(sprintf('UPDATE core_ability SET name = \'%s\' WHERE handle = \'%s\'', 'Constitution', Ability::ABILITY_CONSTITUTION));
        $this->addSql(sprintf('UPDATE core_ability SET name = \'%s\' WHERE handle = \'%s\'', 'Intelligence', Ability::ABILITY_INTELLIGENCE));
        $this->addSql(sprintf('UPDATE core_ability SET name = \'%s\' WHERE handle = \'%s\'', 'Wisdom', Ability::ABILITY_WISDOM));
        $this->addSql(sprintf('UPDATE core_ability SET name = \'%s\' WHERE handle = \'%s\'', 'Charisma', Ability::ABILITY_CHARISMA));

        $this->addSql(sprintf('UPDATE core_ability SET abbreviation = \'%s\' WHERE handle = \'%s\'', Ability::ABILITY_STRENGTH_ABBREVIATION, Ability::ABILITY_STRENGTH));
        $this->addSql(sprintf('UPDATE core_ability SET abbreviation = \'%s\' WHERE handle = \'%s\'', Ability::ABILITY_DEXTERITY_ABBREVIATION, Ability::ABILITY_DEXTERITY));
        $this->addSql(sprintf('UPDATE core_ability SET abbreviation = \'%s\' WHERE handle = \'%s\'', Ability::ABILITY_CONSTITUTION_ABBREVIATION, Ability::ABILITY_CONSTITUTION));
        $this->addSql(sprintf('UPDATE core_ability SET abbreviation = \'%s\' WHERE handle = \'%s\'', Ability::ABILITY_INTELLIGENCE_ABBREVIATION, Ability::ABILITY_INTELLIGENCE));
        $this->addSql(sprintf('UPDATE core_ability SET abbreviation = \'%s\' WHERE handle = \'%s\'', Ability::ABILITY_WISDOM_ABBREVIATION, Ability::ABILITY_WISDOM));
        $this->addSql(sprintf('UPDATE core_ability SET abbreviation = \'%s\' WHERE handle = \'%s\'', Ability::ABILITY_CHARISMA_ABBREVIATION, Ability::ABILITY_CHARISMA));
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
