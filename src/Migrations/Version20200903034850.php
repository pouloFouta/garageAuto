<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200903034850 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bon DROP FOREIGN KEY FK_FC7DFD6B19EB6921');
        $this->addSql('ALTER TABLE bon ADD CONSTRAINT FK_FC7DFD6B19EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD groupe_id INT DEFAULT NULL, ADD userType VARCHAR(255) NOT NULL, ADD points_bonus INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6497A45358C ON user (groupe_id)');
        $this->addSql('ALTER TABLE reparateur_specialite DROP FOREIGN KEY FK_DA9B30364E2493C5');
        $this->addSql('ALTER TABLE reparateur_specialite ADD CONSTRAINT FK_DA9B30364E2493C5 FOREIGN KEY (reparateur_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641053C59D72');
        $this->addSql('ALTER TABLE facture ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641019EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641053C59D72 FOREIGN KEY (responsable_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FE86641019EB6921 ON facture (client_id)');
        $this->addSql('ALTER TABLE gestion_vehicule DROP FOREIGN KEY FK_EDE6EB344E2493C5');
        $this->addSql('ALTER TABLE gestion_vehicule ADD CONSTRAINT FK_EDE6EB344E2493C5 FOREIGN KEY (reparateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB19EB6921');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB19EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF7A45358C');
        $this->addSql('DROP INDEX IDX_FCEC9EF7A45358C ON personne');
        $this->addSql('ALTER TABLE personne DROP groupe_id, DROP points_bonus');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D19EB6921');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D19EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4C19EB6921');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C19EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bon DROP FOREIGN KEY FK_FC7DFD6B19EB6921');
        $this->addSql('ALTER TABLE bon ADD CONSTRAINT FK_FC7DFD6B19EB6921 FOREIGN KEY (client_id) REFERENCES personne (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641019EB6921');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641053C59D72');
        $this->addSql('DROP INDEX IDX_FE86641019EB6921 ON facture');
        $this->addSql('ALTER TABLE facture DROP client_id');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641053C59D72 FOREIGN KEY (responsable_id) REFERENCES personne (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE gestion_vehicule DROP FOREIGN KEY FK_EDE6EB344E2493C5');
        $this->addSql('ALTER TABLE gestion_vehicule ADD CONSTRAINT FK_EDE6EB344E2493C5 FOREIGN KEY (reparateur_id) REFERENCES personne (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB19EB6921');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB19EB6921 FOREIGN KEY (client_id) REFERENCES personne (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE personne ADD groupe_id INT DEFAULT NULL, ADD points_bonus INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_FCEC9EF7A45358C ON personne (groupe_id)');
        $this->addSql('ALTER TABLE reparateur_specialite DROP FOREIGN KEY FK_DA9B30364E2493C5');
        $this->addSql('ALTER TABLE reparateur_specialite ADD CONSTRAINT FK_DA9B30364E2493C5 FOREIGN KEY (reparateur_id) REFERENCES personne (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497A45358C');
        $this->addSql('DROP INDEX IDX_8D93D6497A45358C ON user');
        $this->addSql('ALTER TABLE user DROP groupe_id, DROP userType, DROP points_bonus');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D19EB6921');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D19EB6921 FOREIGN KEY (client_id) REFERENCES personne (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4C19EB6921');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C19EB6921 FOREIGN KEY (client_id) REFERENCES personne (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
