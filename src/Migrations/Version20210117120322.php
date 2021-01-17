<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210117120322 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE core_feat ADD edit_parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE core_feat ADD CONSTRAINT FK_687E52FE30E35CB8 FOREIGN KEY (edit_parent_id) REFERENCES core_feat (id)');
        $this->addSql('CREATE INDEX IDX_687E52FE30E35CB8 ON core_feat (edit_parent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE core_feat DROP FOREIGN KEY FK_687E52FE30E35CB8');
        $this->addSql('DROP INDEX IDX_687E52FE30E35CB8 ON core_feat');
        $this->addSql('ALTER TABLE core_feat DROP edit_parent_id');
    }
}
