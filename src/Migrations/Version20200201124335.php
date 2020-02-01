<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200201124335 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ancestry_heritage_ability_boost (heritage_id INT NOT NULL, ability_id INT NOT NULL, INDEX IDX_6FF05BC9C2CAC1EF (heritage_id), INDEX IDX_6FF05BC98016D8B2 (ability_id), PRIMARY KEY(heritage_id, ability_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ancestry_heritage_attribute (heritage_id INT NOT NULL, attribute_id INT NOT NULL, INDEX IDX_76C6FED7C2CAC1EF (heritage_id), INDEX IDX_76C6FED7B6E62EFA (attribute_id), PRIMARY KEY(heritage_id, attribute_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ancestry_heritage_feat (heritage_id INT NOT NULL, feat_id INT NOT NULL, INDEX IDX_FCBF30B8C2CAC1EF (heritage_id), INDEX IDX_FCBF30B8F43C4D5C (feat_id), PRIMARY KEY(heritage_id, feat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ancestry_heritage_ability_boost ADD CONSTRAINT FK_6FF05BC9C2CAC1EF FOREIGN KEY (heritage_id) REFERENCES ancestry_heritage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ancestry_heritage_ability_boost ADD CONSTRAINT FK_6FF05BC98016D8B2 FOREIGN KEY (ability_id) REFERENCES core_ability (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ancestry_heritage_attribute ADD CONSTRAINT FK_76C6FED7C2CAC1EF FOREIGN KEY (heritage_id) REFERENCES ancestry_heritage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ancestry_heritage_attribute ADD CONSTRAINT FK_76C6FED7B6E62EFA FOREIGN KEY (attribute_id) REFERENCES core_attribute (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ancestry_heritage_feat ADD CONSTRAINT FK_FCBF30B8C2CAC1EF FOREIGN KEY (heritage_id) REFERENCES ancestry_heritage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ancestry_heritage_feat ADD CONSTRAINT FK_FCBF30B8F43C4D5C FOREIGN KEY (feat_id) REFERENCES core_feat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ancestry_heritage ADD hit_points_id INT DEFAULT NULL, ADD size_id INT DEFAULT NULL, ADD speed_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ancestry_heritage ADD CONSTRAINT FK_ECBD26D5D1FBA61D FOREIGN KEY (hit_points_id) REFERENCES ancestry_ancestral_hit_points (id)');
        $this->addSql('ALTER TABLE ancestry_heritage ADD CONSTRAINT FK_ECBD26D5498DA827 FOREIGN KEY (size_id) REFERENCES core_size (id)');
        $this->addSql('ALTER TABLE ancestry_heritage ADD CONSTRAINT FK_ECBD26D58F3A8393 FOREIGN KEY (speed_id) REFERENCES core_move_speed (id)');
        $this->addSql('CREATE INDEX IDX_ECBD26D5D1FBA61D ON ancestry_heritage (hit_points_id)');
        $this->addSql('CREATE INDEX IDX_ECBD26D5498DA827 ON ancestry_heritage (size_id)');
        $this->addSql('CREATE INDEX IDX_ECBD26D58F3A8393 ON ancestry_heritage (speed_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ancestry_heritage_ability_boost');
        $this->addSql('DROP TABLE ancestry_heritage_attribute');
        $this->addSql('DROP TABLE ancestry_heritage_feat');
        $this->addSql('ALTER TABLE ancestry_heritage DROP FOREIGN KEY FK_ECBD26D5D1FBA61D');
        $this->addSql('ALTER TABLE ancestry_heritage DROP FOREIGN KEY FK_ECBD26D5498DA827');
        $this->addSql('ALTER TABLE ancestry_heritage DROP FOREIGN KEY FK_ECBD26D58F3A8393');
        $this->addSql('DROP INDEX IDX_ECBD26D5D1FBA61D ON ancestry_heritage');
        $this->addSql('DROP INDEX IDX_ECBD26D5498DA827 ON ancestry_heritage');
        $this->addSql('DROP INDEX IDX_ECBD26D58F3A8393 ON ancestry_heritage');
        $this->addSql('ALTER TABLE ancestry_heritage DROP hit_points_id, DROP size_id, DROP speed_id');
    }
}
