<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190920084448 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ancestry_modifier DROP FOREIGN KEY FK_9044BF902CFD722C');
        $this->addSql('ALTER TABLE upbringing DROP FOREIGN KEY FK_2AD699C2B503625C');
        $this->addSql('DROP TABLE primary_attribute');
        $this->addSql('DROP INDEX IDX_2AD699C2B503625C ON upbringing');
        $this->addSql('ALTER TABLE upbringing CHANGE favored_primary_attribute_id favored_primary_attribute INT NOT NULL');
        $this->addSql('DROP INDEX IDX_9044BF902CFD722C ON ancestry_modifier');
        $this->addSql('ALTER TABLE ancestry_modifier CHANGE primary_attribute_id primary_attribute INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE primary_attribute (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_30E1521C5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ancestry_modifier CHANGE primary_attribute primary_attribute_id INT NOT NULL');
        $this->addSql('ALTER TABLE ancestry_modifier ADD CONSTRAINT FK_9044BF902CFD722C FOREIGN KEY (primary_attribute_id) REFERENCES primary_attribute (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9044BF902CFD722C ON ancestry_modifier (primary_attribute_id)');
        $this->addSql('ALTER TABLE upbringing CHANGE favored_primary_attribute favored_primary_attribute_id INT NOT NULL');
        $this->addSql('ALTER TABLE upbringing ADD CONSTRAINT FK_2AD699C2B503625C FOREIGN KEY (favored_primary_attribute_id) REFERENCES primary_attribute (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2AD699C2B503625C ON upbringing (favored_primary_attribute_id)');
    }
}
