<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200709203230 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE culture_paragraph (culture_id INT NOT NULL, paragraph_id INT NOT NULL, INDEX IDX_254BF8EEB108249D (culture_id), INDEX IDX_254BF8EE8B50597F (paragraph_id), PRIMARY KEY(culture_id, paragraph_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE culture_paragraph ADD CONSTRAINT FK_254BF8EEB108249D FOREIGN KEY (culture_id) REFERENCES setting_culture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE culture_paragraph ADD CONSTRAINT FK_254BF8EE8B50597F FOREIGN KEY (paragraph_id) REFERENCES core_paragraph (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE core_paragraph CHANGE created_at created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE culture_paragraph');
        $this->addSql('ALTER TABLE core_paragraph CHANGE created_at created_at DATETIME DEFAULT NULL');
    }
}
