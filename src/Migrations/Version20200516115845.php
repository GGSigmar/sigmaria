<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200516115845 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ancestry_ancestry ADD slug VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE ancestry_heritage ADD slug VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE core_release ADD slug VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE setting_background ADD slug VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE setting_culture ADD slug VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE setting_language ADD slug VARCHAR(128) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ancestry_ancestry DROP slug');
        $this->addSql('ALTER TABLE ancestry_heritage DROP slug');
        $this->addSql('ALTER TABLE core_release DROP slug');
        $this->addSql('ALTER TABLE setting_background DROP slug');
        $this->addSql('ALTER TABLE setting_culture DROP slug');
        $this->addSql('ALTER TABLE setting_language DROP slug');
    }
}
