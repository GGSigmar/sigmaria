<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200503144747 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE core_entity_source (id INT AUTO_INCREMENT NOT NULL, source_id INT DEFAULT NULL, source_starting_page_number INT DEFAULT NULL, source_ending_page_number INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_13E22BA1953C1C61 (source_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE core_entity_source ADD CONSTRAINT FK_13E22BA1953C1C61 FOREIGN KEY (source_id) REFERENCES core_source (id)');
        $this->addSql('ALTER TABLE core_feat DROP FOREIGN KEY FK_687E52FE953C1C61');
        $this->addSql('DROP INDEX IDX_687E52FE953C1C61 ON core_feat');
        $this->addSql('ALTER TABLE core_feat CHANGE source_id old_source_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE core_feat ADD CONSTRAINT FK_687E52FED08858D0 FOREIGN KEY (old_source_id) REFERENCES core_source (id)');
        $this->addSql('CREATE INDEX IDX_687E52FED08858D0 ON core_feat (old_source_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE core_entity_source');
        $this->addSql('ALTER TABLE core_feat DROP FOREIGN KEY FK_687E52FED08858D0');
        $this->addSql('DROP INDEX IDX_687E52FED08858D0 ON core_feat');
        $this->addSql('ALTER TABLE core_feat CHANGE old_source_id source_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE core_feat ADD CONSTRAINT FK_687E52FE953C1C61 FOREIGN KEY (source_id) REFERENCES core_source (id)');
        $this->addSql('CREATE INDEX IDX_687E52FE953C1C61 ON core_feat (source_id)');
    }
}
