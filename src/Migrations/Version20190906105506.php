<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190906105506 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE armor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, damage_threshold_modifier INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('insert into armor (name, damage_threshold_modifier) values (\'Clothing\', 0), (\'Fur or Hide\', 1), (\'Quilted\', 1), (\'Leather\', 2), (\'Brigandine\', 3), (\'Mail\', 4), (\'Munitions Plate\', 5), (\'Full Plate\', 6);');
        $this->addSql('ALTER TABLE archetype ADD armor_id INT NOT NULL');
        $this->addSql('update archetype a inner join armor m on m.name = \'Clothing\' set a.armor_id = m.id where a.name = \'Academic\';');
        $this->addSql('update archetype a inner join armor m on m.name = \'Clothing\' set a.armor_id = m.id where a.name = \'Commoner\';');
        $this->addSql('update archetype a inner join armor m on m.name = \'Clothing\' set a.armor_id = m.id where a.name = \'Knave\';');
        $this->addSql('update archetype a inner join armor m on m.name = \'Clothing\' set a.armor_id = m.id where a.name = \'Socialite\';');
        $this->addSql('update archetype a inner join armor m on m.name = \'Fur or Hide\' set a.armor_id = m.id where a.name = \'Ranger\';');
        $this->addSql('update archetype a inner join armor m on m.name = \'Leather\' set a.armor_id = m.id where a.name = \'Warrior\';');
        $this->addSql('ALTER TABLE archetype ADD CONSTRAINT FK_E1D5BCE3F5AA3663 FOREIGN KEY (armor_id) REFERENCES armor (id)');
        $this->addSql('CREATE INDEX IDX_E1D5BCE3F5AA3663 ON archetype (armor_id)');
        $this->addSql('ALTER TABLE `character` ADD armor_id INT NOT NULL');
        $this->addSql('update `character` c inner join profession p on c.profession_id = p.id inner join archetype a on p.archetype_id = a.id set c.armor_id = a.armor_id;');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034F5AA3663 FOREIGN KEY (armor_id) REFERENCES armor (id)');
        $this->addSql('CREATE INDEX IDX_937AB034F5AA3663 ON `character` (armor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034F5AA3663');
        $this->addSql('ALTER TABLE archetype DROP FOREIGN KEY FK_E1D5BCE3F5AA3663');
        $this->addSql('DROP INDEX IDX_E1D5BCE3F5AA3663 ON archetype');
        $this->addSql('ALTER TABLE archetype DROP armor_id');
        $this->addSql('DROP INDEX IDX_937AB034F5AA3663 ON `character`');
        $this->addSql('ALTER TABLE `character` DROP armor_id');
        $this->addSql('DROP TABLE armor');
    }
}
