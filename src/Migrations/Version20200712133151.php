<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200712133151 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE campaign_quest ADD campaign_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE campaign_quest ADD CONSTRAINT FK_D129C78F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign_campaign (id)');
        $this->addSql('CREATE INDEX IDX_D129C78F639F774 ON campaign_quest (campaign_id)');
        $this->addSql('ALTER TABLE setting_location ADD type_id INT DEFAULT NULL, ADD parent_location_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE setting_location ADD CONSTRAINT FK_F017B131C54C8C93 FOREIGN KEY (type_id) REFERENCES setting_location_type (id)');
        $this->addSql('ALTER TABLE setting_location ADD CONSTRAINT FK_F017B1316D6133FE FOREIGN KEY (parent_location_id) REFERENCES setting_location (id)');
        $this->addSql('CREATE INDEX IDX_F017B131C54C8C93 ON setting_location (type_id)');
        $this->addSql('CREATE INDEX IDX_F017B1316D6133FE ON setting_location (parent_location_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE campaign_quest DROP FOREIGN KEY FK_D129C78F639F774');
        $this->addSql('DROP INDEX IDX_D129C78F639F774 ON campaign_quest');
        $this->addSql('ALTER TABLE campaign_quest DROP campaign_id');
        $this->addSql('ALTER TABLE setting_location DROP FOREIGN KEY FK_F017B131C54C8C93');
        $this->addSql('ALTER TABLE setting_location DROP FOREIGN KEY FK_F017B1316D6133FE');
        $this->addSql('DROP INDEX IDX_F017B131C54C8C93 ON setting_location');
        $this->addSql('DROP INDEX IDX_F017B1316D6133FE ON setting_location');
        $this->addSql('ALTER TABLE setting_location DROP type_id, DROP parent_location_id');
    }
}
