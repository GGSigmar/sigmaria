<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200710153921 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE setting_location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, description LONGTEXT DEFAULT NULL, slug VARCHAR(128) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location_paragraph (location_id INT NOT NULL, paragraph_id INT NOT NULL, INDEX IDX_33064E1464D218E (location_id), INDEX IDX_33064E148B50597F (paragraph_id), PRIMARY KEY(location_id, paragraph_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE setting_location_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, handle VARCHAR(80) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_E5A1CBB3918020D9 (handle), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE location_paragraph ADD CONSTRAINT FK_33064E1464D218E FOREIGN KEY (location_id) REFERENCES setting_location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE location_paragraph ADD CONSTRAINT FK_33064E148B50597F FOREIGN KEY (paragraph_id) REFERENCES core_paragraph (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE core_attribute_category DROP is_active');
        $this->addSql('ALTER TABLE core_rarity DROP is_active');
        $this->addSql('ALTER TABLE core_ability DROP is_active');
        $this->addSql('ALTER TABLE core_skill DROP is_active');
        $this->addSql('ALTER TABLE core_size DROP is_active');
        $this->addSql('ALTER TABLE core_move_speed DROP is_active');
        $this->addSql('ALTER TABLE core_character_class DROP is_active');
        $this->addSql('ALTER TABLE core_actions DROP is_active');
        $this->addSql('ALTER TABLE ancestry_ancestral_hit_points DROP is_active');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE location_paragraph DROP FOREIGN KEY FK_33064E1464D218E');
        $this->addSql('DROP TABLE setting_location');
        $this->addSql('DROP TABLE location_paragraph');
        $this->addSql('DROP TABLE setting_location_type');
        $this->addSql('ALTER TABLE ancestry_ancestral_hit_points ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE core_ability ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE core_actions ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE core_attribute_category ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE core_character_class ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE core_move_speed ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE core_rarity ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE core_size ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE core_skill ADD is_active TINYINT(1) NOT NULL');
    }
}
