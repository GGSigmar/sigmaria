<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200710172416 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE campaign_session (id INT AUTO_INCREMENT NOT NULL, campaign_id INT DEFAULT NULL, number INT NOT NULL, name VARCHAR(80) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_78FE49F8F639F774 (campaign_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campaign_quest_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, handle VARCHAR(80) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_DF5AD6D4918020D9 (handle), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campaign_quest (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, quest_status_id INT DEFAULT NULL, reward LONGTEXT DEFAULT NULL, name VARCHAR(80) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_D129C7864D218E (location_id), INDEX IDX_D129C78CDAA0D65 (quest_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campaign_player_character (id INT AUTO_INCREMENT NOT NULL, ancestry_id INT DEFAULT NULL, heritage_id INT DEFAULT NULL, background_id INT DEFAULT NULL, class_id INT DEFAULT NULL, campaign_id INT DEFAULT NULL, name VARCHAR(80) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_5ED6D66989001A93 (ancestry_id), INDEX IDX_5ED6D669C2CAC1EF (heritage_id), INDEX IDX_5ED6D669C93D69EA (background_id), INDEX IDX_5ED6D669EA000B10 (class_id), INDEX IDX_5ED6D669F639F774 (campaign_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campaign_campaign (id INT AUTO_INCREMENT NOT NULL, current_level INT NOT NULL, name VARCHAR(80) NOT NULL, slug VARCHAR(128) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campaign_campaign_player_character (campaign_id INT NOT NULL, player_character_id INT NOT NULL, INDEX IDX_77313D0EF639F774 (campaign_id), INDEX IDX_77313D0E910BEE57 (player_character_id), PRIMARY KEY(campaign_id, player_character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE campaign_session ADD CONSTRAINT FK_78FE49F8F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign_campaign (id)');
        $this->addSql('ALTER TABLE campaign_quest ADD CONSTRAINT FK_D129C7864D218E FOREIGN KEY (location_id) REFERENCES setting_location (id)');
        $this->addSql('ALTER TABLE campaign_quest ADD CONSTRAINT FK_D129C78CDAA0D65 FOREIGN KEY (quest_status_id) REFERENCES campaign_quest_status (id)');
        $this->addSql('ALTER TABLE campaign_player_character ADD CONSTRAINT FK_5ED6D66989001A93 FOREIGN KEY (ancestry_id) REFERENCES ancestry_ancestry (id)');
        $this->addSql('ALTER TABLE campaign_player_character ADD CONSTRAINT FK_5ED6D669C2CAC1EF FOREIGN KEY (heritage_id) REFERENCES ancestry_heritage (id)');
        $this->addSql('ALTER TABLE campaign_player_character ADD CONSTRAINT FK_5ED6D669C93D69EA FOREIGN KEY (background_id) REFERENCES setting_background (id)');
        $this->addSql('ALTER TABLE campaign_player_character ADD CONSTRAINT FK_5ED6D669EA000B10 FOREIGN KEY (class_id) REFERENCES core_character_class (id)');
        $this->addSql('ALTER TABLE campaign_player_character ADD CONSTRAINT FK_5ED6D669F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign_campaign (id)');
        $this->addSql('ALTER TABLE campaign_campaign_player_character ADD CONSTRAINT FK_77313D0EF639F774 FOREIGN KEY (campaign_id) REFERENCES campaign_campaign (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campaign_campaign_player_character ADD CONSTRAINT FK_77313D0E910BEE57 FOREIGN KEY (player_character_id) REFERENCES campaign_player_character (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE campaign_quest DROP FOREIGN KEY FK_D129C78CDAA0D65');
        $this->addSql('ALTER TABLE campaign_campaign_player_character DROP FOREIGN KEY FK_77313D0E910BEE57');
        $this->addSql('ALTER TABLE campaign_session DROP FOREIGN KEY FK_78FE49F8F639F774');
        $this->addSql('ALTER TABLE campaign_player_character DROP FOREIGN KEY FK_5ED6D669F639F774');
        $this->addSql('ALTER TABLE campaign_campaign_player_character DROP FOREIGN KEY FK_77313D0EF639F774');
        $this->addSql('DROP TABLE campaign_session');
        $this->addSql('DROP TABLE campaign_quest_status');
        $this->addSql('DROP TABLE campaign_quest');
        $this->addSql('DROP TABLE campaign_player_character');
        $this->addSql('DROP TABLE campaign_campaign');
        $this->addSql('DROP TABLE campaign_campaign_player_character');
    }
}
