<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200903192115 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, groupe_id INT DEFAULT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, points_bonus INT DEFAULT NULL, INDEX IDX_C74404557A45358C (groupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reparateur (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsable (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404557A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497A45358C');
        $this->addSql('DROP INDEX IDX_8D93D6497A45358C ON user');
        $this->addSql('ALTER TABLE user DROP groupe_id, DROP userType, DROP points_bonus, DROP adresse, DROP telephone');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641053C59D72');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641053C59D72 FOREIGN KEY (responsable_id) REFERENCES responsable (id)');
        $this->addSql('ALTER TABLE gestion_vehicule DROP FOREIGN KEY FK_EDE6EB344E2493C5');
        $this->addSql('ALTER TABLE gestion_vehicule ADD CONSTRAINT FK_EDE6EB344E2493C5 FOREIGN KEY (reparateur_id) REFERENCES reparateur (id)');
        $this->addSql('ALTER TABLE reparateur_specialite DROP FOREIGN KEY FK_DA9B30364E2493C5');
        $this->addSql('ALTER TABLE reparateur_specialite ADD CONSTRAINT FK_DA9B30364E2493C5 FOREIGN KEY (reparateur_id) REFERENCES reparateur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gestion_vehicule DROP FOREIGN KEY FK_EDE6EB344E2493C5');
        $this->addSql('ALTER TABLE reparateur_specialite DROP FOREIGN KEY FK_DA9B30364E2493C5');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641053C59D72');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE reparateur');
        $this->addSql('DROP TABLE responsable');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641053C59D72');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641053C59D72 FOREIGN KEY (responsable_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE gestion_vehicule DROP FOREIGN KEY FK_EDE6EB344E2493C5');
        $this->addSql('ALTER TABLE gestion_vehicule ADD CONSTRAINT FK_EDE6EB344E2493C5 FOREIGN KEY (reparateur_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE reparateur_specialite DROP FOREIGN KEY FK_DA9B30364E2493C5');
        $this->addSql('ALTER TABLE reparateur_specialite ADD CONSTRAINT FK_DA9B30364E2493C5 FOREIGN KEY (reparateur_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD groupe_id INT DEFAULT NULL, ADD userType VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD points_bonus INT DEFAULT NULL, ADD adresse VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD telephone VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D93D6497A45358C ON user (groupe_id)');
    }
}
