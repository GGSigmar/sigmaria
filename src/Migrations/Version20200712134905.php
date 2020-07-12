<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200712134905 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE setting_location ADD release_id INT DEFAULT NULL, ADD is_to_be_released TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE setting_location ADD CONSTRAINT FK_F017B131B12A727D FOREIGN KEY (release_id) REFERENCES core_release (id)');
        $this->addSql('CREATE INDEX IDX_F017B131B12A727D ON setting_location (release_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE setting_location DROP FOREIGN KEY FK_F017B131B12A727D');
        $this->addSql('DROP INDEX IDX_F017B131B12A727D ON setting_location');
        $this->addSql('ALTER TABLE setting_location DROP release_id, DROP is_to_be_released');
    }
}
