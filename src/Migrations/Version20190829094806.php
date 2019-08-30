<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190829094806 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, age_group_id INT NOT NULL, ancestry_id INT NOT NULL, build_type_id INT NOT NULL, chaos_alignment_id INT NOT NULL, complexion_id INT NOT NULL, dooming_id INT NOT NULL, drawback_id INT DEFAULT NULL, eye_color_id INT NOT NULL, hair_color_id INT NOT NULL, height_id INT NOT NULL, order_alignment_id INT NOT NULL, profession_id INT NOT NULL, season_of_birth_id INT NOT NULL, social_class_id INT NOT NULL, upbringing_id INT NOT NULL, weight_id INT NOT NULL, ancestral_trait_id INT NOT NULL, sex VARCHAR(1) NOT NULL, combat INT NOT NULL, brawn INT NOT NULL, agility INT NOT NULL, perception INT NOT NULL, intelligence INT NOT NULL, willpower INT NOT NULL, fellowship INT NOT NULL, combat_bonus INT NOT NULL, brawn_bonus INT NOT NULL, agility_bonus INT NOT NULL, perception_bonus INT NOT NULL, intelligence_bonus INT NOT NULL, willpower_bonus INT NOT NULL, fellowship_bonus INT NOT NULL, fate_points INT NOT NULL, INDEX IDX_937AB034B09E220E (age_group_id), INDEX IDX_937AB03489001A93 (ancestry_id), INDEX IDX_937AB034E8D9F11F (build_type_id), INDEX IDX_937AB03416672892 (chaos_alignment_id), INDEX IDX_937AB034393DF3 (complexion_id), INDEX IDX_937AB0346DFE591D (dooming_id), INDEX IDX_937AB034E08FEC13 (drawback_id), INDEX IDX_937AB034CB96304E (eye_color_id), INDEX IDX_937AB0348345DCB5 (hair_color_id), INDEX IDX_937AB0344679B87C (height_id), INDEX IDX_937AB034AFBA56CA (order_alignment_id), INDEX IDX_937AB034FDEF8996 (profession_id), INDEX IDX_937AB03430F1A6FF (season_of_birth_id), INDEX IDX_937AB03464319F3C (social_class_id), INDEX IDX_937AB0343B59C186 (upbringing_id), INDEX IDX_937AB034350035DC (weight_id), INDEX IDX_937AB0349611DC7D (ancestral_trait_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_distinguishing_mark (character_id INT NOT NULL, distinguishing_mark_id INT NOT NULL, INDEX IDX_A81BC19A1136BE75 (character_id), INDEX IDX_A81BC19AC65B600A (distinguishing_mark_id), PRIMARY KEY(character_id, distinguishing_mark_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034B09E220E FOREIGN KEY (age_group_id) REFERENCES age_group (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB03489001A93 FOREIGN KEY (ancestry_id) REFERENCES ancestry (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034E8D9F11F FOREIGN KEY (build_type_id) REFERENCES build_type (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB03416672892 FOREIGN KEY (chaos_alignment_id) REFERENCES chaos_alignment (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034393DF3 FOREIGN KEY (complexion_id) REFERENCES complexion (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0346DFE591D FOREIGN KEY (dooming_id) REFERENCES dooming (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034E08FEC13 FOREIGN KEY (drawback_id) REFERENCES drawback (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034CB96304E FOREIGN KEY (eye_color_id) REFERENCES eye_color (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0348345DCB5 FOREIGN KEY (hair_color_id) REFERENCES hair_color (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0344679B87C FOREIGN KEY (height_id) REFERENCES height (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034AFBA56CA FOREIGN KEY (order_alignment_id) REFERENCES order_alignment (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034FDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB03430F1A6FF FOREIGN KEY (season_of_birth_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB03464319F3C FOREIGN KEY (social_class_id) REFERENCES social_class (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0343B59C186 FOREIGN KEY (upbringing_id) REFERENCES upbringing (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034350035DC FOREIGN KEY (weight_id) REFERENCES weight (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0349611DC7D FOREIGN KEY (ancestral_trait_id) REFERENCES ancestral_trait (id)');
        $this->addSql('ALTER TABLE character_distinguishing_mark ADD CONSTRAINT FK_A81BC19A1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_distinguishing_mark ADD CONSTRAINT FK_A81BC19AC65B600A FOREIGN KEY (distinguishing_mark_id) REFERENCES distinguishing_mark (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE character_distinguishing_mark DROP FOREIGN KEY FK_A81BC19A1136BE75');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE character_distinguishing_mark');
    }
}
