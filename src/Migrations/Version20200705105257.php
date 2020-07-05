<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200705105257 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE core_paragraph (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) DEFAULT NULL, description LONGTEXT DEFAULT NULL, sort_order INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE core_feat DROP INDEX UNIQ_687E52FE953C1C61, ADD INDEX IDX_687E52FE953C1C61 (source_id)');
        $this->addSql('ALTER TABLE ancestry_heritage DROP short_description');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE core_paragraph');
        $this->addSql('ALTER TABLE ancestry_heritage ADD short_description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE core_feat DROP INDEX IDX_687E52FE953C1C61, ADD UNIQUE INDEX UNIQ_687E52FE953C1C61 (source_id)');
    }
}
