<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140920171830 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('INSERT INTO article VALUES (1, "Hello World", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, voluptatum. Provident accusamus sit, commodi corrupti illo, veniam possimus minima rerum itaque. Magni, beatae, facere.")');
        $this->addSql('INSERT INTO article VALUES (2, "Bye World", "Iraqi PM Nouri Maliki steps aside, ending political deadlock in Baghdad as the government struggles against insurgents in the north.")');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DELETE FROM article WHERE id IN (1, 2)');
    }
}
