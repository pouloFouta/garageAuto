<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200503135451 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, vehicule_id INT NOT NULL, date_achat DATETIME NOT NULL, montant NUMERIC(10, 0) NOT NULL, INDEX IDX_26A9845619EB6921 (client_id), UNIQUE INDEX UNIQ_26A984564A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bon (id INT AUTO_INCREMENT NOT NULL, type_bon_id INT NOT NULL, client_id INT DEFAULT NULL, validite DATE NOT NULL, INDEX IDX_FC7DFD6B8EB21844 (type_bon_id), INDEX IDX_FC7DFD6B19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reparateur_specialite (reparateur_id INT NOT NULL, specialite_id INT NOT NULL, INDEX IDX_DA9B30364E2493C5 (reparateur_id), INDEX IDX_DA9B30362195E0F0 (specialite_id), PRIMARY KEY(reparateur_id, specialite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, reparation_id INT DEFAULT NULL, fournisseur_id INT DEFAULT NULL, date_commande DATETIME NOT NULL, total NUMERIC(10, 0) NOT NULL, etat VARCHAR(100) NOT NULL, INDEX IDX_6EEAA67D97934BA (reparation_id), INDEX IDX_6EEAA67D670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, responsable_id INT DEFAULT NULL, date_facture DATETIME NOT NULL, tva NUMERIC(10, 0) NOT NULL, montant NUMERIC(10, 0) NOT NULL, INDEX IDX_FE86641053C59D72 (responsable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse LONGTEXT NOT NULL, telephone VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gestion_vehicule (id INT AUTO_INCREMENT NOT NULL, reparation_id INT NOT NULL, specialite_id INT NOT NULL, reparateur_id INT NOT NULL, nb_jours_passes INT NOT NULL, INDEX IDX_EDE6EB3497934BA (reparation_id), INDEX IDX_EDE6EB342195E0F0 (specialite_id), INDEX IDX_EDE6EB344E2493C5 (reparateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_commande (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, piece_id INT NOT NULL, quantite INT NOT NULL, prix_ligne NUMERIC(10, 0) NOT NULL, INDEX IDX_3170B74B82EA2E54 (commande_id), INDEX IDX_3170B74BC40FCFA8 (piece_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, vehicule_id INT NOT NULL, date_location DATETIME NOT NULL, nb_jours SMALLINT NOT NULL, prix NUMERIC(10, 0) NOT NULL, INDEX IDX_5E9E89CB19EB6921 (client_id), INDEX IDX_5E9E89CB4A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panne (id INT AUTO_INCREMENT NOT NULL, reparation_id INT DEFAULT NULL, motif LONGTEXT NOT NULL, date_panne DATE NOT NULL, est_resolu TINYINT(1) NOT NULL, INDEX IDX_3885B26097934BA (reparation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, prix_unitaire NUMERIC(10, 0) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reparation (id INT AUTO_INCREMENT NOT NULL, facture_id INT DEFAULT NULL, fournisseur_id INT DEFAULT NULL, vehicule_id INT NOT NULL, description LONGTEXT NOT NULL, date_entree DATETIME NOT NULL, date_sortie DATETIME NOT NULL, statut VARCHAR(100) NOT NULL, INDEX IDX_8FDF219D7F2DEE08 (facture_id), INDEX IDX_8FDF219D670C757F (fournisseur_id), INDEX IDX_8FDF219D4A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_bon (id INT AUTO_INCREMENT NOT NULL, description_type VARCHAR(255) NOT NULL, nb_points_necessaires INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, numero_chassis VARCHAR(17) NOT NULL, immatriculation VARCHAR(9) NOT NULL, marque VARCHAR(255) NOT NULL, couleur VARCHAR(100) NOT NULL, carburant VARCHAR(30) NOT NULL, kilometrage_achat INT NOT NULL, kilometrage_actuel INT NOT NULL, UNIQUE INDEX UNIQ_292FFF1DF39D6D7E (numero_chassis), INDEX IDX_292FFF1D19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845619EB6921 FOREIGN KEY (client_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A984564A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE bon ADD CONSTRAINT FK_FC7DFD6B8EB21844 FOREIGN KEY (type_bon_id) REFERENCES type_bon (id)');
        $this->addSql('ALTER TABLE bon ADD CONSTRAINT FK_FC7DFD6B19EB6921 FOREIGN KEY (client_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE reparateur_specialite ADD CONSTRAINT FK_DA9B30364E2493C5 FOREIGN KEY (reparateur_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reparateur_specialite ADD CONSTRAINT FK_DA9B30362195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D97934BA FOREIGN KEY (reparation_id) REFERENCES reparation (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641053C59D72 FOREIGN KEY (responsable_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE gestion_vehicule ADD CONSTRAINT FK_EDE6EB3497934BA FOREIGN KEY (reparation_id) REFERENCES reparation (id)');
        $this->addSql('ALTER TABLE gestion_vehicule ADD CONSTRAINT FK_EDE6EB342195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id)');
        $this->addSql('ALTER TABLE gestion_vehicule ADD CONSTRAINT FK_EDE6EB344E2493C5 FOREIGN KEY (reparateur_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BC40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB19EB6921 FOREIGN KEY (client_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE panne ADD CONSTRAINT FK_3885B26097934BA FOREIGN KEY (reparation_id) REFERENCES reparation (id)');
        $this->addSql('ALTER TABLE reparation ADD CONSTRAINT FK_8FDF219D7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE reparation ADD CONSTRAINT FK_8FDF219D670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE reparation ADD CONSTRAINT FK_8FDF219D4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D19EB6921 FOREIGN KEY (client_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE personne ADD points_bonus INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B82EA2E54');
        $this->addSql('ALTER TABLE reparation DROP FOREIGN KEY FK_8FDF219D7F2DEE08');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D670C757F');
        $this->addSql('ALTER TABLE reparation DROP FOREIGN KEY FK_8FDF219D670C757F');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF7A45358C');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74BC40FCFA8');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D97934BA');
        $this->addSql('ALTER TABLE gestion_vehicule DROP FOREIGN KEY FK_EDE6EB3497934BA');
        $this->addSql('ALTER TABLE panne DROP FOREIGN KEY FK_3885B26097934BA');
        $this->addSql('ALTER TABLE bon DROP FOREIGN KEY FK_FC7DFD6B8EB21844');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A984564A4A3511');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB4A4A3511');
        $this->addSql('ALTER TABLE reparation DROP FOREIGN KEY FK_8FDF219D4A4A3511');
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE bon');
        $this->addSql('DROP TABLE reparateur_specialite');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE gestion_vehicule');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE ligne_commande');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE panne');
        $this->addSql('DROP TABLE piece');
        $this->addSql('DROP TABLE reparation');
        $this->addSql('DROP TABLE type_bon');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('ALTER TABLE personne DROP points_bonus');
    }
}
