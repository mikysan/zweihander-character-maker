<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190910175032 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_F0E45BA9B7AEB8D751CE1736 ON season (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F0E45BA95E237E06 ON season (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2AD699C2B7AEB8D751CE1736 ON upbringing (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2AD699C25E237E06 ON upbringing (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_63FAD02FB7AEB8D751CE1736 ON ancestry (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_63FAD02F5E237E06 ON ancestry (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8EA44E21B7AEB8D751CE1736 ON drawback (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_835DC651B7AEB8D751CE173689001A93 ON hair_color (min_roll, max_roll, ancestry_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_904965A4B7AEB8D751CE1736 ON order_alignment (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A6B78738B7AEB8D751CE17364EC001D1 ON dooming (min_roll, max_roll, season_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1D5BCE3B7AEB8D751CE1736 ON archetype (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1D5BCE35E237E06 ON archetype (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7CD5541B7AEB8D751CE1736E8D9F11FC7470A4289001A93 ON weight (min_roll, max_roll, build_type_id, gender, ancestry_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57AFAE05B7AEB8D751CE1736 ON chaos_alignment (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_30E1521C5E237E06 ON primary_attribute (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F54DE50FB7AEB8D751CE1736C7470A4289001A93 ON height (min_roll, max_roll, gender, ancestry_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EACD3585B7AEB8D751CE1736 ON distinguishing_mark (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F88B4253B7AEB8D751CE1736 ON age_group (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F88B42535E237E06 ON age_group (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_720088C6B7AEB8D751CE1736 ON complexion (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A7DBAD0DB7AEB8D751CE1736 ON social_class (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A7DBAD0D5E237E06 ON social_class (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E406C6DCB7AEB8D751CE173689001A93 ON ancestral_trait (min_roll, max_roll, ancestry_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA930D69B7AEB8D751CE1736732C6CC7 ON profession (min_roll, max_roll, archetype_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA930D695E237E06 ON profession (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7C03C6AB7AEB8D751CE173689001A93 ON eye_color (min_roll, max_roll, ancestry_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BA23AC3B7AEB8D751CE1736 ON build_type (min_roll, max_roll)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_F88B4253B7AEB8D751CE1736 ON age_group');
        $this->addSql('DROP INDEX UNIQ_F88B42535E237E06 ON age_group');
        $this->addSql('DROP INDEX UNIQ_E406C6DCB7AEB8D751CE173689001A93 ON ancestral_trait');
        $this->addSql('DROP INDEX UNIQ_63FAD02FB7AEB8D751CE1736 ON ancestry');
        $this->addSql('DROP INDEX UNIQ_63FAD02F5E237E06 ON ancestry');
        $this->addSql('DROP INDEX UNIQ_E1D5BCE3B7AEB8D751CE1736 ON archetype');
        $this->addSql('DROP INDEX UNIQ_E1D5BCE35E237E06 ON archetype');
        $this->addSql('DROP INDEX UNIQ_8BA23AC3B7AEB8D751CE1736 ON build_type');
        $this->addSql('DROP INDEX UNIQ_57AFAE05B7AEB8D751CE1736 ON chaos_alignment');
        $this->addSql('DROP INDEX UNIQ_720088C6B7AEB8D751CE1736 ON complexion');
        $this->addSql('DROP INDEX UNIQ_EACD3585B7AEB8D751CE1736 ON distinguishing_mark');
        $this->addSql('DROP INDEX UNIQ_A6B78738B7AEB8D751CE17364EC001D1 ON dooming');
        $this->addSql('DROP INDEX UNIQ_8EA44E21B7AEB8D751CE1736 ON drawback');
        $this->addSql('DROP INDEX UNIQ_C7C03C6AB7AEB8D751CE173689001A93 ON eye_color');
        $this->addSql('DROP INDEX UNIQ_835DC651B7AEB8D751CE173689001A93 ON hair_color');
        $this->addSql('DROP INDEX UNIQ_F54DE50FB7AEB8D751CE1736C7470A4289001A93 ON height');
        $this->addSql('DROP INDEX UNIQ_904965A4B7AEB8D751CE1736 ON order_alignment');
        $this->addSql('DROP INDEX UNIQ_30E1521C5E237E06 ON primary_attribute');
        $this->addSql('DROP INDEX UNIQ_BA930D69B7AEB8D751CE1736732C6CC7 ON profession');
        $this->addSql('DROP INDEX UNIQ_BA930D695E237E06 ON profession');
        $this->addSql('DROP INDEX UNIQ_F0E45BA9B7AEB8D751CE1736 ON season');
        $this->addSql('DROP INDEX UNIQ_F0E45BA95E237E06 ON season');
        $this->addSql('DROP INDEX UNIQ_A7DBAD0DB7AEB8D751CE1736 ON social_class');
        $this->addSql('DROP INDEX UNIQ_A7DBAD0D5E237E06 ON social_class');
        $this->addSql('DROP INDEX UNIQ_2AD699C2B7AEB8D751CE1736 ON upbringing');
        $this->addSql('DROP INDEX UNIQ_2AD699C25E237E06 ON upbringing');
        $this->addSql('DROP INDEX UNIQ_7CD5541B7AEB8D751CE1736E8D9F11FC7470A4289001A93 ON weight');
    }
}
