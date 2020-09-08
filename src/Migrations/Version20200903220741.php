<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200903220741 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reparateur_specialite ADD CONSTRAINT FK_DA9B30364E2493C5 FOREIGN KEY (reparateur_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_DA9B30364E2493C5 ON reparateur_specialite (reparateur_id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641053C59D72 FOREIGN KEY (responsable_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE gestion_vehicule ADD CONSTRAINT FK_EDE6EB344E2493C5 FOREIGN KEY (reparateur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EDE6EB344E2493C5 ON gestion_vehicule (reparateur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641053C59D72');
        $this->addSql('ALTER TABLE gestion_vehicule DROP FOREIGN KEY FK_EDE6EB344E2493C5');
        $this->addSql('DROP INDEX IDX_EDE6EB344E2493C5 ON gestion_vehicule');
        $this->addSql('ALTER TABLE reparateur_specialite DROP FOREIGN KEY FK_DA9B30364E2493C5');
        $this->addSql('DROP INDEX IDX_DA9B30364E2493C5 ON reparateur_specialite');
    }
}
