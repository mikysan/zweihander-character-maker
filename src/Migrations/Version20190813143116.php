<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190813143116 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE upbringing (id INT AUTO_INCREMENT NOT NULL, favored_primary_attribute_id INT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, INDEX IDX_2AD699C2B503625C (favored_primary_attribute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ancestry (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drawback (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, effect LONGTEXT NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hair_color (id INT AUTO_INCREMENT NOT NULL, ancestry_id INT NOT NULL, value VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, INDEX IDX_835DC65189001A93 (ancestry_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_alignment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dooming (id INT AUTO_INCREMENT NOT NULL, season_id INT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, INDEX IDX_A6B787384EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE archetype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weight (id INT AUTO_INCREMENT NOT NULL, build_type_id INT NOT NULL, ancestry_id INT NOT NULL, value VARCHAR(180) NOT NULL, gender VARCHAR(1) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, INDEX IDX_7CD5541E8D9F11F (build_type_id), INDEX IDX_7CD554189001A93 (ancestry_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chaos_alignment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE primary_attribute (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE height (id INT AUTO_INCREMENT NOT NULL, ancestry_id INT NOT NULL, value VARCHAR(180) NOT NULL, gender VARCHAR(1) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, INDEX IDX_F54DE50F89001A93 (ancestry_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE distinguishing_mark (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE age_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, distinguishing_mark_coefficient INT NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE complexion (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_class (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, starting_cash VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ancestral_trait (id INT AUTO_INCREMENT NOT NULL, ancestry_id INT NOT NULL, name VARCHAR(180) NOT NULL, effect LONGTEXT NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, INDEX IDX_E406C6DC89001A93 (ancestry_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profession (id INT AUTO_INCREMENT NOT NULL, archetype_id INT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, INDEX IDX_BA930D69732C6CC7 (archetype_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eye_color (id INT AUTO_INCREMENT NOT NULL, ancestry_id INT NOT NULL, value VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, INDEX IDX_C7C03C6A89001A93 (ancestry_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ancestry_modifier (id INT AUTO_INCREMENT NOT NULL, ancestry_id INT NOT NULL, primary_attribute_id INT NOT NULL, value INT NOT NULL, INDEX IDX_9044BF9089001A93 (ancestry_id), INDEX IDX_9044BF902CFD722C (primary_attribute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE build_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, price_modifier DOUBLE PRECISION NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE upbringing ADD CONSTRAINT FK_2AD699C2B503625C FOREIGN KEY (favored_primary_attribute_id) REFERENCES primary_attribute (id)');
        $this->addSql('ALTER TABLE hair_color ADD CONSTRAINT FK_835DC65189001A93 FOREIGN KEY (ancestry_id) REFERENCES ancestry (id)');
        $this->addSql('ALTER TABLE dooming ADD CONSTRAINT FK_A6B787384EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE weight ADD CONSTRAINT FK_7CD5541E8D9F11F FOREIGN KEY (build_type_id) REFERENCES build_type (id)');
        $this->addSql('ALTER TABLE weight ADD CONSTRAINT FK_7CD554189001A93 FOREIGN KEY (ancestry_id) REFERENCES ancestry (id)');
        $this->addSql('ALTER TABLE height ADD CONSTRAINT FK_F54DE50F89001A93 FOREIGN KEY (ancestry_id) REFERENCES ancestry (id)');
        $this->addSql('ALTER TABLE ancestral_trait ADD CONSTRAINT FK_E406C6DC89001A93 FOREIGN KEY (ancestry_id) REFERENCES ancestry (id)');
        $this->addSql('ALTER TABLE profession ADD CONSTRAINT FK_BA930D69732C6CC7 FOREIGN KEY (archetype_id) REFERENCES archetype (id)');
        $this->addSql('ALTER TABLE eye_color ADD CONSTRAINT FK_C7C03C6A89001A93 FOREIGN KEY (ancestry_id) REFERENCES ancestry (id)');
        $this->addSql('ALTER TABLE ancestry_modifier ADD CONSTRAINT FK_9044BF9089001A93 FOREIGN KEY (ancestry_id) REFERENCES ancestry (id)');
        $this->addSql('ALTER TABLE ancestry_modifier ADD CONSTRAINT FK_9044BF902CFD722C FOREIGN KEY (primary_attribute_id) REFERENCES primary_attribute (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dooming DROP FOREIGN KEY FK_A6B787384EC001D1');
        $this->addSql('ALTER TABLE hair_color DROP FOREIGN KEY FK_835DC65189001A93');
        $this->addSql('ALTER TABLE weight DROP FOREIGN KEY FK_7CD554189001A93');
        $this->addSql('ALTER TABLE height DROP FOREIGN KEY FK_F54DE50F89001A93');
        $this->addSql('ALTER TABLE ancestral_trait DROP FOREIGN KEY FK_E406C6DC89001A93');
        $this->addSql('ALTER TABLE eye_color DROP FOREIGN KEY FK_C7C03C6A89001A93');
        $this->addSql('ALTER TABLE ancestry_modifier DROP FOREIGN KEY FK_9044BF9089001A93');
        $this->addSql('ALTER TABLE profession DROP FOREIGN KEY FK_BA930D69732C6CC7');
        $this->addSql('ALTER TABLE upbringing DROP FOREIGN KEY FK_2AD699C2B503625C');
        $this->addSql('ALTER TABLE ancestry_modifier DROP FOREIGN KEY FK_9044BF902CFD722C');
        $this->addSql('ALTER TABLE weight DROP FOREIGN KEY FK_7CD5541E8D9F11F');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE upbringing');
        $this->addSql('DROP TABLE ancestry');
        $this->addSql('DROP TABLE drawback');
        $this->addSql('DROP TABLE hair_color');
        $this->addSql('DROP TABLE order_alignment');
        $this->addSql('DROP TABLE dooming');
        $this->addSql('DROP TABLE archetype');
        $this->addSql('DROP TABLE weight');
        $this->addSql('DROP TABLE chaos_alignment');
        $this->addSql('DROP TABLE primary_attribute');
        $this->addSql('DROP TABLE height');
        $this->addSql('DROP TABLE distinguishing_mark');
        $this->addSql('DROP TABLE age_group');
        $this->addSql('DROP TABLE complexion');
        $this->addSql('DROP TABLE social_class');
        $this->addSql('DROP TABLE ancestral_trait');
        $this->addSql('DROP TABLE profession');
        $this->addSql('DROP TABLE eye_color');
        $this->addSql('DROP TABLE ancestry_modifier');
        $this->addSql('DROP TABLE build_type');
    }
}
