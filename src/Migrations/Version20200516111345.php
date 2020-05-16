<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200516111345 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE core_attribute_category DROP description');
        $this->addSql('ALTER TABLE core_ability DROP description');
        $this->addSql('DROP INDEX UNIQ_10B562C918020D9 ON core_lore');
        $this->addSql('ALTER TABLE core_lore DROP handle, DROP description');
        $this->addSql('ALTER TABLE core_skill DROP description');
        $this->addSql('DROP INDEX UNIQ_F53AD039918020D9 ON core_blog_post');
        $this->addSql('ALTER TABLE core_blog_post DROP handle');
        $this->addSql('ALTER TABLE core_size DROP description');
        $this->addSql('ALTER TABLE core_move_speed DROP description');
        $this->addSql('ALTER TABLE core_character_class DROP description');
        $this->addSql('ALTER TABLE core_actions DROP description');
        $this->addSql('DROP INDEX UNIQ_687E52FE918020D9 ON core_feat');
        $this->addSql('ALTER TABLE core_feat DROP handle');
        $this->addSql('ALTER TABLE ancestry_ancestral_hit_points DROP description');
        $this->addSql('DROP INDEX UNIQ_C0CD99FF918020D9 ON ancestry_ancestral_feature');
        $this->addSql('ALTER TABLE ancestry_ancestral_feature DROP handle');
        $this->addSql('DROP INDEX UNIQ_7A52494F918020D9 ON setting_language');
        $this->addSql('ALTER TABLE setting_language DROP handle');
        $this->addSql('DROP INDEX UNIQ_EEFB2C03918020D9 ON setting_culture');
        $this->addSql('ALTER TABLE setting_culture DROP handle');
        $this->addSql('DROP INDEX UNIQ_267D7E07918020D9 ON setting_script');
        $this->addSql('ALTER TABLE setting_script DROP handle');
        $this->addSql('DROP INDEX UNIQ_7A39AB70918020D9 ON setting_background');
        $this->addSql('ALTER TABLE setting_background DROP handle');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ancestry_ancestral_feature ADD handle VARCHAR(80) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0CD99FF918020D9 ON ancestry_ancestral_feature (handle)');
        $this->addSql('ALTER TABLE ancestry_ancestral_hit_points ADD description LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE core_ability ADD description LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE core_actions ADD description LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE core_attribute_category ADD description LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE core_blog_post ADD handle VARCHAR(80) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F53AD039918020D9 ON core_blog_post (handle)');
        $this->addSql('ALTER TABLE core_character_class ADD description LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE core_feat ADD handle VARCHAR(80) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_687E52FE918020D9 ON core_feat (handle)');
        $this->addSql('ALTER TABLE core_lore ADD handle VARCHAR(80) NOT NULL COLLATE utf8mb4_unicode_ci, ADD description LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_10B562C918020D9 ON core_lore (handle)');
        $this->addSql('ALTER TABLE core_move_speed ADD description LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE core_size ADD description LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE core_skill ADD description LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE setting_background ADD handle VARCHAR(80) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A39AB70918020D9 ON setting_background (handle)');
        $this->addSql('ALTER TABLE setting_culture ADD handle VARCHAR(80) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EEFB2C03918020D9 ON setting_culture (handle)');
        $this->addSql('ALTER TABLE setting_language ADD handle VARCHAR(80) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A52494F918020D9 ON setting_language (handle)');
        $this->addSql('ALTER TABLE setting_script ADD handle VARCHAR(80) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_267D7E07918020D9 ON setting_script (handle)');
    }
}
