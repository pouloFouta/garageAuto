<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200719152545 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE panne DROP FOREIGN KEY FK_3885B26097934BA');
        $this->addSql('ALTER TABLE panne ADD CONSTRAINT FK_3885B26097934BA FOREIGN KEY (reparation_id) REFERENCES reparation (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE panne DROP FOREIGN KEY FK_3885B26097934BA');
        $this->addSql('ALTER TABLE panne ADD CONSTRAINT FK_3885B26097934BA FOREIGN KEY (reparation_id) REFERENCES reparation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
