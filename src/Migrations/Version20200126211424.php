<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200126211424 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ancestry_heritage (id INT AUTO_INCREMENT NOT NULL, rarity_id INT DEFAULT NULL, release_id INT DEFAULT NULL, name VARCHAR(80) NOT NULL, handle VARCHAR(80) NOT NULL, description LONGTEXT DEFAULT NULL, is_active TINYINT(1) NOT NULL, is_to_be_released TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_ECBD26D5918020D9 (handle), INDEX IDX_ECBD26D5F3747573 (rarity_id), INDEX IDX_ECBD26D5B12A727D (release_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ancestry_heritage_ancestral_feature (heritage_id INT NOT NULL, ancestral_feature_id INT NOT NULL, INDEX IDX_5CFA183C2CAC1EF (heritage_id), INDEX IDX_5CFA183D7DB66BF (ancestral_feature_id), PRIMARY KEY(heritage_id, ancestral_feature_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ancestry_heritage ADD CONSTRAINT FK_ECBD26D5F3747573 FOREIGN KEY (rarity_id) REFERENCES core_rarity (id)');
        $this->addSql('ALTER TABLE ancestry_heritage ADD CONSTRAINT FK_ECBD26D5B12A727D FOREIGN KEY (release_id) REFERENCES core_release (id)');
        $this->addSql('ALTER TABLE ancestry_heritage_ancestral_feature ADD CONSTRAINT FK_5CFA183C2CAC1EF FOREIGN KEY (heritage_id) REFERENCES ancestry_heritage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ancestry_heritage_ancestral_feature ADD CONSTRAINT FK_5CFA183D7DB66BF FOREIGN KEY (ancestral_feature_id) REFERENCES ancestry_ancestral_feature (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ancestry_heritage_ancestral_feature DROP FOREIGN KEY FK_5CFA183C2CAC1EF');
        $this->addSql('DROP TABLE ancestry_heritage');
        $this->addSql('DROP TABLE ancestry_heritage_ancestral_feature');
    }
}
