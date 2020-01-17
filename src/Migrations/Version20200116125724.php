<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200116125724 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, date_achat DATETIME NOT NULL, montant NUMERIC(10, 0) NOT NULL, INDEX IDX_26A9845619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bon_reparation (id INT AUTO_INCREMENT NOT NULL, reparation_id INT DEFAULT NULL, intitule LONGTEXT NOT NULL, validite DATE NOT NULL, INDEX IDX_D3FBE23797934BA (reparation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, groupe_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(50) NOT NULL, adresse LONGTEXT NOT NULL, telephone VARCHAR(20) NOT NULL, personneType VARCHAR(255) NOT NULL, specialite VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_FCEC9EF6C6E55B5 (nom), INDEX IDX_FCEC9EF7A45358C (groupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients_bons (client_id INT NOT NULL, bon_reparation_id INT NOT NULL, INDEX IDX_4FB423C719EB6921 (client_id), INDEX IDX_4FB423C71428C0C (bon_reparation_id), PRIMARY KEY(client_id, bon_reparation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, reparation_id INT DEFAULT NULL, date_commande DATETIME NOT NULL, total NUMERIC(10, 0) NOT NULL, etat VARCHAR(100) NOT NULL, INDEX IDX_6EEAA67D97934BA (reparation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, responsable_id INT DEFAULT NULL, date_facture DATETIME NOT NULL, tva NUMERIC(10, 0) NOT NULL, montant NUMERIC(10, 0) NOT NULL, INDEX IDX_FE86641053C59D72 (responsable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse LONGTEXT NOT NULL, telephone VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_commande (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, piece_id INT DEFAULT NULL, quantite SMALLINT NOT NULL, prix_unitaire NUMERIC(10, 0) NOT NULL, INDEX IDX_3170B74B82EA2E54 (commande_id), INDEX IDX_3170B74BC40FCFA8 (piece_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, date_location DATETIME NOT NULL, nb_jours SMALLINT NOT NULL, prix NUMERIC(10, 0) NOT NULL, INDEX IDX_5E9E89CB19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panne (id INT AUTO_INCREMENT NOT NULL, motif LONGTEXT NOT NULL, date_panne DATE NOT NULL, est_resolu TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pannes_reparations (panne_id INT NOT NULL, reparation_id INT NOT NULL, INDEX IDX_53A99BBE65B7B5BD (panne_id), INDEX IDX_53A99BBE97934BA (reparation_id), PRIMARY KEY(panne_id, reparation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reparateur_reparation (id INT AUTO_INCREMENT NOT NULL, reparateur_id INT DEFAULT NULL, reparation_id INT DEFAULT NULL, nb_jours_passes SMALLINT NOT NULL, INDEX IDX_B292ED6A4E2493C5 (reparateur_id), INDEX IDX_B292ED6A97934BA (reparation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reparation (id INT AUTO_INCREMENT NOT NULL, facture_id INT DEFAULT NULL, numero_chassis_id INT DEFAULT NULL, fournisseur_id INT DEFAULT NULL, description LONGTEXT NOT NULL, date_entree DATETIME NOT NULL, date_sortie DATETIME NOT NULL, statut VARCHAR(100) NOT NULL, INDEX IDX_8FDF219D7F2DEE08 (facture_id), INDEX IDX_8FDF219D66C37A8A (numero_chassis_id), INDEX IDX_8FDF219D670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, hash VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, numero_chassis VARCHAR(17) NOT NULL, immatriculation VARCHAR(9) NOT NULL, marque VARCHAR(255) NOT NULL, couleur VARCHAR(100) NOT NULL, carburant VARCHAR(30) NOT NULL, kilometrage_achat INT NOT NULL, kilometrage_actuel INT NOT NULL, UNIQUE INDEX UNIQ_292FFF1DF39D6D7E (numero_chassis), INDEX IDX_292FFF1D19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845619EB6921 FOREIGN KEY (client_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE bon_reparation ADD CONSTRAINT FK_D3FBE23797934BA FOREIGN KEY (reparation_id) REFERENCES reparation (id)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE clients_bons ADD CONSTRAINT FK_4FB423C719EB6921 FOREIGN KEY (client_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clients_bons ADD CONSTRAINT FK_4FB423C71428C0C FOREIGN KEY (bon_reparation_id) REFERENCES bon_reparation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D97934BA FOREIGN KEY (reparation_id) REFERENCES reparation (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641053C59D72 FOREIGN KEY (responsable_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BC40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB19EB6921 FOREIGN KEY (client_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE pannes_reparations ADD CONSTRAINT FK_53A99BBE65B7B5BD FOREIGN KEY (panne_id) REFERENCES panne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pannes_reparations ADD CONSTRAINT FK_53A99BBE97934BA FOREIGN KEY (reparation_id) REFERENCES reparation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reparateur_reparation ADD CONSTRAINT FK_B292ED6A4E2493C5 FOREIGN KEY (reparateur_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE reparateur_reparation ADD CONSTRAINT FK_B292ED6A97934BA FOREIGN KEY (reparation_id) REFERENCES reparation (id)');
        $this->addSql('ALTER TABLE reparation ADD CONSTRAINT FK_8FDF219D7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE reparation ADD CONSTRAINT FK_8FDF219D66C37A8A FOREIGN KEY (numero_chassis_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE reparation ADD CONSTRAINT FK_8FDF219D670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D19EB6921 FOREIGN KEY (client_id) REFERENCES personne (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clients_bons DROP FOREIGN KEY FK_4FB423C71428C0C');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845619EB6921');
        $this->addSql('ALTER TABLE clients_bons DROP FOREIGN KEY FK_4FB423C719EB6921');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641053C59D72');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB19EB6921');
        $this->addSql('ALTER TABLE reparateur_reparation DROP FOREIGN KEY FK_B292ED6A4E2493C5');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D19EB6921');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B82EA2E54');
        $this->addSql('ALTER TABLE reparation DROP FOREIGN KEY FK_8FDF219D7F2DEE08');
        $this->addSql('ALTER TABLE reparation DROP FOREIGN KEY FK_8FDF219D670C757F');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF7A45358C');
        $this->addSql('ALTER TABLE pannes_reparations DROP FOREIGN KEY FK_53A99BBE65B7B5BD');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74BC40FCFA8');
        $this->addSql('ALTER TABLE bon_reparation DROP FOREIGN KEY FK_D3FBE23797934BA');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D97934BA');
        $this->addSql('ALTER TABLE pannes_reparations DROP FOREIGN KEY FK_53A99BBE97934BA');
        $this->addSql('ALTER TABLE reparateur_reparation DROP FOREIGN KEY FK_B292ED6A97934BA');
        $this->addSql('ALTER TABLE reparation DROP FOREIGN KEY FK_8FDF219D66C37A8A');
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE bon_reparation');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE clients_bons');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE ligne_commande');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE panne');
        $this->addSql('DROP TABLE pannes_reparations');
        $this->addSql('DROP TABLE piece');
        $this->addSql('DROP TABLE reparateur_reparation');
        $this->addSql('DROP TABLE reparation');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vehicule');
    }
}
