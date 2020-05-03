<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200503150429 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE core_feat ADD source_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE core_feat ADD CONSTRAINT FK_687E52FE953C1C61 FOREIGN KEY (source_id) REFERENCES core_entity_source (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_687E52FE953C1C61 ON core_feat (source_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE core_feat DROP FOREIGN KEY FK_687E52FE953C1C61');
        $this->addSql('DROP INDEX UNIQ_687E52FE953C1C61 ON core_feat');
        $this->addSql('ALTER TABLE core_feat DROP source_id');
    }
}
