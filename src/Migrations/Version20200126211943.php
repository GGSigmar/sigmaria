<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200126211943 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ancestry_heritage ADD ancestry_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ancestry_heritage ADD CONSTRAINT FK_ECBD26D589001A93 FOREIGN KEY (ancestry_id) REFERENCES ancestry_ancestry (id)');
        $this->addSql('CREATE INDEX IDX_ECBD26D589001A93 ON ancestry_heritage (ancestry_id)');
        $this->addSql('ALTER TABLE ancestry_ancestry ADD heritage_value INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ancestry_ancestry DROP heritage_value');
        $this->addSql('ALTER TABLE ancestry_heritage DROP FOREIGN KEY FK_ECBD26D589001A93');
        $this->addSql('DROP INDEX IDX_ECBD26D589001A93 ON ancestry_heritage');
        $this->addSql('ALTER TABLE ancestry_heritage DROP ancestry_id');
    }
}
