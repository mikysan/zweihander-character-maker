<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191004143741 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE season_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE upbringing_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ancestry_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE drawback_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hair_color_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE order_alignment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE dooming_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE archetype_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE armor_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE weight_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE chaos_alignment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "character_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE height_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE distinguishing_mark_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE age_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE complexion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE social_class_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ancestral_trait_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE profession_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE eye_color_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ancestry_modifier_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE build_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE season (id INT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F0E45BA9B7AEB8D751CE1736 ON season (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F0E45BA95E237E06 ON season (name)');
        $this->addSql('CREATE TABLE upbringing (id INT NOT NULL, name VARCHAR(180) NOT NULL, favored_primary_attribute INT NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2AD699C2B7AEB8D751CE1736 ON upbringing (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2AD699C25E237E06 ON upbringing (name)');
        $this->addSql('CREATE TABLE ancestry (id INT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_63FAD02FB7AEB8D751CE1736 ON ancestry (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_63FAD02F5E237E06 ON ancestry (name)');
        $this->addSql('CREATE TABLE drawback (id INT NOT NULL, name VARCHAR(180) NOT NULL, effect TEXT NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8EA44E21B7AEB8D751CE1736 ON drawback (min_roll, max_roll)');
        $this->addSql('CREATE TABLE hair_color (id INT NOT NULL, ancestry_id INT NOT NULL, value VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_835DC65189001A93 ON hair_color (ancestry_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_835DC651B7AEB8D751CE173689001A93 ON hair_color (min_roll, max_roll, ancestry_id)');
        $this->addSql('CREATE TABLE order_alignment (id INT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_904965A4B7AEB8D751CE1736 ON order_alignment (min_roll, max_roll)');
        $this->addSql('CREATE TABLE dooming (id INT NOT NULL, season_id INT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A6B787384EC001D1 ON dooming (season_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A6B78738B7AEB8D751CE17364EC001D1 ON dooming (min_roll, max_roll, season_id)');
        $this->addSql('CREATE TABLE archetype (id INT NOT NULL, armor_id INT NOT NULL, name VARCHAR(180) NOT NULL, trappings TEXT NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E1D5BCE3F5AA3663 ON archetype (armor_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1D5BCE3B7AEB8D751CE1736 ON archetype (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1D5BCE35E237E06 ON archetype (name)');
        $this->addSql('CREATE TABLE armor (id INT NOT NULL, name VARCHAR(180) NOT NULL, damage_threshold_modifier INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE weight (id INT NOT NULL, build_type_id INT NOT NULL, ancestry_id INT NOT NULL, value VARCHAR(180) NOT NULL, gender VARCHAR(1) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CD5541E8D9F11F ON weight (build_type_id)');
        $this->addSql('CREATE INDEX IDX_7CD554189001A93 ON weight (ancestry_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7CD5541B7AEB8D751CE1736E8D9F11FC7470A4289001A93 ON weight (min_roll, max_roll, build_type_id, gender, ancestry_id)');
        $this->addSql('CREATE TABLE chaos_alignment (id INT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57AFAE05B7AEB8D751CE1736 ON chaos_alignment (min_roll, max_roll)');
        $this->addSql('CREATE TABLE "character" (id INT NOT NULL, age_group_id INT NOT NULL, ancestry_id INT NOT NULL, build_type_id INT NOT NULL, chaos_alignment_id INT NOT NULL, complexion_id INT NOT NULL, dooming_id INT NOT NULL, drawback_id INT DEFAULT NULL, eye_color_id INT NOT NULL, hair_color_id INT NOT NULL, height_id INT NOT NULL, order_alignment_id INT NOT NULL, profession_id INT NOT NULL, season_of_birth_id INT NOT NULL, social_class_id INT NOT NULL, upbringing_id INT NOT NULL, weight_id INT NOT NULL, ancestral_trait_id INT NOT NULL, armor_id INT NOT NULL, name VARCHAR(255) NOT NULL, distinguishing_marks JSON NOT NULL, sex VARCHAR(1) NOT NULL, combat INT NOT NULL, brawn INT NOT NULL, agility INT NOT NULL, perception INT NOT NULL, intelligence INT NOT NULL, willpower INT NOT NULL, fellowship INT NOT NULL, combat_bonus INT NOT NULL, brawn_bonus INT NOT NULL, agility_bonus INT NOT NULL, perception_bonus INT NOT NULL, intelligence_bonus INT NOT NULL, willpower_bonus INT NOT NULL, fellowship_bonus INT NOT NULL, fate_points INT NOT NULL, trappings TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_937AB034B09E220E ON "character" (age_group_id)');
        $this->addSql('CREATE INDEX IDX_937AB03489001A93 ON "character" (ancestry_id)');
        $this->addSql('CREATE INDEX IDX_937AB034E8D9F11F ON "character" (build_type_id)');
        $this->addSql('CREATE INDEX IDX_937AB03416672892 ON "character" (chaos_alignment_id)');
        $this->addSql('CREATE INDEX IDX_937AB034393DF3 ON "character" (complexion_id)');
        $this->addSql('CREATE INDEX IDX_937AB0346DFE591D ON "character" (dooming_id)');
        $this->addSql('CREATE INDEX IDX_937AB034E08FEC13 ON "character" (drawback_id)');
        $this->addSql('CREATE INDEX IDX_937AB034CB96304E ON "character" (eye_color_id)');
        $this->addSql('CREATE INDEX IDX_937AB0348345DCB5 ON "character" (hair_color_id)');
        $this->addSql('CREATE INDEX IDX_937AB0344679B87C ON "character" (height_id)');
        $this->addSql('CREATE INDEX IDX_937AB034AFBA56CA ON "character" (order_alignment_id)');
        $this->addSql('CREATE INDEX IDX_937AB034FDEF8996 ON "character" (profession_id)');
        $this->addSql('CREATE INDEX IDX_937AB03430F1A6FF ON "character" (season_of_birth_id)');
        $this->addSql('CREATE INDEX IDX_937AB03464319F3C ON "character" (social_class_id)');
        $this->addSql('CREATE INDEX IDX_937AB0343B59C186 ON "character" (upbringing_id)');
        $this->addSql('CREATE INDEX IDX_937AB034350035DC ON "character" (weight_id)');
        $this->addSql('CREATE INDEX IDX_937AB0349611DC7D ON "character" (ancestral_trait_id)');
        $this->addSql('CREATE INDEX IDX_937AB034F5AA3663 ON "character" (armor_id)');
        $this->addSql('CREATE TABLE height (id INT NOT NULL, ancestry_id INT NOT NULL, value VARCHAR(180) NOT NULL, gender VARCHAR(1) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F54DE50F89001A93 ON height (ancestry_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F54DE50FB7AEB8D751CE1736C7470A4289001A93 ON height (min_roll, max_roll, gender, ancestry_id)');
        $this->addSql('CREATE TABLE distinguishing_mark (id INT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EACD3585B7AEB8D751CE1736 ON distinguishing_mark (min_roll, max_roll)');
        $this->addSql('CREATE TABLE age_group (id INT NOT NULL, name VARCHAR(180) NOT NULL, distinguishing_mark_coefficient INT NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F88B4253B7AEB8D751CE1736 ON age_group (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F88B42535E237E06 ON age_group (name)');
        $this->addSql('CREATE TABLE complexion (id INT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_720088C6B7AEB8D751CE1736 ON complexion (min_roll, max_roll)');
        $this->addSql('CREATE TABLE social_class (id INT NOT NULL, name VARCHAR(180) NOT NULL, starting_cash VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A7DBAD0DB7AEB8D751CE1736 ON social_class (min_roll, max_roll)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A7DBAD0D5E237E06 ON social_class (name)');
        $this->addSql('CREATE TABLE ancestral_trait (id INT NOT NULL, ancestry_id INT NOT NULL, name VARCHAR(180) NOT NULL, effect TEXT NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E406C6DC89001A93 ON ancestral_trait (ancestry_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E406C6DCB7AEB8D751CE173689001A93 ON ancestral_trait (min_roll, max_roll, ancestry_id)');
        $this->addSql('CREATE TABLE profession (id INT NOT NULL, archetype_id INT NOT NULL, name VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BA930D69732C6CC7 ON profession (archetype_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA930D69B7AEB8D751CE1736732C6CC7 ON profession (min_roll, max_roll, archetype_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA930D695E237E06 ON profession (name)');
        $this->addSql('CREATE TABLE eye_color (id INT NOT NULL, ancestry_id INT NOT NULL, value VARCHAR(180) NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C7C03C6A89001A93 ON eye_color (ancestry_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7C03C6AB7AEB8D751CE173689001A93 ON eye_color (min_roll, max_roll, ancestry_id)');
        $this->addSql('CREATE TABLE ancestry_modifier (id INT NOT NULL, ancestry_id INT NOT NULL, value INT NOT NULL, primary_attribute INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9044BF9089001A93 ON ancestry_modifier (ancestry_id)');
        $this->addSql('CREATE TABLE build_type (id INT NOT NULL, name VARCHAR(180) NOT NULL, price_modifier DOUBLE PRECISION NOT NULL, min_roll INT NOT NULL, max_roll INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BA23AC3B7AEB8D751CE1736 ON build_type (min_roll, max_roll)');
        $this->addSql('ALTER TABLE hair_color ADD CONSTRAINT FK_835DC65189001A93 FOREIGN KEY (ancestry_id) REFERENCES ancestry (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dooming ADD CONSTRAINT FK_A6B787384EC001D1 FOREIGN KEY (season_id) REFERENCES season (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE archetype ADD CONSTRAINT FK_E1D5BCE3F5AA3663 FOREIGN KEY (armor_id) REFERENCES armor (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE weight ADD CONSTRAINT FK_7CD5541E8D9F11F FOREIGN KEY (build_type_id) REFERENCES build_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE weight ADD CONSTRAINT FK_7CD554189001A93 FOREIGN KEY (ancestry_id) REFERENCES ancestry (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB034B09E220E FOREIGN KEY (age_group_id) REFERENCES age_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB03489001A93 FOREIGN KEY (ancestry_id) REFERENCES ancestry (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB034E8D9F11F FOREIGN KEY (build_type_id) REFERENCES build_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB03416672892 FOREIGN KEY (chaos_alignment_id) REFERENCES chaos_alignment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB034393DF3 FOREIGN KEY (complexion_id) REFERENCES complexion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB0346DFE591D FOREIGN KEY (dooming_id) REFERENCES dooming (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB034E08FEC13 FOREIGN KEY (drawback_id) REFERENCES drawback (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB034CB96304E FOREIGN KEY (eye_color_id) REFERENCES eye_color (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB0348345DCB5 FOREIGN KEY (hair_color_id) REFERENCES hair_color (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB0344679B87C FOREIGN KEY (height_id) REFERENCES height (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB034AFBA56CA FOREIGN KEY (order_alignment_id) REFERENCES order_alignment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB034FDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB03430F1A6FF FOREIGN KEY (season_of_birth_id) REFERENCES season (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB03464319F3C FOREIGN KEY (social_class_id) REFERENCES social_class (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB0343B59C186 FOREIGN KEY (upbringing_id) REFERENCES upbringing (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB034350035DC FOREIGN KEY (weight_id) REFERENCES weight (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB0349611DC7D FOREIGN KEY (ancestral_trait_id) REFERENCES ancestral_trait (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "character" ADD CONSTRAINT FK_937AB034F5AA3663 FOREIGN KEY (armor_id) REFERENCES armor (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE height ADD CONSTRAINT FK_F54DE50F89001A93 FOREIGN KEY (ancestry_id) REFERENCES ancestry (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ancestral_trait ADD CONSTRAINT FK_E406C6DC89001A93 FOREIGN KEY (ancestry_id) REFERENCES ancestry (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE profession ADD CONSTRAINT FK_BA930D69732C6CC7 FOREIGN KEY (archetype_id) REFERENCES archetype (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE eye_color ADD CONSTRAINT FK_C7C03C6A89001A93 FOREIGN KEY (ancestry_id) REFERENCES ancestry (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ancestry_modifier ADD CONSTRAINT FK_9044BF9089001A93 FOREIGN KEY (ancestry_id) REFERENCES ancestry (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE dooming DROP CONSTRAINT FK_A6B787384EC001D1');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB03430F1A6FF');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB0343B59C186');
        $this->addSql('ALTER TABLE hair_color DROP CONSTRAINT FK_835DC65189001A93');
        $this->addSql('ALTER TABLE weight DROP CONSTRAINT FK_7CD554189001A93');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB03489001A93');
        $this->addSql('ALTER TABLE height DROP CONSTRAINT FK_F54DE50F89001A93');
        $this->addSql('ALTER TABLE ancestral_trait DROP CONSTRAINT FK_E406C6DC89001A93');
        $this->addSql('ALTER TABLE eye_color DROP CONSTRAINT FK_C7C03C6A89001A93');
        $this->addSql('ALTER TABLE ancestry_modifier DROP CONSTRAINT FK_9044BF9089001A93');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB034E08FEC13');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB0348345DCB5');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB034AFBA56CA');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB0346DFE591D');
        $this->addSql('ALTER TABLE profession DROP CONSTRAINT FK_BA930D69732C6CC7');
        $this->addSql('ALTER TABLE archetype DROP CONSTRAINT FK_E1D5BCE3F5AA3663');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB034F5AA3663');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB034350035DC');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB03416672892');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB0344679B87C');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB034B09E220E');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB034393DF3');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB03464319F3C');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB0349611DC7D');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB034FDEF8996');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB034CB96304E');
        $this->addSql('ALTER TABLE weight DROP CONSTRAINT FK_7CD5541E8D9F11F');
        $this->addSql('ALTER TABLE "character" DROP CONSTRAINT FK_937AB034E8D9F11F');
        $this->addSql('DROP SEQUENCE season_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE upbringing_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ancestry_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE drawback_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hair_color_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE order_alignment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE dooming_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE archetype_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE armor_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE weight_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE chaos_alignment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "character_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE height_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE distinguishing_mark_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE age_group_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE complexion_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE social_class_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ancestral_trait_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE profession_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE eye_color_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ancestry_modifier_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE build_type_id_seq CASCADE');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE upbringing');
        $this->addSql('DROP TABLE ancestry');
        $this->addSql('DROP TABLE drawback');
        $this->addSql('DROP TABLE hair_color');
        $this->addSql('DROP TABLE order_alignment');
        $this->addSql('DROP TABLE dooming');
        $this->addSql('DROP TABLE archetype');
        $this->addSql('DROP TABLE armor');
        $this->addSql('DROP TABLE weight');
        $this->addSql('DROP TABLE chaos_alignment');
        $this->addSql('DROP TABLE "character"');
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
