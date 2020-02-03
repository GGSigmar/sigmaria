<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200203213052 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ancestry_ancestry ADD rarity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ancestry_ancestry ADD CONSTRAINT FK_5801B642F3747573 FOREIGN KEY (rarity_id) REFERENCES core_rarity (id)');
        $this->addSql('CREATE INDEX IDX_5801B642F3747573 ON ancestry_ancestry (rarity_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ancestry_ancestry DROP FOREIGN KEY FK_5801B642F3747573');
        $this->addSql('DROP INDEX IDX_5801B642F3747573 ON ancestry_ancestry');
        $this->addSql('ALTER TABLE ancestry_ancestry DROP rarity_id');
    }
}
