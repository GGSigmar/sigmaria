<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210117140948 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE core_feat_update_release (feat_id INT NOT NULL, release_id INT NOT NULL, INDEX IDX_80E10FBF43C4D5C (feat_id), INDEX IDX_80E10FBB12A727D (release_id), PRIMARY KEY(feat_id, release_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE core_feat_update_release ADD CONSTRAINT FK_80E10FBF43C4D5C FOREIGN KEY (feat_id) REFERENCES core_feat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE core_feat_update_release ADD CONSTRAINT FK_80E10FBB12A727D FOREIGN KEY (release_id) REFERENCES core_release (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE core_feat_update_release');
    }
}
