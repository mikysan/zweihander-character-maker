<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190914203227 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'BC Break: any previous generated character will lose any distinguishing_marks.';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE character_distinguishing_mark');
        $this->addSql('ALTER TABLE `character` ADD distinguishing_marks JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE character_distinguishing_mark (character_id INT NOT NULL, distinguishing_mark_id INT NOT NULL, INDEX IDX_A81BC19AC65B600A (distinguishing_mark_id), INDEX IDX_A81BC19A1136BE75 (character_id), PRIMARY KEY(character_id, distinguishing_mark_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE character_distinguishing_mark ADD CONSTRAINT FK_A81BC19A1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_distinguishing_mark ADD CONSTRAINT FK_A81BC19AC65B600A FOREIGN KEY (distinguishing_mark_id) REFERENCES distinguishing_mark (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `character` DROP distinguishing_marks');
    }
}
