<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210117104101 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE core_feat ADD edits_id INT DEFAULT NULL, ADD is_edit TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE core_feat ADD CONSTRAINT FK_687E52FE41F3128D FOREIGN KEY (edits_id) REFERENCES core_feat (id)');
        $this->addSql('CREATE INDEX IDX_687E52FE41F3128D ON core_feat (edits_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE core_feat DROP FOREIGN KEY FK_687E52FE41F3128D');
        $this->addSql('DROP INDEX IDX_687E52FE41F3128D ON core_feat');
        $this->addSql('ALTER TABLE core_feat DROP edits_id, DROP is_edit');
    }
}
