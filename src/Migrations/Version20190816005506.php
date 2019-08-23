<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190816005506 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clients_bons (client_id INT NOT NULL, bon_reparation_id INT NOT NULL, INDEX IDX_4FB423C719EB6921 (client_id), INDEX IDX_4FB423C71428C0C (bon_reparation_id), PRIMARY KEY(client_id, bon_reparation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pannes_reparations (panne_id INT NOT NULL, reparation_id INT NOT NULL, INDEX IDX_53A99BBE65B7B5BD (panne_id), INDEX IDX_53A99BBE97934BA (reparation_id), PRIMARY KEY(panne_id, reparation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reparateur_reparation (id INT AUTO_INCREMENT NOT NULL, reparateur_id INT DEFAULT NULL, reparation_id INT DEFAULT NULL, nb_jours_passes SMALLINT NOT NULL, INDEX IDX_B292ED6A4E2493C5 (reparateur_id), INDEX IDX_B292ED6A97934BA (reparation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clients_bons ADD CONSTRAINT FK_4FB423C719EB6921 FOREIGN KEY (client_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clients_bons ADD CONSTRAINT FK_4FB423C71428C0C FOREIGN KEY (bon_reparation_id) REFERENCES bon_reparation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pannes_reparations ADD CONSTRAINT FK_53A99BBE65B7B5BD FOREIGN KEY (panne_id) REFERENCES panne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pannes_reparations ADD CONSTRAINT FK_53A99BBE97934BA FOREIGN KEY (reparation_id) REFERENCES reparation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reparateur_reparation ADD CONSTRAINT FK_B292ED6A4E2493C5 FOREIGN KEY (reparateur_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE reparateur_reparation ADD CONSTRAINT FK_B292ED6A97934BA FOREIGN KEY (reparation_id) REFERENCES reparation (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD commande_id INT DEFAULT NULL, ADD piece_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BC40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id)');
        $this->addSql('CREATE INDEX IDX_3170B74B82EA2E54 ON ligne_commande (commande_id)');
        $this->addSql('CREATE INDEX IDX_3170B74BC40FCFA8 ON ligne_commande (piece_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE clients_bons');
        $this->addSql('DROP TABLE pannes_reparations');
        $this->addSql('DROP TABLE reparateur_reparation');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B82EA2E54');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74BC40FCFA8');
        $this->addSql('DROP INDEX IDX_3170B74B82EA2E54 ON ligne_commande');
        $this->addSql('DROP INDEX IDX_3170B74BC40FCFA8 ON ligne_commande');
        $this->addSql('ALTER TABLE ligne_commande DROP commande_id, DROP piece_id');
    }
}
