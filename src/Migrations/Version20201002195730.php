<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201002195730 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE facture CHANGE tva tva NUMERIC(5, 2) NOT NULL, CHANGE montant montant NUMERIC(5, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE reparation CHANGE vehicule_id vehicule_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE facture CHANGE tva tva NUMERIC(2, 2) NOT NULL, CHANGE montant montant NUMERIC(2, 2) NOT NULL');
        $this->addSql('ALTER TABLE reparation CHANGE vehicule_id vehicule_id INT DEFAULT NULL');
    }
}
