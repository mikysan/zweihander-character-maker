<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190906102716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE archetype ADD trappings LONGTEXT NOT NULL');
        $this->addSql('update archetype set trappings = "black lotus, bottle of leeches, coin purse, dirk, fine clothing, holy symbol, loose robes, quicksilver, royal water, shoulder bag, smelling salts (3), soft shoes or leather sandals, writing kit, cudgel or staff or throwing knives (3) with bandolier" where name like "Academic"');
        $this->addSql('update archetype set trappings = "bandages (3), bottle bomb, grave root, holy symbol, leather sandals or heavy boots, rucksack, shiv, simple attire, warm vest, shepherd\'s sling with sling stones(9) or splitting maul or threshing flail" where name like "Commoner"');
        $this->addSql('update archetype set trappings = "antivenom, dark clothes or tattered rags, folkbane(3), gaff bag, garish attire or second - hand attire, holy symbol, lock picks, mantle, soft shoes, stiletto, blackjack or garrote or flintlock pistol with gunpowder & shot(6)" where name like "Knave"');
        $this->addSql('update archetype set trappings = "animalbane(3), antivenom, backpack, bullwhip, heavy boots, holy symbol, Hide or Suit of Furs, survival kit, torches(3), traveling clothes, waterskin, wilderness cloak, wolfsbane, fire - hardened spear or hunting bow with arrows(9) and quiver or woodsman\'s axe" where name like "Ranger"');
        $this->addSql('update archetype set trappings = "coin purse, fancy shoes, fashionable clothing, foppish hat, holy symbol, knuckleduster, mandrake root (3), mantle, neck ruff, shoulder bag, writing kit, throwing knives (3) with bandolier or rapier or walking cane (as improvised hand weapon)" where name like "Socialite"');
        $this->addSql('update archetype set trappings = "fire-hardened spear, heavy boots, lantern, laudanum (3), military attire, oil pot, red cap mushrooms, rucksack, suit of leather armor, tincture (3), wooden shield, arbalest crossbow with bolts (9) and quiver or mortuary sword or pike" where name like "Warrior"');
        $this->addSql('ALTER TABLE `character` ADD name VARCHAR(255) NOT NULL, ADD trappings LONGTEXT NOT NULL');
        $this->addSql('update `character` c inner join profession p on c.profession_id = p.id inner join archetype a on p.archetype_id = a.id set c.trappings = a.trappings where c.trappings = "";');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE archetype DROP trappings');
        $this->addSql('ALTER TABLE `character` DROP name, DROP trappings');
    }
}
