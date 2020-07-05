<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200705175928 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE heritage_paragraph (heritage_id INT NOT NULL, paragraph_id INT NOT NULL, INDEX IDX_F26A0714C2CAC1EF (heritage_id), INDEX IDX_F26A07148B50597F (paragraph_id), PRIMARY KEY(heritage_id, paragraph_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE heritage_paragraph ADD CONSTRAINT FK_F26A0714C2CAC1EF FOREIGN KEY (heritage_id) REFERENCES ancestry_heritage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE heritage_paragraph ADD CONSTRAINT FK_F26A07148B50597F FOREIGN KEY (paragraph_id) REFERENCES core_paragraph (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE heritage_paragraph');
    }
}
